<?php

namespace F0\LaravelMoodleClient\Clients;

/**
 * Interface ClientAdapterInterface
 * @package F0\LaravelMoodleClient\Clients
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
