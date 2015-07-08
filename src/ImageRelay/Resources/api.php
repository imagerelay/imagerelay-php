<?php
    return array(
        'serviceFullName'       => 'ImageRelay API',
        'serviceAbbreviation'   => 'IRAPI',
        'operations'            => array(
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
                        'location' => 'query',
                        'description' => 'Will return files uploaded to designated folder.  Date format should be YYYY-MM-DD HH:MM:SS -- you can leave off the time if you want to start at the beginning of the day.',
                        'type' => 'string',
                        'required' => false,
                    )
                )
            ),
        )
    );
?>