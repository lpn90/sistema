<?php
/**
 * User: Leonardo
 * Date: 17/11/2016
 * Time: 16:48
 */

namespace Sistema\Validators;


use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'file' => 'required|mimes:jpeg,jpg,png,gif,pdf,zip,doc,docx,rar',
            'name' => 'required|max:255',
            'description' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|max:255',
            'description' => 'required',
        ]
    ];

}