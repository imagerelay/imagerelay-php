<?php
    return array(
        'serviceFullName'       => 'ImageRelay API',
        'serviceAbbreviation'   => 'IRAPI',
        'operations'            => array(
            /* FILES */
            /* getFiles */
            'getFiles' => array(
                'httpMethod' => 'GET',
                'uri' => 'folders/{folder_id}/files.json',
                'summary' => 'Get files in a specific folder' . PHP_EOL . '[ImageRelay API: Files](https://github.com/imagerelay/api/blob/master/sections/files.md#get-files)',
                'parameters' => array(
                    'folder_id' => array(
                        'location' => 'uri',
                        'description' => 'Folder ID',
                        'type' => 'integer',
                        'required' => true,
                    ),
                    'uploaded_after' => array(
                        'location' => 'json',
                        'description' => 'Will return files uploaded to designated folder.  Date format should be YYYY-MM-DD HH:MM:SS -- you can leave off the time if you want to start at the beginning of the day.',
                        'type' => 'string',
                        'required' => false,
                    ),
                    'page' => array(
                        'location' => 'query',
                        'description' => 'used to paginate pages.',
                        'type' => 'integer',
                        'required' => false,
                    )
                )
            ),
            
            /* getFile */
            'getFile' => array(
                'httpMethod' => 'GET',
                'uri' => 'files/{id}.json',
                'summary' => 'Get information about a specific file' . PHP_EOL . '[ImageRelay API: Files](https://github.com/imagerelay/api/blob/master/sections/files.md#get-file)',
                'parameters' => array(
                    'id' => array(
                        'location' => 'uri',
                        'description' => 'File ID',
                        'type' => 'integer',
                        'required' => true,
                    )
                )
            ),

            /* Upload File from URL */
            'uploadFileFromURL' => array(
                'httpMethod' => 'POST',
                'uri' => 'files.json',
                'summary' => 'Upload a file to a specific folder from a URL' . PHP_EOL . '[ImageRelay API: Files](https://github.com/imagerelay/api/blob/master/sections/files.md#upload-file-from-url)',
                'parameters' => array(
                    'filename' => array(
                        'location' => 'json',
                        'description' => 'Uploaded Filename',
                        'type' => 'string',
                        'required' => true,
                    ),
                    'folder_id' => array(
                        'location' => 'json',
                        'description' => 'Folder ID',
                        'type' => 'integer',
                        'required' => true,
                    ),
                    'file_type_id' => array(
                        'location' => 'json',
                        'description' => 'File Type ID',
                        'type' => 'integer',
                        'required' => true,
                    ),
                    'terms' => array(
                        'location' => 'json',
                        'description' => 'Metaterms',
                        'type' => array( 'array', 'object'),
                        'required' => true,
                    ),
                    'url' => array(
                        'location' => 'json',
                        'description' => 'URL where the file will be downloaded from',
                        'type' => 'string',
                        'required' => true,
                    )
                )
            ),

            /* FOLDERS */
            /* getFolders */
            'getFolders' => array(
                'httpMethod' => 'GET',
                'uri' => 'folders.json',
                'summary' => 'Get top level folders viewable by user' . PHP_EOL . '[ImageRelay API: Folders](https://github.com/imagerelay/api/blob/master/sections/folders.md#get-folders)',
            ),

            /* getChildFolders */
            'getChildFolders' => array(
                'httpMethod' => 'GET',
                'uri' => 'folders/{folder_id}/children.json',
                'summary' => 'Get child folders of a specified parent' . PHP_EOL . '[ImageRelay API: Folders](https://github.com/imagerelay/api/blob/master/sections/folders.md#get-folders)',
                'parameters' => array(
                    'folder_id' => array(
                        'location' => 'uri',
                        'description' => 'Folder ID',
                        'type' => 'integer',
                        'required' => true,
                    )
                )
            ),

            /* getRootFolder */
            'getRootFolder' => array(
                'httpMethod' => 'GET',
                'uri' => 'folders/root.json',
                'summary' => 'Get root of all the folders for user. This folder isnt visible in the UI, calling children on this folder is quivalent of calling getFolders' . PHP_EOL . '[ImageRelay API: Folders](https://github.com/imagerelay/api/blob/master/sections/folders.md#get-folders)',
            ),

            /* getFolder */
            'getFolder' => array(
                'httpMethod' => 'GET',
                'uri' => 'folders/{folder_id}.json',
                'summary' => 'Get specified folder.' . PHP_EOL . '[ImageRelay API: Folders](https://github.com/imagerelay/api/blob/master/sections/folders.md#get-folder)',
                'parameters' => array(
                    'folder_id' => array(
                        'location' => 'uri',
                        'description' => 'Folder ID',
                        'type' => 'integer',
                        'required' => true,
                    )
                )
            ),

            /* createFolder */
            'createFolder' => array(
                'httpMethod' => 'POST',
                'uri' => 'folders/{folder_id}/children.json',
                'summary' => 'Create a new folder that is a child of the specified parent folder.' . PHP_EOL . '[ImageRelay API: Folders](https://github.com/imagerelay/api/blob/master/sections/folders.md#get-folder)',
                'parameters' => array(
                    'folder_id' => array(
                        'location' => 'uri',
                        'description' => 'Folder ID',
                        'type' => 'integer',
                        'required' => true,
                    ),
                    'name' => array(
                        'location' => 'json',
                        'description' => 'Folder Name',
                        'type' => 'string',
                        'required' => true,
                    )
                )
            ),

            /* updateFolder */
            'updateFolder' => array(
                'httpMethod' => 'PUT',
                'uri' => 'folders/{folder_id}.json',
                'summary' => 'Update the specified folder.' . PHP_EOL . '[ImageRelay API: Folders](https://github.com/imagerelay/api/blob/master/sections/folders.md#update-folder)',
                'parameters' => array(
                    'folder_id' => array(
                        'location' => 'uri',
                        'description' => 'Folder ID',
                        'type' => 'integer',
                        'required' => true,
                    ),
                    'name' => array(
                        'location' => 'json',
                        'description' => 'Folder Name',
                        'type' => 'string',
                        'required' => true,
                    )
                )
            ),

            /* FILE TYPES */
            /* getFileTypes */
            'getFileTypes' => array(
                'httpMethod' => 'GET',
                'uri' => 'file_types.json',
                'summary' => 'Returns file types for the account' . PHP_EOL . '[ImageRelay API: File Types](https://github.com/imagerelay/api/blob/master/sections/file_types.md#get-file-types)',
            ),

            /* getFileType */
            'getFileType' => array(
                'httpMethod' => 'GET',
                'uri' => 'file_types/{id}.json',
                'summary' => 'Get specified file type.' . PHP_EOL . '[ImageRelay API: File Types](https://github.com/imagerelay/api/blob/master/sections/file_types.md#get-file-type)',
                'parameters' => array(
                    'id' => array(
                        'location' => 'uri',
                        'description' => 'File Type ID',
                        'type' => 'integer',
                        'required' => true,
                    )
                )
            ),

            /* FOLDER LINKS */
            /* getFolderLinks */
            'getFolderLinks' => array(
                'httpMethod' => 'GET',
                'uri' => 'folder_links.json',
                'summary' => 'Returns list of folder links associated with the account' . PHP_EOL . '[ImageRelay API: Folder Links](https://github.com/imagerelay/api/blob/master/sections/folder_links.md#get-folder-links-)',
                'parameters' => array(
                    'page' => array(
                        'location' => 'query',
                        'description' => 'used to paginate pages.',
                        'type' => 'integer',
                        'required' => false,
                    )
                )
            ),

            /* getFolderLink */
            'getFolderLink' => array(
                'httpMethod' => 'GET',
                'uri' => 'folder_links/{id}.json',
                'summary' => 'Get specified folder link.' . PHP_EOL . '[ImageRelay API: Folder Links](https://github.com/imagerelay/api/blob/master/sections/folder_links.md#get-folder-link)',
                'parameters' => array(
                    'id' => array(
                        'location' => 'uri',
                        'description' => 'Folder Link ID',
                        'type' => 'integer',
                        'required' => true,
                    )
                )
            ),

            /* createFolderLink */
            'createFolderLink' => array(
                'httpMethod' => 'POST',
                'uri' => 'folder_links.json',
                'summary' => 'Create a new folder link.' . PHP_EOL . '[ImageRelay API: Folder Links](https://github.com/imagerelay/api/blob/master/sections/folder_links.md#create-folder-links)',
                'parameters' => array(
                    'folder_id' => array(
                        'location' => 'json',
                        'description' => 'Folder ID that the link will be created for',
                        'type' => 'integer',
                        'required' => true,
                    ),
                    'allows_download' => array(
                        'location' => 'json',
                        'description' => 'Boolean that sets a flag so that files can be downloaded or not from the folder link',
                        'type' => 'boolean'
                        'required' => true,
                    ),
                    'expires_on' => array (
                        'location' => 'json',
                        'description' => 'Time/Date which sets expiration format YYYY-MM-DD',
                        'type' => 'string'
                        'required' => false,
                    ),
                    'show_tracking' => array(
                        'location' => 'json',
                        'description' => 'Boolean that sets a flag so that files downloaded will have tracking data or not.',
                        'type' => 'boolean'
                        'required' => true,
                    ),
                    'purpose' => array (
                        'location' => 'json',
                        'description' => 'Reason for creating the folder link',
                        'type' => 'string'
                        'required' => true,
                    ),
                )
            ),

            /* deleteFolderLink */
            'deleteFolderLink' => array(
                'httpMethod' => 'DELETE',
                'uri' => 'folder_links/{id}.json',
                'summary' => 'Delete specified folder link.' . PHP_EOL . '[ImageRelay API: Folder Links](https://github.com/imagerelay/api/blob/master/sections/folder_links.md#delete-folder-links)',
                'parameters' => array(
                    'id' => array(
                        'location' => 'uri',
                        'description' => 'Folder Link ID',
                        'type' => 'integer',
                        'required' => true,
                    )
                )
            ),

            /* INVITED USERS */
            /* getInvitedUsers */
            'getInvitedUsers' => array(
                'httpMethod' => 'GET',
                'uri' => 'invited_users.json',
                'summary' => 'Returns list of invited users associated with the account' . PHP_EOL . '[ImageRelay API: Invited Users](https://github.com/imagerelay/api/blob/master/sections/invited_users.md#get-invited-users-)',
                'parameters' => array(
                    'page' => array(
                        'location' => 'query',
                        'description' => 'used to paginate pages.',
                        'type' => 'integer',
                        'required' => false,
                    )
                )
            ),

            /* getInvitedUser */
            'getInvitedUser' => array(
                'httpMethod' => 'GET',
                'uri' => 'invited_users/{id}.json',
                'summary' => 'Get specified invited user.' . PHP_EOL . '[ImageRelay API: Invited Users](https://github.com/imagerelay/api/blob/master/sections/invited_users.md#get-invited-users-)',
                'parameters' => array(
                    'id' => array(
                        'location' => 'uri',
                        'description' => 'Invited User ID',
                        'type' => 'integer',
                        'required' => true,
                    )
                )
            ),

            /* inviteNewUser */
            'inviteNewUser' => array(
                'httpMethod' => 'POST',
                'uri' => 'invited_users.json',
                'summary' => 'Invites a new user to your account.' . PHP_EOL . '[ImageRelay API: Invited Users](https://github.com/imagerelay/api/blob/master/sections/invited_users.md#invite-new-user)',
                'parameters' => array(
                    'first_name' => array(
                        'location' => 'json',
                        'description' => 'First Name',
                        'type' => 'string',
                        'required' => true,
                    ),
                    'last_name' => array(
                        'location' => 'json',
                        'description' => 'Last Name',
                        'type' => 'string',
                        'required' => true,
                    ),
                    'email' => array(
                        'location' => 'json',
                        'description' => 'email address',
                        'type' => 'string',
                        'required' => true,
                    ),
                    'company' => array(
                        'location' => 'json',
                        'description' => 'Company Name',
                        'type' => 'string',
                        'required' => true,
                    ),
                    'permission_id' => array(
                        'location' => 'json',
                        'description' => 'Permission Group ID to assign them to.',
                        'type' => 'integer',
                        'required' => true,
                    ),
                )
            ),

            /* deleteInvitedUser */
            'deleteInvitedUser' => array(
                'httpMethod' => 'DELETE',
                'uri' => 'invited_users/{id}.json',
                'summary' => 'Delete specified invited user.' . PHP_EOL . '[ImageRelay API: Invited Users](https://github.com/imagerelay/api/blob/master/sections/invited_users.md#delete-invited-user)',
                'parameters' => array(
                    'id' => array(
                        'location' => 'uri',
                        'description' => 'Invited User ID',
                        'type' => 'integer',
                        'required' => true,
                    )
                )
            ),

            /* PERMISSIONS */
            /* getPermissions */
            'getPermissions' => array(
                'httpMethod' => 'GET',
                'uri' => 'permissions.json',
                'summary' => 'Returns list of permissions associated with the account' . PHP_EOL . '[ImageRelay API: Permissions](https://github.com/imagerelay/api/blob/master/sections/permissions.md#get-permissions)',
                'parameters' => array(
                    'page' => array(
                        'location' => 'query',
                        'description' => 'used to paginate pages.',
                        'type' => 'integer',
                        'required' => false,
                    )
                )
            ),

            /* getPermission */
            'getPermission' => array(
                'httpMethod' => 'GET',
                'uri' => 'permissions/{id}.json',
                'summary' => 'Get specified permission.' . PHP_EOL . '[ImageRelay API: Permissions](https://github.com/imagerelay/api/blob/master/sections/permissions.md#get-permission)',
                'parameters' => array(
                    'id' => array(
                        'location' => 'uri',
                        'description' => 'Permission ID',
                        'type' => 'integer',
                        'required' => true,
                    )
                )
            ),

            /* QUICK LINKS */
            /* getQuickLinks */
            'getQuickLinks' => array(
                'httpMethod' => 'GET',
                'uri' => 'quick_links.json',
                'summary' => 'Returns list of folder links associated with the account' . PHP_EOL . '[ImageRelay API: Quick Links](https://github.com/imagerelay/api/blob/master/sections/quick_links.md#get-quick-links)',
                'parameters' => array(
                    'page' => array(
                        'location' => 'query',
                        'description' => 'used to paginate pages.',
                        'type' => 'integer',
                        'required' => false,
                    )
                )
            ),

            /* getQuickLink */
            'getQuickLink' => array(
                'httpMethod' => 'GET',
                'uri' => 'quick_links/{id}.json',
                'summary' => 'Get specified quick link.' . PHP_EOL . '[ImageRelay API: Quick Links](https://github.com/imagerelay/api/blob/master/sections/quick_links.md#get-quick-link)',
                'parameters' => array(
                    'id' => array(
                        'location' => 'uri',
                        'description' => 'Quick Link ID',
                        'type' => 'integer',
                        'required' => true,
                    )
                )
            ),

            /* createQuickLink */
            'createQuickLink' => array(
                'httpMethod' => 'POST',
                'uri' => 'quick_links.json',
                'summary' => 'Create a new quick link.' . PHP_EOL . '[ImageRelay API: Quick Links](https://github.com/imagerelay/api/blob/master/sections/quick_links.md#create-quick-link)',
                'parameters' => array(
                    'asset_id' => array(
                        'location' => 'json',
                        'description' => 'Asset ID that the link will be created for',
                        'type' => 'integer',
                        'required' => true,
                    ),
                    'format' => array(
                        'location' => 'json',
                        'description' => 'format of file type.  ex: jpg/png/gif/avi/mov/etc',
                        'type' => 'string'
                        'required' => false,
                    ),
                    'expires' => array (
                        'location' => 'json',
                        'description' => 'Time/Date which sets expiration format YYYY-MM-DD',
                        'type' => 'string'
                        'required' => false,
                    ),
                    'max_width' => array(
                        'location' => 'json',
                        'description' => 'set custom image size max width',
                        'type' => 'string'
                        'required' => false,
                    ),
                    'max_height' => array (
                        'location' => 'json',
                        'description' => 'set custom image size max height',
                        'type' => 'string'
                        'required' => false,
                    ),
                    'dpi' => array (
                        'location' => 'json',
                        'description' => 'set dots per inch',
                        'type' => 'integer'
                        'required' => false,
                    ),
                    'disposition' => array (
                        'location' => 'json',
                        'description' => 'set content-disposition inline or attachment',
                        'type' => 'string'
                        'required' => false,
                    ),
                    'color_format' => array (
                        'location' => 'json',
                        'description' => 'set color format.  ex: rgb/cmyk',
                        'type' => 'string'
                        'required' => false,
                    ),
                    'purpose' => array (
                        'location' => 'json',
                        'description' => 'purpose for the quick link/tracking data',
                        'type' => 'string'
                        'required' => true,
                    ),
                )
            ),

            /* deleteQuickLink */
            'deleteQuickLink' => array(
                'httpMethod' => 'DELETE',
                'uri' => 'quick_links/{id}.json',
                'summary' => 'Delete specified quick link.' . PHP_EOL . '[ImageRelay API: Quick Links](https://github.com/imagerelay/api/blob/master/sections/quick_links.md#delete-quick-link)',
                'parameters' => array(
                    'id' => array(
                        'location' => 'uri',
                        'description' => 'Folder Link ID',
                        'type' => 'integer',
                        'required' => true,
                    )
                )
            ),

            /* UPLOAD LINKS */
            /* getUploadLinks */
            'getUploadLinks' => array(
                'httpMethod' => 'GET',
                'uri' => 'upload_links.json',
                'summary' => 'Returns list of upload links associated with the account' . PHP_EOL . '[ImageRelay API: Upload Links](https://github.com/imagerelay/api/blob/master/sections/upload_links.md#get-upload-links)',
                'parameters' => array(
                    'page' => array(
                        'location' => 'query',
                        'description' => 'used to paginate pages.',
                        'type' => 'integer',
                        'required' => false,
                    )
                )
            ),

            /* getUploadLink */
            'getUploadLink' => array(
                'httpMethod' => 'GET',
                'uri' => 'upload_links/{id}.json',
                'summary' => 'Get specified upload link.' . PHP_EOL . '[ImageRelay API: Upload Links](https://github.com/imagerelay/api/blob/master/sections/upload_links.md#get-upload-link)',
                'parameters' => array(
                    'id' => array(
                        'location' => 'uri',
                        'description' => 'Upload Link ID',
                        'type' => 'integer',
                        'required' => true,
                    )
                )
            ),

            /* createUploadLink */
            'createUploadLInk' => array(
                'httpMethod' => 'POST',
                'uri' => 'upload_links.json',
                'summary' => 'Create a new quick link.' . PHP_EOL . '[ImageRelay API: Upload Links](https://github.com/imagerelay/api/blob/master/sections/upload_links.md#create-upload-link)',
                'parameters' => array(
                    'folder_id' => array(
                        'location' => 'json',
                        'description' => 'Folder ID that the uploaded files will be saved in.',
                        'type' => 'integer',
                        'required' => true,
                    ),
                    'expires_on' => array (
                        'location' => 'json',
                        'description' => 'Time/Date which sets expiration format YYYY-MM-DD',
                        'type' => 'string'
                        'required' => false,
                    ),
                    'purpose' => array (
                        'location' => 'json',
                        'description' => 'purpose for the upload link/tracking data',
                        'type' => 'string'
                        'required' => true,
                    ),
                )
            ),

            /* deleteUploadLink */
            'deleteUploadLink' => array(
                'httpMethod' => 'DELETE',
                'uri' => 'upload_links/{id}.json',
                'summary' => 'Delete specified upload link.' . PHP_EOL . '[ImageRelay API: Upload Links](https://github.com/imagerelay/api/blob/master/sections/upload_links.md#delete-upload-link)',
                'parameters' => array(
                    'id' => array(
                        'location' => 'uri',
                        'description' => 'Upload Link ID',
                        'type' => 'integer',
                        'required' => true,
                    )
                )
            ),

            /* USERS */
            /* getUsers */
            'getUsers' => array(
                'httpMethod' => 'GET',
                'uri' => 'users.json',
                'summary' => 'Returns list of users associated with the account' . PHP_EOL . '[ImageRelay API: Users](https://github.com/imagerelay/api/blob/master/sections/users.md#get-users)',
                'parameters' => array(
                    'page' => array(
                        'location' => 'query',
                        'description' => 'used to paginate pages.',
                        'type' => 'integer',
                        'required' => false,
                    )
                )
            ),

            /* getUser */
            'getUser' => array(
                'httpMethod' => 'GET',
                'uri' => 'users/{id}.json',
                'summary' => 'Get specified user.' . PHP_EOL . '[ImageRelay API: Users](https://github.com/imagerelay/api/blob/master/sections/users.md#get-user)',
                'parameters' => array(
                    'id' => array(
                        'location' => 'uri',
                        'description' => 'User ID',
                        'type' => 'integer',
                        'required' => true,
                    )
                )
            ),
        )
    );
?>