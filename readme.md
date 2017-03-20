ActivityLog
===========

Based on `Regulus/ActivityLog`.

- [Installation](#installation)
- [Basic Usage](#basic-usage)

<a name="installation"></a>
## Installation

**Basic installation, service provider registration, and aliasing:**

To install ActivityLog, make sure `jackjoe/activity-log` has been added to Laravel 5's `composer.json` file or:

```
$ composer require sentry/sentry-laravel
```

Add the ActivityLog service provider and facade in `config/app.php`:

```
'providers' => array(
  // ...
  JackJoe\ActivityLog\ActivityLogServiceProvider::class,
)

'aliases' => array(
  // ...
  'Activity' => JackJoe\ActivityLog\Models\Activity::class,
)
```

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

The above code will log an activity for the currently logged in user. The IP address will automatically be saved as well.

### Variable guidelines

- `contentType`: type of content we are dealing with, can be set to match PHP class, controller, model, ... It gives us more context where this action has taken place.
- `contentId` (option): id of content, in case of a model
- `action`: method name, sub-action in method, ..
- `description`: state of action such as `ERROR`, `SUCCESS`, `WRONG_CODE`, ...
- `details`: more like meta date about current state
- `data`: raw data, fetched content, posted content, ...
