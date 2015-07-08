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
            )
        )
    );
?>