<?php

namespace F0\LaravelMoodleClient\Entities;

use F0\LaravelMoodleClient\GenericCollection;

/**
 * Class UserCollection
 * @package F0\LaravelMoodleClient\Entities
 */
class UserCollection extends GenericCollection
{
    /**
     * UserCollection constructor.
     * @param User[] ...$users
     */
    public function __construct(User ...$users)
    {
        $this->items = $users;
    }

    /**
     * Add user to collection
     * @param User $item
     */
    public function add(User $item)
    {
        $this->items[$item->id] = $item;
    }

    /**
     * Remove user from collection
     * @param User|integer $user
     */
    public function remove($user)
    {
        $id = ($user instanceof User) ? $user->id : $user;
        if (array_key_exists($id, $this->items)) {
            unset($this->items[$id]);
        }
    }
}
