# ActivityLog

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jackjoe/activity-log.svg?style=flat-square)](https://packagist.org/packages/jackjoe/activity-log)
[![Build Status](https://travis-ci.org/jackjoe/activity-log.svg?branch=master)](https://travis-ci.org/jackjoe/activity-log)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jackjoe/activity-log/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jackjoe/activity-log/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/jackjoe/activity-log.svg?style=flat-square)](https://packagist.org/packages/jackjoe/activity-log)

* [Installation](#installation)
* [Basic Usage](#basic-usage)

<a name="installation"></a>

## Installation

### Basic installation, service provider registration, and aliasing:

Installation is done with composer, so add the package to your`composer.json`
file:

    "require": {
    	"jackjoe/activity-log": "0.3.*"
    },

Then run `composer update`

#### Laravel 5.5+

Laravel 5.5 has auto discovery, you are done. If not see below.

#### <= Laravel 5.4

Register the service provider and alias in `app/config/app.php`. Add the
following to the `providers` array:

    JackJoe\ActivityLog\ActivityLogServiceProvider::class,

And add this to the `aliases` array:

    'Activity' => JackJoe\ActivityLog\Models\Activity::class,

### Publishing migrations and configuration:

To publish this package's configuration, run this from the command line:

    php artisan vendor:publish --provider="JackJoe\ActivityLog\ActivityLogServiceProvider"

> **Note:** Migrations are only published; remember to run them when ready.

To run migration to create ActivityLog's table, run this from the command line:

    php artisan migrate

<a name="basic-usage"></a>

## Basic Usage

### Logging user activity:

```php
Activity::log([
  'contentId'   => $user->id,
  'content' => 'User',
  'action'      => 'ACTION',
  'state'       => 'SUCCESS',
  'details'     => 'Username: ' . $user->username,
  'data'        => json_encode($data)
]);
```

The above code will log an activity for the currently logged in user. The IP
address will automatically be saved as well.

### Variable guidelines

* `content`: type of content we are dealing with, can be set to match PHP class,
  controller, model, ... It gives us more context where this action has taken
  place.
* `contentId` (option): id of content, in case of a model
* `action`: method name, sub-action in method, ..
* `state`: state of action such as `ERROR`, `SUCCESS`, `WRONG_CODE`, ...
* `details`: more like meta date about current state
* `data`: raw data, fetched content, posted content, ...

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

Based on `Regulus/ActivityLog`.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more
information.
