ActivityLog
===========

- [Installation](#installation)
- [Basic Usage](#basic-usage)

<a name="installation"></a>
## Installation

**Basic installation, service provider registration, and aliasing:**

To install ActivityLog, make sure "jackjoe/activity-log" has been added to Laravel 5's `composer.json` file.

	"require": {
		"regulus/activity-log": "0.1.*"
	},

Then run `php composer.phar update` from the command line. Composer will install the ActivityLog package. Now, all you have to do is register the service provider and set up ActivityLog's alias. In `app/config/app.php`, add this to the `providers` array:

	JackJoe\ActivityLog\ActivityLogServiceProvider::class,

And add this to the `aliases` array:

	'Activity' => JackJoe\ActivityLog\Models\Activity::class,

**Publishing migrations and configuration:**

To publish this package's configuration and migrations, run this from the command line:

	php artisan vendor:publish

> **Note:** Migrations are only published; remember to run them when ready.

To run migration to create ActivityLog's table, run this from the command line:

	php artisan migrate

<a name="basic-usage"></a>
## Basic Usage

**Logging user activity:**

```php
	Activity::log([
		'contentId'   => $user->id,
		'contentType' => 'User',
		'action'      => 'ACTION',
		'description' => 'SUCCESS
		'details'     => 'Username: ' . $user->username,
		'data'        => json_encode($data)
	]);
```

The above code will log an activity for the currently logged in user. The IP address will automatically be saved as well and the `developer` flag will be set if the user has a `developer` session variable set to `true`. This can be used to differentiate activities between the developer and the website administrator. The `updated` boolean, if set to `true`, will replace all instances of "Create" or "Add" with "Update" in the `description` and `details` fields.
