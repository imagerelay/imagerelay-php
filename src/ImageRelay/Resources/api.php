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
                'summary' => 'Get specified file type.' . PHP_EOL . '[ImageRelay API: Folders](https://github.com/imagerelay/api/blob/master/sections/file_types.md#get-file-type)',
                'parameters' => array(
                    'id' => array(
                        'location' => 'uri',
                        'description' => 'File Type ID',
                        'type' => 'integer',
                        'required' => true,
                    )
                )
            ),
        )
    );
?>