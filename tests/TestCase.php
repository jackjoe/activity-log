<?php namespace JackJoe\ActivityLog\Test;

use JackJoe\ActivityLog\ActivityLogServiceProvider;
use JackJoe\ActivityLog\Models\Activity;
use JackJoe\ActivityLog\Test\Models\User;

use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
  public function setUp()
  {
    parent::setUp();

    $this->setUpDatabase();
  }

  protected function checkRequirements()
  {
    parent::checkRequirements();

    collect($this->getAnnotations())->filter(function ($location) {
      return in_array('!Travis', array_get($location, 'requires', []));
    })->each(function ($location) {
      getenv('TRAVIS') && $this->markTestSkipped('Travis will not run this test.');
    });
  }

  protected function getPackageProviders($app)
  {
    return [
      ActivityLogServiceProvider::class,
    ];
  }

  public function getEnvironmentSetUp($app)
  {
    $app['config']->set('database.default', 'sqlite');
    $app['config']->set('database.connections.sqlite', [
      'driver' => 'sqlite',
      'database' => $this->getTempDirectory() . '/database.sqlite',
    ]);
    $app['config']->set('auth.providers.users.model', User::class);
    $app['config']->set('app.key', 'base64:Tf2nw411tVPSW+BbaP/J8jyq16F+pthL22cklefGN+0=');
  }

  protected function setUpDatabase()
  {
    $this->resetDatabase();
    $this->createActivityLogTable();
    $this->createTableUsers();
    $this->seedUsers();
  }

  protected function resetDatabase()
  {
    file_put_contents($this->getTempDirectory() . '/database.sqlite', null);
  }

  protected function createActivityLogTable()
  {
    include_once '__DIR__' . '/../database/migrations/2017_06_03_133219_create_activity_log_table.php';

    (new \CreateActivityLogTable())->up();
  }

  public function getTempDirectory()
  {
    return __DIR__ . '/temp';
  }

  protected function createTableUsers()
  {
    $this->app['db']
      ->connection()
      ->getSchemaBuilder()
      ->create("users", function (Blueprint $table) {
        $table->increments('id');
        $table->string('name')->nullable();
        $table->string('text')->nullable();
        $table->timestamps();
        $table->softDeletes();
      });
  }

  protected function seedUsers()
  {
    foreach(range(1, 0) as $index) {
      User::create(['name' => "name {$index}"]);
    }
  }
}
