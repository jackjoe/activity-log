<?php

return [
  /**
   * Auto Set User ID
   *
   * If false, user ID will not be automatically set.
   */
  'auto_set_user_id' => true,

  /**
   * Auth driver
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

];
