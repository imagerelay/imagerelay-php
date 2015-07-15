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

    public function testGetFolders()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'get_folders'
        ));

        $response = $client->getFolders();

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(11136, $response[0]['id']);
        $this->assertSame(11150, $response[1]['id']);
    }

    public function testGetChildFolders()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'get_folders'
        ));

        $response = $client->getChildFolders( array(
            'folder_id' => 191678,
        ));

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(11136, $response[0]['id']);
        $this->assertSame(11150, $response[1]['id']);
    }

    public function testGetRootFolder()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'get_folders'
        ));

        $response = $client->getRootFolder();

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(11136, $response[0]['id']);
        $this->assertSame(11150, $response[1]['id']);
    }

    public function testGetFolder()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'get_folder'
        ));

        $response = $client->getFolder( array(
            'folder_id' => 19678,
        ));   

        $this->assertSame(11136, $response['id']);
    }
     /**
     * @expectedException Guzzle\Service\Exception\ValidationException
     */
    public function testShoulFailToGetFolderWithoutFolderID()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'get_folder'
        ));

        $response = $client->getFolder( array(
    
        ));   
    }

    public function testCreateFolder()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'create_folder'
        ));

        $response = $client->createFolder( array(
            'folder_id' => 191678,
            'name' => 'Testing Folder Create',
        ));

        $this->assertSame(11136, $response['id']);
    }

    /**
     * @expectedException Guzzle\Service\Exception\ValidationException
     */
    public function testShouldFailToCreateFolderWithoutName()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'create_folder'
        ));

        $response = $client->createFolder( array(
            'folder_id' => 191678,
        ));
    }

    public function testUpdateFolder()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'create_folder'
        ));

        $response = $client->updateFolder( array(
            'folder_id' => 191678,
            'name' => 'Testing Folder Update',
        ));

        $this->assertSame('Testing Folder Update', $response['name']);
    }

    /**
     * @expectedException Guzzle\Service\Exception\ValidationException
     */
    public function testShouldFailToUpdateFolderWithoutName()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'create_folder'
        ));

        $response = $client->updateFolder( array(
            'folder_id' => 191678,
        ));
    }

    public function testShouldGetFileTypes()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'get_file_types'
        ));

        $response = $client->getFileTypes();
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame('Action A1', $response[0]['name']);
        $this->assertSame('Meta Data', $response[1]['name']);   
    }

    public function testShouldGetFileType()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'get_file_type'
        ));

        $response = $client->getFileType( array(
            'id' => 149,
        ));

        $this->assertSame('Action A1', $response['name']);
    }

    /**
     * @expectedException Guzzle\Service\Exception\ValidationException
     */
    public function testShouldFailToGetFileType()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'get_file_type'
        ));

        $response = $client->getFileType( array(
        ));
    }
}
