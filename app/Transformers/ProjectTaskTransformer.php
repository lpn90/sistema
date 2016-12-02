<?php
/**
 * User: Leonardo
 * Date: 21/11/2016
 * Time: 15:28
 */

namespace Sistema\Transformers;

use Sistema\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;


class ProjectTaskTransformer extends TransformerAbstract
{

    public function transform(ProjectTask $projectTask)
    {
        return [
            'id' => (int)$projectTask->id,
            'name' => $projectTask->name,
            'start_date' => $projectTask->start_date,
            'due_date' => $projectTask->due_date,
            'status' => $projectTask->status,
        ];
    }

}