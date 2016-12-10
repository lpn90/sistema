<?php
/**
 * User: Leonardo
 * Date: 21/11/2016
 * Time: 15:28
 */

namespace Sistema\Transformers;

use Sistema\Entities\User;
use League\Fractal\TransformerAbstract;


class MemberTransformer extends TransformerAbstract
{
    /**
    * Class ClientTransformer
    * @package Sistema\Transformers
    * Transform the \Client entity
    * @param User $member
    *
    * @return array
    */

    public function transform(User $member)
    {
        return [
            'member_id' => $member->id,
            'name' => $member->name,
        ];
    }
}