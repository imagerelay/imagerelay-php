<?php

namespace ImageRelay;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use Guzzle\Common\Event;
use Guzzle\Common\Exception\InvalidArgumentException;

class ImageRelayClient extends Client
{
    /**
     * @param array $config
     * @return \Guzzle\Service\Client|BasecampClient
     * @throws \Guzzle\Common\Exception\InvalidArgumentException
     */
    public static function factory($config = array())
    {
        $default = include('default_config.php');
        $config = Collection::fromConfig($config, $default);
        $client = new self($config->get('base_url'), $config);
        if ($config['auth'] === 'http') {
            if (! isset($config['username'], $config['password'])) {
                throw new InvalidArgumentException("Config must contain username and password when using http auth");
            }
            $authorization = 'Basic ' . base64_encode($config['username'] . ':' . $config['password']);
        }
        if ($config['auth'] === 'oauth') {
            if (! isset($config['token'])) {
                throw new InvalidArgumentException("Config must contain token when using oauth");
            }
            $authorization = sprintf('Bearer %s', $config['token']);
        }
        if (! isset($authorization)) {
            throw new InvalidArgumentException("Config must contain valid authentication method");
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