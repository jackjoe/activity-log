<?php namespace JackJoe\ActivityLog\Test;

use Auth;
use Illuminate\Support\Collection;

use JackJoe\ActivityLog\Models\Activity;
use JackJoe\ActivityLog\Test\Models\User;

class ActivityLogTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();
  }

  /**
   * check ip address
   * check user agent
   * check version set
   */

  /** @test */
  public function it_returns_instance_of_activity_model()
  {
    $result = Activity::log(['contentType' => 'Something']);

    $this->assertInstanceOf(Activity::class, $result);
  }

  /** @test */
  public function it_has_a_relation_to_a_user()
  {
    $user = User::first();
    $result = Activity::log(['contentType' => 'Something', 'userId' => $user->id]);

    $this->assertInstanceOf(User::class, $result->user);
    $this->assertEquals($user->id, $result->user->id);
  }

  /** @test */
  public function it_has_a_relation_to_the_logged_in_user_when_not_provided_with_userid()
  {
    $user = User::first();
    Auth::login($user);
    $result = Activity::log(['contentType' => 'Something']);

    $this->assertInstanceOf(User::class, $result->user);
    $this->assertEquals($user->id, $result->user->id);
  }

  /** @test */
  public function it_will_save_all_fields()
  {
    $user = User::first();
    Auth::login($user);
    $result = Activity::log([
      'contentType' => 'NewsItem',
      'contentId' => 1,
      'description' => 'Something',
      'details' => 'DETAILS',
      'data' => ['iets' => (object) ['prop' => 2, 'erty' => 3]]
    ]);

    $result->setHidden(['id', 'created_at', 'updated_at']);
    $this->assertEquals([
      "content_type" => "NewsItem",
      "content_id" => 1,
      "description" => "Something",
      "details" => "DETAILS",
      "data" => '{"iets":{"prop":2,"erty":3}}',
      "user_id" => 1,
      "ip_address" => "127.0.0.1",
      "user_agent" => "No User Agent",
    ], $result->toArray());
  }
}
