# MOODLE PHP CLIENT

## Installation
The recommended way to install the library is through Composer:

```
$ composer require ozq/moodle-client:@dev
```
 
## Usage
Create instacne of connection with your moodle service: 
```php
$connection = new Connection('http://url-to-moodle-service.com', 'Y0uR!tOken');
```

Create instance of one of available moodle clients, e.g. REST client:
```php
$client = new RestClient($connection);
```

Now, you can use moodle services. There are available some build in ready to use moodle entities.
All logic and API working encapsulated in moodle services and entities. Let's create instance of Course service.
 
Create instance:
 ```php
 $courseService = new Course($client);
 ```

Get all courses:
```php
$courses = $courseService->getAll();
```

Delete courses with ids: 1, 2, 3:
```php
$courses = $courseService->delete([1, 2, 3]);
```

If you have to send some specific structured data, e.g., when you create new course, it is better to use special DTO's objects:  
```php
$courseDto = new Course();
$courseDto->name = 'Test Course';
$courseDto->fullName = 'Test Course fullname';
...
$courseService->create($courseDto);
```

If there is no build in needed services and entitites, you can create it.  
Services must extend Service abstract class, entities (as DTO's) must extend Entity abstract class.  

Also, you can use moodle client without service layer:
```php
$courses = $client->sendRequest('core_course_get_courses');
```