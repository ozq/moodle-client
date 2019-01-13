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
     * Get all users by ids
     * @param array $ids
     * @return UserCollection
     */
    public function getAll(array $ids = [])
    {
        $response = $this->sendRequest('core_user_get_users', ['options' => ['ids' => $ids]]);

        return $this->getUserCollection($response);
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
            'field' => $field,
            'value' => $value,
        ];

        $response = $this->sendRequest('core_user_get_users_by_field', $arguments);

        return $this->getUserCollection($response['users']);
    }

    /**
     * Create new user
     * @param \Ozq\MoodleClient\Entities\Dto\User[] ...$users
     * @return UserCollection
     */
    public function create(UserDto ...$users)
    {
        $response = $this->sendRequest(
            'core_user_create_users',
            [
                'users' => $this->prepareEntityForSending(...$users)
            ]
        );

        return $this->getUserCollection($response);
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
        foreach ($users as $userItem) {
            $userItems[] = new UserItem($userItem);
        }

        return new UserCollection(...$userItems);
    }
}
