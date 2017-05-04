<?php

namespace Ozq\MoodleClient\Clients\Adapters;

use Ozq\MoodleClient\Clients\BaseAdapter;
use \SoapClient as BaseSoapClient;

/**
 * Class SoapClient
 * @package Ozq\MoodleClient\Clients\Adapters
 *
 * @method BaseSoapClient getClient()
 */
class SoapClient extends BaseAdapter
{
    const OPTION_WSDL = 'wsdl';

    /**
     * Send API request
     * @param $function
     * @param array $arguments
     * @return mixed
     */
    public function sendRequest($function, array $arguments = [])
    {
        $response = $this->getClient()->__soapCall($function, $arguments);

        $this->handleException($response);

        return $response;
    }

    /**
     * Build client instance
     * @return BaseSoapClient
     */
    protected function buildClient()
    {
        $endPoint = $this->getEndPoint([
            self::OPTION_WSDL  => 1,
            self::OPTION_TOKEN => $this->getConnection()->getToken(),
        ]);

        return new BaseSoapClient($endPoint);
    }
}
