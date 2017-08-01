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
     * Desired username for created account
     * @var string
     */
    public $username;

    /**
     * Desired password for created password
     * @var string
     */
    public $password;

    /**
     * User's first name
     * @var string
     */
    public $firstname;

    /**
     * User's last name
     * @var string
     */
    public $lastname;

    /**
     * User's email address
     * @var string
     */
    public $email;

    /**
     * Auth plugins include manual, ldap, imap, etc
     * @var string
     */
    public $auth;

    /**
     * An arbitrary ID code number perhaps from the institution
     * @var string
     */
    public $idnumber;

    /**
     * Language code such as "en", must exist on server
     * @var string
     */
    public $lang;

    /**
     * @var string
     */
    public $calendartype;

    /**
     * Theme name such as "standard", must exist on server
     * @var string
     */
    public $theme;

    /**
     * Timezone code such as Australia/Perth, or 99 for default
     * @var string
     */
    public $timezone;

    /**
     * Mail format code is 0 for plain text, 1 for HTML etc
     * @var int
     */
    public $mailformat;

    /**
     * User profile description, no HTML
     * @var string
     */
    public $description;

    /**
     * Home city of the user
     * @var string
     */
    public $city;

    /**
     * Home country code of the user, such as AU or CZ
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

    /**
     * User preferences
     * @var array
     */
    public $preferences = [];

    /**
     * User custom fields (also known as user profil fields)
     * @var array
     */
    public $customfields = [];
}
