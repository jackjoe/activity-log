<?php

return [
  /**
	 * Auto Set User ID
	 *
	 * If false, user ID will not be automatically set.
   */
	'auto_set_user_id' => true,

  /**
   * Auth Method
   *
   * If you are using any alternative packages for Authentication
   * and User management then you can put in the appropriate
   * function to get the currently logged in user.
   * For example, if you are using Sentry,
   * you would put Sentry::getUser()
   * instead of Laravel's default which is Auth::user().
   */
	'auth_method' => '\Auth::user',

  /**
   * Default Values
   */
	'defaults' => [
	],

  /**
   * Name
   */
	'names' => [
		'unknown'   => 'Unknown User',
	],

  /**
   * Full Name as Name
   *
   * If "full_name_as_name" is true,
   * the "first_name" and "last_name" attributes
   * are concantenated together, separated by a space.
   * If false, the "username" attribute of the user is used
   * as the name instead. If "full_name_last_name_first" is set,
   * the name will be displayed like
   * "Smith, John" instead of "John Smith".
   */
	'full_name_as_name'         => true,
	'full_name_last_name_first' => false,

];
