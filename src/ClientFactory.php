<?php
namespace Jiemo\Huanxin;

use Jiemo\Huanxin\Exception\ClientNotExistException;

class ClientFactory
{
    public static $clients = [];

    public static function getClient($clientName, $options = [])
    {
        $class = 'Jiemo\\Huanxin\\Client\\' . ucfirst($clientName);

        if (!class_exists($class)) {
            throw new ClientNotExistException(sprintf('Client does not exist %s', $class));
        }

        if (isset(self::$clients[$clientName])) {
            $client = self::$clients[$clientName];
        } else {
            $client = new $class($options['orgName'], $options['appName']);
            $client
                ->setClientId($options['clientId'])
                ->setClientSecret($options['clientSecret']);
        }

        // Async mode
        if (isset($options['async']) && $options['async']) {
            $client->setAsync();
        }

        return self::$clients[$clientName] = $client;
    }
}
