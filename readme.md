# ActivityLog

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jackjoe/activity-log.svg?style=flat-square)](https://packagist.org/packages/jackjoe/activity-log)
[![Build Status](https://travis-ci.org/jackjoe/activity-log.svg?branch=master)](https://travis-ci.org/jackjoe/activity-log)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jackjoe/activity-log/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jackjoe/activity-log/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/jackjoe/activity-log.svg?style=flat-square)](https://packagist.org/packages/jackjoe/activity-log)
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bhttps%3A%2F%2Fgithub.com%2Fjackjoe%2Factivity-log.svg?type=shield)](https://app.fossa.io/projects/git%2Bhttps%3A%2F%2Fgithub.com%2Fjackjoe%2Factivity-log?ref=badge_shield)

- [Installation](#installation)
- [Basic Usage](#basic-usage)

<a name="installation"></a>
## Installation

### Basic installation, service provider registration, and aliasing:

To install the package, make sure `jackjoe/activity-log` has been added to Laravel 5's `composer.json` file.

	"require": {
		"jackjoe/activity-log": "0.2.*"
	},

Then run `php composer.phar update` from the command line. Composer will install the ActivityLog package. Now, all you have to do is register the service provider and set up ActivityLog's alias. In `app/config/app.php`, add this to the `providers` array:

	JackJoe\ActivityLog\ActivityLogServiceProvider::class,

And add this to the `aliases` array:

	'Activity' => JackJoe\ActivityLog\Models\Activity::class,

### Publishing migrations and configuration:

To publish this package's configuration and migrations, run this from the command line:

	php artisan vendor:publish

> **Note:** Migrations are only published; remember to run them when ready.

To run migration to create ActivityLog's table, run this from the command line:

	php artisan migrate

<a name="basic-usage"></a>
## Basic Usage

### Logging user activity:

```php
Activity::log([
  'contentId'   => $user->id,
  'content' => 'User',
  'action'      => 'ACTION',
  'state'       => 'SUCCESS
  'details'     => 'Username: ' . $user->username,
  'data'        => json_encode($data)
]);
```

The above code will log an activity for the currently logged in user. The IP address will automatically be saved as well.

### Variable guidelines

- `content`: type of content we are dealing with, can be set to match PHP class, controller, model, ... It gives us more context where this action has taken place.
- `contentId` (option): id of content, in case of a model
- `action`: method name, sub-action in method, ..
- `state`: state of action such as `ERROR`, `SUCCESS`, `WRONG_CODE`, ...
- `details`: more like meta date about current state
- `data`: raw data, fetched content, posted content, ...

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

Based on `Regulus/ActivityLog`.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bhttps%3A%2F%2Fgithub.com%2Fjackjoe%2Factivity-log.svg?type=large)](https://app.fossa.io/projects/git%2Bhttps%3A%2F%2Fgithub.com%2Fjackjoe%2Factivity-log?ref=badge_large)