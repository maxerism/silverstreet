<?php

namespace Silverstreet\TestCase;

use Mockery as m;
use Silverstreet\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class ResponseTest extends TestCase
{
    /**
     * Teardown the test environment.
     */
    protected function tearDown(): void
    {
        m::close();
    }

    /**
     * @test
     * @expectedException \DomainException
     * @expectedExceptionMessage Unable to convert response to array!
     */
    public function it_cant_be_converted_to_array()
    {
        $message = m::mock(ResponseInterface::class);

        $message->shouldReceive('getStatusCode')->andReturn(200);
        $message->shouldReceive('getBody')->andReturn('01');

        (new Response($message))->toArray();
    }
}
