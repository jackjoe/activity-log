<?php namespace JackJoe\ActivityLog\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class Activity extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'activity_log';

	/**
	 * The fillable fields for the model.
	 *
	 * @var    array
	 */
	protected $fillable = [
		'user_id',
		'content_type',
		'content_id',
		'action',
		'description',
		'details',
		'data',
		'version',
		'ip_address',
		'user_agent',
	];

	/**
	 * Get the user that the activity belongs to.
	 *
	 * @return object
	 */
	public function user()
	{
		return $this->belongsTo(config('auth.providers.users.model'), 'user_id');
  }

	/**
	 * Create an activity log entry.
	 *
	 * @param  mixed    $data
	 * @return boolean
	 */
	public static function log($data = [])
	{
		// set the defaults from config
		$defaults = config('log.defaults');
    if(!is_array($defaults)) {
			$defaults = [];
    }

    if(is_object($data)) {
      $data = (array) $data;
    }

		// set the user ID
		if(config('log.auto_set_user_id') && !isset($data['userId'])) {
			$user = call_user_func(config('log.auth_method'));
			$data['userId'] = isset($user->id) ? $user->id : null;
		}

		// set IP address
    if(!isset($data['ipAddress'])) {
			$data['ipAddress'] = Request::getClientIp();
    }

		// set user agent
    if (!isset($data['userAgent'])) {
			$data['userAgent'] = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'No User Agent';
    }

		// set additional data and encode it as JSON if it is an array or an object
    if(isset($data['data']) && (is_array($data['data']) || is_object($data['data']))) {
			$data['data'] = json_encode($data['data']);
    }

		// format array keys to snake case for insertion into database
		$dataFormatted = [];
		foreach ($data as $key => $value) {
			$dataFormatted[snake_case($key)] = $value;
		}

		// merge defaults array with formatted data array
		$data = array_merge($defaults, $dataFormatted);

		// create the record
		static::create($data);

		return true;
	}
}
