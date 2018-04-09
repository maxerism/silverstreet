<?php

namespace Silverstreet\TestCase\One;

use Mockery as m;
use Silverstreet\Client;
use PHPUnit\Framework\TestCase;
use Laravie\Codex\Testing\Faker;

class MessageTest extends TestCase
{
    /**
     * Teardown the test environment.
     */
    protected function tearDown(): void
    {
        m::close();
    }

    /** @test */
    public function it_can_send_message()
    {
        $body = [
            'username' => 'foo',
            'password' => 'bar',
        ];

        $faker = Faker::create()
                    ->stream('POST', m::type('Array'))
                    ->expectEndpointIs('https://api.silverstreet.com/send.php')
                    ->shouldResponseWith(200, '1');

        $client = new Client($faker->http(), $body['username'], $body['password']);

        $response = $client->uses('Message')->text('Hello world', '+60123456789', 'KATSANA');

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('1', $response->getBody());
    }
}
