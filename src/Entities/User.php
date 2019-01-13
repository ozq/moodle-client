<?php

namespace Ozq\MoodleClient\Entities;

/**
 * Class User
 * @package Ozq\MoodleClient\Entities
 */
class User extends Entity
{
    /**
     * @var integer
     */
    public $id;

    /**
     * Desired username for created account
     * @var string
     */
    public $userName;

    /**
     * Desired password for created password
     * @var string
     */
    public $password;

    /**
     * User's first name
     * @var string
     */
    public $firstName;

    /**
     * User's last name
     * @var string
     */
    public $lastName;

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
    public $idNumber;

    /**
     * Language code such as "en", must exist on server
     * @var string
     */
    public $lang;

    /**
     * @var string
     */
    public $calendarType;

    /**
     * Theme name such as "standard", must exist on server
     * @var string
     */
    public $theme;

    /**
     * Timezone code such as Australia/Perth, or 99 for default
     * @var string
     */
    public $timeZone;

    /**
     * Mail format code is 0 for plain text, 1 for HTML etc
     * @var int
     */
    public $mailFormat;

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
    public $firstNamePhonetic;

    /**
     * @var string
     */
    public $lastNamePhonetic;

    /**
     * @var string
     */
    public $middleName;
  
    /**
     * @var string
     */
    public $alternateName;

    /**
     * User preferences
     * @var array
     */
    public $preferences = [];

    /**
     * User custom fields (also known as user profile fields)
     * @var array
     */
    public $customFields = [];

}
