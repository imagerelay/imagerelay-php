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

    public function testShouldGetFolderLinks()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'get_folder_links'
        ));

        $response = $client->getFolderLinks();
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame('testing api creation', $response[0]['purpose']);
        $this->assertSame('testing api creation', $response[1]['purpose']);
    }

    public function testShouldGetFolderLink()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'get_folder_link'
        ));

        $response = $client->getFolderLink( array(
            id => 53,
        ));

        $this->assertSame('testing api creation', $response['purpose']);
    }

    /**
     * @expectedException Guzzle\Service\Exception\ValidationException
     */
    public function testShouldFailToGetFolderLink()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'get_folder_link'
        ));

        $response = $client->getFolderLink( array(
        ));
    }

    public function testShouldCreateFolderLink()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'get_folder_link'
        ));

        $response = $client->createFolderLink( array(
            'folder_id' => 290503,
            'allows_download' => true,
            'expires_on' => '2015-07-15',
            'show_tracking' => true,
            'purpose' => 'testing api creation',
        ));

        $this->assertSame('testing api creation', $response['purpose']);
        $this->assertTrue($response['allows_download']);
    }

    public function testShouldDeleteFolderLink()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'delete_folder_link'
        ));

        $response = $client->deleteFolderLink( array(
            'id' => 290503,
        ));
    }

    public function testShouldGetInvitedUsers()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'invited_users'
        ));

        $response = $client->getInvitedUsers();

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame('First Name', $response[0]['first_name']);
        $this->assertSame('API Test Company', $response[1]['company']);
    }

    public function testShouldGetInvitedUser()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'invited_user'
        ));

        $response = $client->getInvitedUser( array(
            'id' => 99,
        ));

        $this->assertSame('First Name', $response['first_name']);
    }

    public function testShouldInviteANewUser()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'invited_user'
        ));

        $response = $client->inviteNewUser( array(
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'example@imagerelay.com',
            'company' => 'API Test Company',
            'permission_id' => 167,
        ));

        $this->assertSame('First Name', $response['first_name']);
    }

    public function testShouldDeleteAInvitedUser()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'invited_user'
        ));

        $response = $client->getInvitedUser( array(
            'id' => 99,
        ));
    }

    public function testShouldGetPermissions()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'permissions'
        ));

        $response = $client->getPermissions( array(
            'page' => 2,
        ));

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame('IR ADMIN', $response[0]['name']);
        $this->assertSame(145, $response[1]['id']);
    }

    public function testShouldGetPermission()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'permission'
        ));

        $response = $client->getPermissions( array(
            'id' => 145,
        ));

        $this->assertSame(145, $response['id']);
    }

    public function testShouldGetQuickLinks()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'quick_links'
        ));

        $response = $client->getQuickLinks( array(
            'page' => 2,
        ));

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame('https://your_url.imagerelay.com/ql/283f889bb3424fce814577d0d87979zd/00007-a_52x78_72_RGB.jpg', $response[0]['url']);
        $this->assertSame(365, $response[0]['id']);
    }

    public function testShouldGetQuickLink()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'quick_link'
        ));

        $response = $client->getQuickLink( array(
            'id' => 365,
        ));

        $this->assertSame('https://your_url.imagerelay.com/ql/283f889bb3424fce814577d0d87979zd/00007-a_52x78_72_RGB.jpg', $response['url']);
    }

    public function testShouldCreateQuickLink()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'quick_link'
        ));

        $response = $client->createQuickLink( array(
            'asset_id' => 290503,
            'purpose' => 'Download for spring catalog images',
        ));

        $this->assertSame('https://your_url.imagerelay.com/ql/283f889bb3424fce814577d0d87979zd/00007-a_52x78_72_RGB.jpg', $response['url']);
    }

    /**
     * @expectedException Guzzle\Service\Exception\ValidationException
     */
    public function testShouldFailToCreateQuickLink()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'quick_link'
        ));

        $response = $client->createQuickLink( array(
            'purpose' => 'Download for spring catalog images',
        ));
        
        $this->assertSame('https://your_url.imagerelay.com/ql/283f889bb3424fce814577d0d87979zd/00007-a_52x78_72_RGB.jpg', $response['url']);
    }

    public function testShouldDeleteQuickLink()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'quick_link'
        ));

        $response = $client->deleteQuickLink( array(
            'id' => 290503,
        ));
    }

    //UPLOADLINKS
    public function testShouldGetUploadLinks()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'upload_links'
        ));

        $response = $client->getUploadLinks( array(
            'page' => 2,
        ));

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame('http://your_url.imagerelay.com/ul/cbd72b7d310744c482847ac4a3d8dcc5', $response[0]['upload_link_url']);
        $this->assertSame(23, $response[1]['id']);
    }

    public function testShouldGetUploadLink()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'upload_link'
        ));

        $response = $client->getUploadLink( array(
            'id' => 23,
        ));

        $this->assertSame('http://your_url.imagerelay.com/ul/cbd72b7d310744c482847ac4a3d8dcc5', $response['upload_link_url']);
    }

    public function testShouldCreateUploadLink()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'upload_link'
        ));

        $response = $client->createUploadLink( array(
            'folder_id' => 290503,
            'purpose' => 'Upload for spring catalog images',
        ));

        $this->assertSame('http://your_url.imagerelay.com/ul/cbd72b7d310744c482847ac4a3d8dcc5', $response['upload_link_url']);
    }

    /**
     * @expectedException Guzzle\Service\Exception\ValidationException
     */
    public function testShouldFailToCreateUploadLink()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'upload_link'
        ));

        $response = $client->createUploadLink( array(
            'purpose' => 'Upload location for spring catalog images',
        ));
    }

    public function testShouldDeleteUploadLink()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'upload_link'
        ));

        $response = $client->deleteUploadLink( array(
            'id' => 290503,
        ));
    }

    public function testShouldGetUsers()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'users'
        ));

        $response = $client->getUsers( array(
            'page' => 2,
        ));

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('id', $response[0]);
        $this->assertSame(1, $response[0]['id']);
        $this->assertSame(405, $response[1]['id']);
    }

    public function testShouldGetUser()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'user'
        ));

        $response = $client->getUser( array(
            'id' => 1,
        ));

        $this->assertSame(1, $response['id']);
    }

    public function testShouldGetWebhooks()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'webhooks'
        ));

        $response = $client->getWebhooks();

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('action', $response[0]);
        $this->assertSame('file', $response[0]['resource']);
        $this->assertSame('file', $response[1]['resource']);
    }

    public function testShouldGetWebhook()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'webhook'
        ));

        $response = $client->getWebhook( array(
            'id' => 51
        ));

        $this->assertSame('file', $response['resource']);
    }

    public function testShouldCreateAWebhook()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'webhook'
        ));

        $response = $client->getWebhook( array(
            'id' => 51
        ));

        $this->assertSame('file', $response['resource']);
    }

    public function testShouldDeleteAWebhook()
    {
        $client = $this->getServiceBuilder()->get('imagerelay');
        $this->setMockResponse($client, array(
            'webhook'
        ));

        $response = $client->deleteWebhook( array(
            'id' => 51
        ));
    }


}
