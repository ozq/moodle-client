<?php

namespace Ozq\MoodleClient\Clients;

use Ozq\MoodleClient\Connection;
use Ozq\MoodleClient\Exceptions\ApiException;
use ReflectionClass;

/**
 * Class BaseAdapter
 * @package Ozq\MoodleClient\Clients
 */
abstract class BaseAdapter implements ClientAdapterInterface
{
    const SERVER_SCRIPT_PATH_TEMPLATE = 'webservice/%s/server.php';
    const OPTION_TOKEN = 'wstoken';
    const OPTION_FUNCTION = 'wsfunction';

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var mixed
     */
    protected $client;

    /**
     * Build client instance
     * @return mixed
     */
    abstract protected function buildClient();

    /**
     * Client constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->client = $this->buildClient();
    }

    /**
     * Get client
     * @return mixed
     */
    protected function getClient()
    {
        return $this->client;
    }

    /**
     * Get endpoint
     * @param array $options
     * @return string
     */
    protected function getEndPoint(array $options = [])
    {
        $url = $this->connection->getUrl() . '/' . $this->getScriptPath();

        return $options ? $url . '?' . http_build_query($options) : $url;
    }

    /**
     * Get connection
     * @return Connection
     */
    protected function getConnection()
    {
        return $this->connection;
    }

    /**
     * Get client script path depends on protocol type
     * @return string
     */
    protected function getScriptPath()
    {
        return sprintf(self::SERVER_SCRIPT_PATH_TEMPLATE, $this->getProtocolType());
    }

    /**
     * Get client protocol type
     * @return string
     */
    protected function getProtocolType()
    {
        return $this->recognizeClientType();
    }

    /**
     * Check if response contains exceptions
     * @param mixed $response
     * @throws ApiException
     */
    protected function handleException($response)
    {
        //TODO: convert response to array!

        if (array_key_exists('exception', $response)) {
            throw new ApiException($response['errorcode'] . ': ' . $response['message']);
        }
    }

    /**
     * Recognize client type by client class name
     * @return string
     */
    protected function recognizeClientType()
    {
        $reflectionClass = new ReflectionClass(static::class);
        return str_replace('client', '', strtolower($reflectionClass->getShortName()));
    }
}
