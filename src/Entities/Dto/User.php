<?php

namespace Ozq\MoodleClient\Entities\Dto;

use Ozq\MoodleClient\Entities\Entity;

/**
 * Class User
 * @package Ozq\MoodleClient\Entities\Dto
 */
class User extends Entity
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $firstname;

    /**
     * @var string
     */
    public $lastname;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $auth;

    /**
     * @var string
     */
    public $idnumber;

    /**
     * @var string
     */
    public $lang;

    /**
     * @var string
     */
    public $calendartype;

    /**
     * @var string
     */
    public $theme;

    /**
     * @var string
     */
    public $timezone;

    /**
     * @var integer
     */
    public $mailformat;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $country;

    /**
     * @var string
     */
    public $firstnamephonetic;

    /**
     * @var string
     */
    public $lastnamephonetic;

    /**
     * @var string
     */
    public $middlename;

    /**
     * @var string
     */
    public $alternatename;

}
