<?php

namespace Ozq\MoodleClient\Services;

use Ozq\MoodleClient\Entities\User as UserItem;
use Ozq\MoodleClient\Entities\Dto\User as UserDto;
use Ozq\MoodleClient\Entities\UserCollection;

/**
 * Class User
 * @package Ozq\MoodleClient\Services
 */
class User extends Service
{
    /**
     * Get all users
     * @return UserCollection
     */
    public function getAll()
    {
        $arguments = [
            'criteria' => [
                [
                    'key'   => 'email',
                    'value' => '%%',
                ],
            ],
        ];
        $response = $this->sendRequest('core_user_get_users', $arguments);

        return $this->getUserCollection($response['users']);
    }

    /**
     * Get user by field
     * @param $field
     * @param $value
     * @return UserCollection
     */
    public function getByField($field, $value)
    {
        $arguments = [
            'criteria' => [
                [
                    'key'   => $field,
                    'value' => $value,
                ],
            ],
        ];
        $response = $this->sendRequest('core_user_get_users', $arguments);

        return $this->getUserCollection($response['users']);
    }

    /**
     * Create new user
     * @param \Ozq\MoodleClient\Entities\Dto\User[] ...$users
     * @return UserCollection
     */
    public function create(UserDto ...$usersDto)
    {
        $users = $this->prepareEntityForSending(...$usersDto);
        $response = $this->sendRequest(
            'core_user_create_users',
            [
                'users' =>$users
            ]
        );

        $users = array_map(function ($response, $user) {
            return array_merge($response, $user);
        }, $response, $users);

        return $this->getUserCollection($users);
    }

    /**
     * Get user collection by user array
     * @param array $users
     * @return UserCollection
     */
    protected function getUserCollection(array $users)
    {
        $userItems = [];
        foreach ($users as $index => $userItem) {
            $userItems[] = new UserItem($userItem);
        }

        return new UserCollection(...$userItems);
    }
}
