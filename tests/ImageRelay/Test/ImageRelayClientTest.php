<?php
namespace ImageRelay\Test;

use ImageRelay\ImageRelayClient;

class ImageRelayClientTest extends \Guzzle\Tests\GuzzleTestCase
{
    public function testFactoryInitializesClient()
    {
        $client = ImageRelayClient::factory(array(
            'auth'        => 'http',
            'username'    => 'username',
            'password'    => 'password',
            'app_name'    => 'Test',
            'app_contact' => 'test@test.com'
        ));

        $this->assertEquals('https://subdomain.imagerelay.com/api/v2/', $client->getBaseUrl());
    }

}
