<?php

namespace Ozq\MoodleClient\Entities;

/**
 * Class Course
 * @package Ozq\MoodleClient\Entities
 */
class Course extends Entity
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $shortName;

    /**
     * @var integer
     */
    public $categoryId;

    /**
     * @var integer
     */
    public $categorySortOrder;

    /**
     * @var string
     */
    public $fullName;

    /**
     * @var string
     */
    public $displayName;

    /**
     * @var integer
     */
    public $idNumber;

    /**
     * @var string
     */
    public $summary;

    /**
     * Summary format (1 = HTML, 0 = MOODLE, 2 = PLAIN or 4 = MARKDOWN)
     * @var integer
     */
    public $summaryFormat;

    /**
     * Course format: weeks, topics, social, site, etc...
     * @var string
     */
    public $format;

    /**
     * If grades are shown
     * @var integer
     */
    public $showGrades;

    /**
     * Number of recent items appearing on the course page
     * @var integer
     */
    public $newsItems;

    /**
     * Timestamp when the course start
     * @var integer
     */
    public $startDate;

    /**
     * Timestamp when the course end
     * @var integer
     */
    public $endDate;

    /**
     * @var integer
     */
    public $numSections;

    /**
     * Largest size of file that can be uploaded into the course
     * @var integer
     */
    public $maxBytes;

    /**
     * Are activity report shown
     * @var integer
     */
    public $showReports;

    /**
     * Is course available for students
     * @var integer
     */
    public $visible;

    /**
     * @var integer
     */
    public $groupMode;

    /**
     * @var integer
     */
    public $groupModeForce;

    /**
     * @var integer
     */
    public $defaultGroupingId;

    /**
     * @var integer
     */
    public $timeCreated;

    /**
     * @var integer
     */
    public $timeModified;

    /**
     * @var integer
     */
    public $enableCompletion;

    /**
     * @var integer
     */
    public $completionNotify;

    /**
     * @var string
     */
    public $lang;

    /**
     * @var string
     */
    public $forceTheme;

    /**
     * @var array
     */
    public $courseFormatOptions = [];
}
