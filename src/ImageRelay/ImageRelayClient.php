<?php

namespace ImageRelay;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use Guzzle\Common\Event;
use Guzzle\Common\Exception\InvalidArgumentException;
use GuzzleHttp\Exception\RequestException;

class ImageRelayClient extends Client
{
    /**
     * @param array $config
     * @return \Guzzle\Service\Client|ImageRelayClient
     * @throws \Guzzle\Common\Exception\InvalidArgumentException
     */
    public static function factory($config = array())
    {
        $default = array(
            'base_url'          => 'https://{imagerelay_url}/api/v2/',
            'imagerelay_url'    => 'subdomain.imagerelay.com',
        );
        $config = Collection::fromConfig($config, $default);
        $client = new self($config->get('base_url'), $config);
        if ($config['auth'] === 'http') {
            if (! isset($config['username'], $config['password'])) {
                throw new InvalidArgumentException("Username and password required when using http auth.");
            }
            $authorization = 'Basic ' . base64_encode($config['username'] . ':' . $config['password']);
        }
        if ($config['auth'] === 'oauth') {
            if (! isset($config['token'])) {
                throw new InvalidArgumentException("Access token required when using oauth.");
            }
            $authorization = sprintf('Bearer %s', $config['token']);
        }
        if (! isset($authorization)) {
            throw new InvalidArgumentException("Must use either http or oauth authentication method.");
        }
        // Attach a service description to the client
        $description = ServiceDescription::factory(__DIR__ . '/Resources/api.php');
        $client->setDescription($description);
        // Set required User-Agent
        $client->setUserAgent(sprintf('%s (%s)', $config['app_name'], $config['app_contact']));
        $client->getEventDispatcher()->addListener('request.before_send', function(Event $event) use ($authorization) {
            $event['request']->addHeader('Authorization', $authorization);
        });
        return $client;
    }
}