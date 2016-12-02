<?php
/**
 * User: Leonardo
 * Date: 21/11/2016
 * Time: 15:28
 */

namespace Sistema\Transformers;

use Sistema\Entities\User;
use League\Fractal\TransformerAbstract;


class UserTransformer extends TransformerAbstract
{
    /**
    * Class ClientTransformer
    * @package Sistema\Transformers
    * Transform the \Client entity
    * @param User $user
    *
    * @return array
    */

    public function transform(User $user)
    {
        return [

            'id' => (int)$user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];
    }
}