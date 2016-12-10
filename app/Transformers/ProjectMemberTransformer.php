<?php
/**
 * User: Leonardo
 * Date: 21/11/2016
 * Time: 15:28
 */

namespace Sistema\Transformers;

use League\Fractal\TransformerAbstract;
use Sistema\Entities\ProjectMember;


class ProjectMemberTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'user'
    ];
    
    public function transform(ProjectMember $member)
    {
        return [
            'id' => $member->id,
            'project_id' => $member->project_id,
        ];
    }
    
    public function includeUser(ProjectMember $member){
        return $this->item($member->member, new MemberTransformer());
    }
}