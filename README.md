# Image Relay API PHP Library

This is still a work in progress and is not complete.  If you would like to contribute to the project please fork the repo and create a pull request with your work.

## Installation

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
