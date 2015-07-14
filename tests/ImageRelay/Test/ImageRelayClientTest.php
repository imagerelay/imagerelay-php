<?php
/*
* (c) Netvlies Internetdiensten
*
* Richard van den Brand <richard@netvlies.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

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
