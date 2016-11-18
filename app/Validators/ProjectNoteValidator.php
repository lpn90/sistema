<?php

namespace Sistema\Validators;

use \Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{

    protected $rules = [
        'title' => 'required|max:255',
        'note' => 'required|string',
        'project_id' => 'required|integer',
   ];
}
