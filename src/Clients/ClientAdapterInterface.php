<?php

namespace Ozq\MoodleClient\Clients;

/**
 * Interface ClientAdapterInterface
 * @package Ozq\MoodleClient\Clients
 */
interface ClientAdapterInterface
{
    /**
     * Send API request
     * @param $function
     * @param array $arguments
     * @return mixed
     */
    public function sendRequest($function, array $arguments = []);
}
