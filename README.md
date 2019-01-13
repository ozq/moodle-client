# Laravel Moodle Client

### This is a fork of [ozq/moodle-client](https://github.com/ozq/moodle-client)

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

| **Laravel**  |  **laravel-modules** |
|---|---|
| ^5.5  | ^1.0  |

`fabianospina/laravel-moodle-client` is a Moodle api.webservice client for Laravel.

## Work in Progress!!

## Install
To install through Composer, run:
```
$ composer require fabianospina/laravel-moodle-client
```

## Example of Laravel integration
1. Create config file (config/moodle.php) for moodle service with content:  
```php
<?php

return [
    'connection' => [
        'url'   => 'http://url-to-moodle-service.com',
        'token' => 'Y0uR!tOken',
    ],
];
```


2. Create service provider:  
```
$ php artisan make:provider MoodleServiceProvider
```
Example of MoodleServiceProvider register method:
```php
public function register()
{
    $this->app->singleton(ClientAdapterInterface::class, function () {
        $connection = new Connection(config('moodle.connection.url'), config('moodle.connection.token'));
        return new RestClient($connection);
    });
}
```

3. Register MoodleServiceProvider:  
Edit your config/app.php, add ```\App\Providers\MoodleServiceProvider::class```, to 'providers' array.

4. Clear config cache:
```
$ php artisan clear-compiled
$ php artisan config:clear
```

5. Now you can use Moodle services in your project:
```php
<?php

namespace App\Http\Controllers;

use Ozq\MoodleClient\Services\Course;

/**
 * Class CourseController
 * @package App\Http\Controllers
 */
class CourseController extends Controller
{
    /**
     * @var Course
     */
    protected $courseService;

    /**
     * CourseController constructor.
     * @param Course $courseService
     */
    public function __construct(Course $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->courseService->getAll();
        return view('courses.index', ['courses' => $courses]);
    }
}
```
