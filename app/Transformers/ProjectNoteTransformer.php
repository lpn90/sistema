<?php
/**
 * User: Leonardo
 * Date: 21/11/2016
 * Time: 15:28
 */

namespace Sistema\Transformers;

use Sistema\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;


class ProjectNoteTransformer extends TransformerAbstract
{

    public function transform(ProjectNote $projectNote)
    {
        return [
            'id' => (int)$projectNote->id,
            'title' => $projectNote->title,
            'note' => $projectNote->note,
            'project_id' => $projectNote->project_id,
        ];
    }

}