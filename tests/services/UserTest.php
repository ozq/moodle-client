<?php

namespace F0\LaravelMoodleClient\Tests\Services;

use F0\LaravelMoodleClient\Clients\Adapters\RestClient;
use F0\LaravelMoodleClient\Clients\ClientAdapterInterface;
use F0\LaravelMoodleClient\Services\User;
use F0\LaravelMoodleClient\Tests\MoodleTestCase;
use F0\LaravelMoodleClient\Entities\UserCollection;
use F0\LaravelMoodleClient\Entities\Dto\User as UserDto;
use F0\LaravelMoodleClient\Entities\User as UserEntity;

/**
 * Class UserTest
 * @package F0\LaravelMoodleClient\Tests\Services
 */
class UserTest extends MoodleTestCase
{
    /**
     * @var ClientAdapterInterface
     */
    protected $client;

    /**
     * @var User
     */
    protected $service;

    public function setUp()
    {
        parent::setUp();

        $this->client = new RestClient($this->getConnection());
        $this->service = new User($this->client);
    }

    public function testGetAll()
    {
        $allUsers = $this->service->getAll();

        $userDto = new UserDto();
        $properties = $userDto->getProperties();

        /** @var UserEntity user */
        foreach ($allUsers->toArray() as $user) {
            foreach ($properties as $property => $value) {
                $userData = $user->toArray();
                $this->assertArrayHasKey($property, $userData);
            }
        }
    }

    /**
     * @return UserCollection
     */
    public function testCreate()
    {
        $userDto = $this->buildUser();
        $createdUsers = $this->service->create($userDto);

        /** @var UserEntity $user */
        foreach ($createdUsers as $user) {
            $userData = $user->toArray();
            $this->assertArrayHasKey('id', $userData);
            $this->assertEquals($user->userName, $userDto->userName);
            $this->assertEquals($user->firstName, $userDto->firstName);
            $this->assertEquals($user->lastName, $userDto->lastName);
            $this->assertEquals($user->email, $userDto->email);
            $this->assertEquals($user->password, $userDto->password);
        }

        return $createdUsers;
    }

    /**
     * @param UserCollection $users
     * @depends testCreate
     */
    public function testGetByField($users)
    {
        $createdUsers = $users->toArray();

        /** @var UserEntity $user */
        $createdUser = $createdUsers[0];

        $allUsers = $this->service->getByField('firstname', $createdUser->firstName);

        foreach ($allUsers as $user) {
            $this->assertEquals($createdUser->firstName, $user->firstName);
        }
    }

    /**
     * @param CourseCollection
     * @depends testCreate
     */
    public function testDelete($users)
    {
        $ids = [];
        /** @var UserCollection $users */
        foreach ($users as $user) {
            $ids[] = $user->id;
        }

        $this->service->delete($ids);

        $allUsersDeleted = true;
        foreach ($ids as $id) {
            $users = $this->service->getByField('id', $id);
            if (!empty($users->toArray())) {
                $allUsersDeleted = false;
            }
        }

        $this->assertEquals(true, $allUsersDeleted);
    }

    /**
     * @return UserDto
     */
    protected function buildUser()
    {
        $userDto = new UserDto();
        $userDto->userName = 'username_' . uniqid();
        $userDto->firstName = 'firstName_' . uniqid();
        $userDto->lastName = 'lastName_' . uniqid();
        $userDto->email = 'email_' . uniqid() . '@gmail.ru';
        $userDto->password = 'ASDqwe123!';

        return $userDto;
    }
}
