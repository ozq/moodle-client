<?php

namespace F0\LaravelMoodleClient\Services;

use F0\LaravelMoodleClient\Entities\User as UserItem;
use F0\LaravelMoodleClient\Entities\Dto\User as UserDto;
use F0\LaravelMoodleClient\Entities\UserCollection;

/**
 * Class User
 * @package F0\LaravelMoodleClient\Services
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
     * @param \F0\LaravelMoodleClient\Entities\Dto\User[] ...$usersDto
     * @return UserCollection
     */
    public function create(UserDto ...$usersDto)
    {
        $users = $this->prepareEntityForSending(...$usersDto);
        $response = $this->sendRequest(
            'core_user_create_users',
            [
                'users' => $users
            ]
        );

        $users = array_map(function ($response, $user) {
            return array_merge($response, $user);
        }, $response, $users);

        return $this->getUserCollection($users);
    }

    /**
     * Delete users by ids
     * @param array $ids
     * @return mixed
     */
    public function delete(array $ids = [])
    {
        $response = $this->sendRequest('core_user_delete_users', ['userids' => $ids]);

        return $response;
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
