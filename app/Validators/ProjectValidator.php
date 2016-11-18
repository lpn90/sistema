<?php
/**
 * User: Leonardo
 * Date: 17/11/2016
 * Time: 16:48
 */

namespace Sistema\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required|max:255',
        'progress' => 'required|integer',
        'status' => 'required|integer',
        'due_date' => 'required|date',
        'owner_id' => 'required|integer',
        'client_id' => 'required|integer',
    ];

}