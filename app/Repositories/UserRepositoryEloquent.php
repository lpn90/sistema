<?php
/**
 * User: Leonardo
 * Date: 17/11/2016
 * Time: 15:35
 */

namespace Sistema\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use Sistema\Entities\User;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function model()
    {
        return User::class;
    }

}