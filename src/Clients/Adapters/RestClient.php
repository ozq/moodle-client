<?php

namespace Ozq\MoodleClient\Clients\Adapters;

use Ozq\MoodleClient\Clients\BaseAdapter;
use Ozq\MoodleClient\Connection;
use Assert\Assertion;
use GuzzleHttp\Client as HttpClient;

/**
 * Class RestClient
 * @package Ozq\MoodleClient\Clients
 *
 * @method HttpClient getClient()
 */
class RestClient extends BaseAdapter
{
    const OPTION_FORMAT = 'moodlewsrestformat';
    const RESPONSE_FORMAT_JSON = 'json';
    const RESPONSE_FORMAT_XML = 'xml';

    /**
     * @var string
     */
    protected $responseFormat;

    /**
     * RestClient constructor.
     * @param Connection $connection
     * @param string $responseFormat
     */
    public function __construct(Connection $connection, $responseFormat = self::RESPONSE_FORMAT_JSON)
    {
        parent::__construct($connection);
        $this->setResponseFormat($responseFormat);
    }

    /**
     * Send API request
     * @param $function
     * @param array $arguments
     * @return array|bool|float|int|\SimpleXMLElement|string
     */
    public function sendRequest($function, array $arguments = [])
    {
        $configuration = [
            self::OPTION_FUNCTION => $function,
            self::OPTION_FORMAT   => $this->responseFormat,
            self::OPTION_TOKEN    => $this->getConnection()->getToken(),
        ];

        $response = $this->getClient()->post(null, ['body' => array_merge($configuration, $arguments)]);
        $this->handleException($response);

        $formattedResponse = $this->responseFormat === self::RESPONSE_FORMAT_JSON ?
            $response->json() :
            $response->xml();

        return $formattedResponse;
    }

    /**
     * Build client instance
     * @return HttpClient
     */
    protected function buildClient()
    {
        return new HttpClient(['base_url' => $this->getEndPoint()]);
    }

    /**
     * Set response format
     * @param string $format
     */
    protected function setResponseFormat($format)
    {
        Assertion::inArray($format, [self::RESPONSE_FORMAT_JSON, self::RESPONSE_FORMAT_XML]);
        $this->responseFormat = $format;
    }
}
