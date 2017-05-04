# MOODLE PHP CLIENT

## Installation
The recommended way to install the library is through Composer:

```
$ composer require ozq/moodle-client:@dev
```
 
## Usage
Create instacne of connection with your moodle service: 
```
$connection = new Connection('http://url-to-moodle-service.com', 'Y0uR!tOken');
```

Create instance of one of available moodle clients, e.g. REST client:
```
$client = new RestClient($connection);
```

Now, you can use moodle services. There are available some build in ready to use moodle entities.
All logic and API working encapsulated in moodle services and entities. Let's create instance of Course service.
 
Create instance:
 ```
 $courseService = new Course($client);
 ```

Get all courses:
```
$courses = $courseService->getAll();
```

Delete courses with ids: 1, 2, 3:
```
$courses = $courseService->delete([1, 2, 3]);
```

If you have to send some specific structured data, e.g., when you create new course, it is better to use special DTO's objects:  
```
$courseDto = new Course();
$courseDto->name = 'Test Course';
$courseDto->fullName = 'Test Course fullname';
...
$courseService->create($courseDto);
```

If there is no build in needed services and entitites, you can create it.  
Services must extend Service abstract class, entities (as DTO's) must extend Entity abstract class.  

Also, you can use moodle client without service layer:
```
$courses = $client->sendRequest('core_course_get_courses');
```

## Example of Laravel integration
1. Create config file (config/moodle.php) for moodle service with content:  
```
<?php

return [
    'connection' => [
        'url'   => 'http://url-to-moodle-service.com',
        'token' => 'Y0uR!tOken',
    ],
];
```

2. Create service provider:  
```php
$ php artisan make:provider MoodleServiceProvider
```
Example of MoodleServiceProvider register method:
```
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
```
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