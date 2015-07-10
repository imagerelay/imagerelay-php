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
```code
	$ php composer.phar install
```

##Usage
To use the library you only need to have an Image Relay account with proper permissions to complete the API actions. 

#####Authorization with username and password
```code
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

```code
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

#####Get Files from Folder
```code
	$response = $client->getFiles( array(
		'folder_id' => 8363117,
		'page' => 2,
	));
```

#####Get File
```code
	$response = $client->getFile( array(
		'id' => 8363117,
	));
```

#####Upload File from URL
```code
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

#####Get Folders

###### Top Level Folders
```code
$response = $client->getFolders();
```

###### Children of Parent Folder
```code
$response = $client->getChildFolders( array(
	'folder_id' => 191678,
));
```

###### Root Folder
```code
$response = $client->getRootFolder();
```

##### Get Folder
```code
$response = $client->getFolder( array(
	'folder_id' => 191678,
));
```

##### Create Folder
```code
$response = $client->createFolder( array(
	'folder_id' => 191678,
	'name' => 'Testing Folder Create',
));
```

##### Update Folder
```code
$response = $client->updateFolder( array(
	'folder_id' => 290503,
	'name' => 'New Folder Create',
));
```

###File Types

#####Get File Types
```code
$response = $client->getFileTypes();
```

#####Get File Type
```code
$response = $client->getFileType( array(
	'id' => 290503,
));
```

###Folder Links

#####Get Folder Links
```code
$response = $client->getFolderLinks( array(
	'page' => 2,
));
```

#####Get Folder Link
```code
$response = $client->getFolderLink( array(
	'id' => 290503,
));
```

#####Create Folder Link
```code
$response = $client->createFolderLink( array(
	'folder_id' => 290503,
	'allows_download' => true,
	'expires_on' => '2015-07-15',
	'show_tracking' => true,
	'purpose' => 'Download for spring catalog images',
));
```

#####Delete Folder Link
```code
$response = $client->deleteFolderLink( array(
	'id' => 290503,
));
```

###Invited Users

#####Get Invited Users
```code
$response = $client->getInvitedUsers( array(
	'page' => 2,
));
```

#####Get Invited User
```code
$response = $client->getInvitedUser( array(
	'id' => 290503,
));
```

#####Invite New User
```code
$response = $client->inviteNewUser( array(
	'first_name' => 'First Name',
	'last_name' => 'Last Name',
	'email' => 'example@imagerelay.com',
	'company' => 'Image Relay',
	'permission_id' => 167,
));
```

#####Delete Invited User
```code
$response = $client->deleteInvitedUser( array(
	'id' => 290503,
));
```

