<?php
if (!file_exists(dirname(__DIR__) . '/composer.lock')) {
    die("Dependencies must be installed using composer:\n\nphp composer.phar install\n\n"
        . "See http://getcomposer.org for help with installing composer\n");
}
$loader = require dirname(__DIR__) . '/vendor/autoload.php';
$loader->add('ImageRelay\\Test', __DIR__);
Guzzle\Tests\GuzzleTestCase::setMockBasePath(__DIR__ . '/mock');
Guzzle\Tests\GuzzleTestCase::setServiceBuilder(Guzzle\Service\Builder\ServiceBuilder::factory(array(
    'imagerelay' => array(
        'class' => 'ImageRelay\ImageRelayClient',
        'params' => array(
            'auth'          => 'http',
            'username'      => 'username',
            'password'      => 'password',
            'app_name'      => 'Test',
            'app_contact'   => 'https://www.test.com',
            'imagerelay_url' => 'test.imagerelay.com'
        )
    )
)));
?>

