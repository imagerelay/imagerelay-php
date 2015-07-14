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
            'app_contact' => 'test@test.com',
            'imagerelay_url' => 'test.imagerelay.com'
        ));

        $this->assertEquals('https://test.imagerelay.com/api/v2/', $client->getBaseUrl());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testFactoryInitializesClientWithInvalidAuth()
    {
        $client = ImageRelayClient::factory(array(
            'auth'          => 'invalid_auth',
            'username'      => 'username',
            'password'      => 'password',
            'app_name'      => 'Test',
            'app_contact'   => 'test@test.com',
            'imagerelay_url' => 'test.imagerelay.com'
        ));
    }

    public function testFactoryInitializesClientBasicAuth()
    {
        $client = ImageRelayClient::factory(array(
            'auth'          => 'http',
            'username'      => 'username',
            'password'      => 'password',
            'app_name'      => 'Test',
            'app_contact'   => 'test@test.com',
            'imagerelay_url' => 'test.imagerelay.com'
        ));

        $request = $client->get();
        $this->assertEquals('Test (test@test.com)', (string)$request->getHeader('User-Agent'));
    }

    public function testFactoryInitializesClientOAuth()
    {
        $client = ImageRelayClient::factory(array(
            'auth'          => 'oauth',
            'token'      => '0f8d09dafs80da9fs80daf',
            'app_name'      => 'Test',
            'app_contact'   => 'test@test.com',
            'imagerelay_url' => 'test.imagerelay.com'
        ));

        $request = $client->get();
        $this->assertEquals('Test (test@test.com)', (string)$request->getHeader('User-Agent'));
    }

    public function testGetFilesFromFolder()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'get_files_from_folder'
        ));

        $response = $client->getFiles( array(
            'folder_id' => 8363117,
        ));

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(2222, $response[0]['id']);
        $this->assertSame(1234, $response[1]['id']);
    }

    public function testGetFile()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'get_file'
        ));

        $response = $client->getFile( array(
            'id' => 8363117,
        ));

        $this->assertSame(2222, $response['id']);
    }

    public function testUploadFileFromURL()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'upload_file_from_url'
        ));

        $response = $client->uploadFileFromURL( array(
            'filename' => 'test.jpg',
            'folder_id' => 285356,
            'file_type_id' => 1464,
            'terms' => array(
                'term_id' => '145',
                'value' => 'Test Value',
            ),
            'url' => 'https://upload.wikimedia.org/wikipedia/commons/5/55/Atelopus_zeteki1.jpg'
        ));

        $this->assertSame(242802, $response['id']);
    }

    /**
     * @expectedException Guzzle\Service\Exception\ValidationException
     */
    public function testShouldFailToUploadFileFromURL()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'upload_file_from_url'
        ));

        $response = $client->uploadFileFromURL( array(
            'filename' => 'test.jpg',
            'file_type_id' => 1464,
            'terms' => array(
                'term_id' => '145',
                'value' => 'Test Value',
            ),
            'url' => ''
        ));
    }
}
