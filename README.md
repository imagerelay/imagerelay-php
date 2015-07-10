# Image Relay API PHP Library

This is still a work in progress and is not complete.  If you would like to contribute to the project please fork the repo and create a pull request with your work.  Documentation will be updated as end points are added.

## Installation

We recommend using composer to manage dependencies and installation of the Image Relay API PHP library.  If you are unfamiliar with composer you can read about installation into your application here - [Composer Install How To](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

#####Edit composer.json and include the following:
```json
	"repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/imagerelay/imagerelay-php"
        }
    ],
    "require": {
    	"imagerelay/imagerelay-php": "dev-master"
    }
```
#####Run the following command from your console
```php
	$ php composer.phar install
```

##Usage
To use the library you only need to have an Image Relay account with proper permissions to complete the API actions. 

#####Authorization with username and password
```php
<?php
	require_once 'vendor/autoload.php';

	$client = ImageRelay\ImageRelayClient::factory(array(
	    'auth' => 'http',
	    'username' => 'username',
	    'password' => 'password',
	    'app_name' => 'Awesome APP',
	    'app_contact' => 'http://www.awesomeapp.com'
	));
?>
```

#####Authorization with oAuth
When authorizing with oauth you will need to use one of the many existing libraries available to retrieve your oauth access token.  The Image Relay API adheres to oauth standars for authentication.

```php
<?php
	require_once 'vendor/autoload.php';

	$client = ImageRelay\ImageRelayClient::factory(array(
	    'auth' => 'oauth',
	    'token' => '08dfsafd8asdf8asdf90as8df90df8',
	    'app_name' => 'Awesome APP',
	    'app_contact' => 'http://www.awesomeapp.com'
	));
?>
```
###Files
[Image Relay API: Files](https://github.com/imagerelay/api/blob/master/sections/files.md)

#####Get Files from Folder
```php
	$response = $client->getFiles( array(
		'folder_id' => 8363117,
		'page' => 2,
	));
```

#####Get File
```php
	$response = $client->getFile( array(
		'id' => 8363117,
	));
```

#####Upload File from URL
```php
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
```

###Folders
[Image Relay API: Folders](https://github.com/imagerelay/API/blob/master/sections/folders.md)

#####Get Folders

###### Top Level Folders
```php
$response = $client->getFolders();
```

###### Children of Parent Folder
```php
$response = $client->getChildFolders( array(
	'folder_id' => 191678,
));
```

###### Root Folder
```php
$response = $client->getRootFolder();
```

##### Get Folder
```php
$response = $client->getFolder( array(
	'folder_id' => 191678,
));
```

##### Create Folder
```php
$response = $client->createFolder( array(
	'folder_id' => 191678,
	'name' => 'Testing Folder Create',
));
```

##### Update Folder
```php
$response = $client->updateFolder( array(
	'folder_id' => 290503,
	'name' => 'New Folder Create',
));
```

###File Types
[Image Relay API: File Types](https://github.com/imagerelay/API/blob/master/sections/file_types.md)
#####Get File Types
```php
$response = $client->getFileTypes();
```

#####Get File Type
```php
$response = $client->getFileType( array(
	'id' => 290503,
));
```

###Folder Links
[Image Relay API: Folder Links](https://github.com/imagerelay/API/blob/master/sections/folder_links.md)
#####Get Folder Links
```php
$response = $client->getFolderLinks( array(
	'page' => 2,
));
```

#####Get Folder Link
```php
$response = $client->getFolderLink( array(
	'id' => 290503,
));
```

#####Create Folder Link
```php
$response = $client->createFolderLink( array(
	'folder_id' => 290503,
	'allows_download' => true,
	'expires_on' => '2015-07-15',
	'show_tracking' => true,
	'purpose' => 'Download for spring catalog images',
));
```

#####Delete Folder Link
```php
$response = $client->deleteFolderLink( array(
	'id' => 290503,
));
```

###Invited Users
[Image Relay API: Invited Users](https://github.com/imagerelay/API/blob/master/sections/invited_users.md)
#####Get Invited Users
```php
$response = $client->getInvitedUsers( array(
	'page' => 2,
));
```

#####Get Invited User
```php
$response = $client->getInvitedUser( array(
	'id' => 290503,
));
```

#####Invite New User
```php
$response = $client->inviteNewUser( array(
	'first_name' => 'First Name',
	'last_name' => 'Last Name',
	'email' => 'example@imagerelay.com',
	'company' => 'Image Relay',
	'permission_id' => 167,
));
```

#####Delete Invited User
```php
$response = $client->deleteInvitedUser( array(
	'id' => 290503,
));
```

###Permissions
[Image Relay API: Permissions](https://github.com/imagerelay/api/blob/master/sections/permissions.md#permissions)
#####Get Permissions
```php
$response = $client->getPermissions( array(
	'page' => 2,
));
```

#####Get Permission
```php
$response = $client->getPermission( array(
	'id' => 290503,
));
```

###Quick Links
[Image Relay API: Quick Links](https://github.com/imagerelay/API/blob/master/sections/quick_links.md)
#####Get Quick Links
```php
$response = $client->getQuickLinks( array(
	'page' => 2,
));
```

#####Get Quick Link
```php
$response = $client->getQuickLink( array(
	'id' => 290503,
));
```

#####Create Quick Link
```php
$response = $client->createQuickLink( array(
	'asset_id' => 290503,
	'purpose' => 'Download for spring catalog images',
));
```

#####Delete Quick Link
```php
$response = $client->deleteQuickLink( array(
	'id' => 290503,
));
```

###Upload Links
[Image Relay API: Upload Links](https://github.com/imagerelay/API/blob/master/sections/upload_links.md)
#####Get Upload Links
```php
$response = $client->getUploadLinks( array(
	'page' => 2,
));
```

#####Get Upload Link
```php
$response = $client->getUploadLink( array(
	'id' => 290503,
));
```

#####Create Upload Link
```php
$response = $client->createUploadLink( array(
	'folder_id' => 290503,
	'purpose' => 'Download for spring catalog images',
));
```

#####Delete Upload Link
```php
$response = $client->deleteUploadLink( array(
	'id' => 290503,
));
```