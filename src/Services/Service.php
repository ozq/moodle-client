<?php

namespace F0\LaravelMoodleClient\Services;

use F0\LaravelMoodleClient\Clients\ClientAdapterInterface;
use F0\LaravelMoodleClient\Entities\Entity;
use ReflectionClass;

/**
 * Class Service
 * @package F0\LaravelMoodleClient\Services
 */
abstract class Service
{
    /**
     * @var ClientAdapterInterface
     */
    private $client;

    /**
     * Service constructor.
     * @param ClientAdapterInterface $client
     */
    public function __construct(ClientAdapterInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Get service alias
     * @return string
     */
    public function getAlias()
    {
        $reflectionClass = new ReflectionClass(static::class);
        return strtolower($reflectionClass->getShortName());
    }

    /**
     * Get array of converted to arrays entities
     * Each entity data contains only filled entity properties
     * @param Entity[] ...$entities
     * @return array
     */
    protected function prepareEntityForSending(Entity ...$entities)
    {
        $convertedEntities = [];

        foreach ($entities as $entity) {
            $filledData = [];
            $entityData = $entity->toArray();
            foreach ($entityData as $property => $value) {
                if (!empty($value)) {
                    $filledData[strtolower($property)] = $value;
                }
            }

            $convertedEntities[] = $filledData;
        }

        return $convertedEntities;
    }

    /**
     * Send API request
     * @param $function
     * @param array $arguments
     * @return array
     */
    final protected function sendRequest($function, array $arguments = [])
    {
        $response = $this->client->sendRequest($function, $arguments);

        return (array)$response;
    }
}
