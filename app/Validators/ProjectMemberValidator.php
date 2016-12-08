<?php
/**
 * User: Leonardo
 * Date: 17/11/2016
 * Time: 16:48
 */

namespace Sistema\Validators;


use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectMemberValidator extends LaravelValidator
{

    protected $rules = [
        'member_id' => 'required|integer',
    ];

}