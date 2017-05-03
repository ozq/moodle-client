<?php

namespace Ozq\MoodleClient\Entities;

/**
 * Class Entity
 * @package Ozq\MoodleClient\Entities
 */
abstract class Entity
{
    /**
     * Entity constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->fill($data);
    }

    /**
     * Fill entity properties from array
     * @param array $data
     * @return $this
     */
    public function fill(array $data)
    {
        if (!empty($data)) {
            $properties = $this->getProperties();
            foreach ($properties as $property => $value) {
                $incomingProperty = strtolower($property);
                if (array_key_exists($incomingProperty, $data)) {
                    $this->{$property} = $data[$incomingProperty];
                }
            }
        }

        return $this;
    }

    /**
     * Get available entity properties
     * @return array
     */
    public function getProperties()
    {
        return get_object_vars($this);
    }

    /**
     * Convert entity to array
     * @return array
     */
    public function toArray()
    {
        return (array)$this;
    }
}
