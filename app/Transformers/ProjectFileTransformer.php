<?php
/**
 * User: Leonardo
 * Date: 21/11/2016
 * Time: 15:28
 */

namespace Sistema\Transformers;

use Sistema\Entities\ProjectFile;
use League\Fractal\TransformerAbstract;


class ProjectFileTransformer extends TransformerAbstract
{

    public function transform(ProjectFile $projectFile)
    {
        return [
            'id' => (int) $projectFile->id,
            'name' => $projectFile->name,
            'description' => $projectFile->description,
            'extension' => $projectFile->extension,
        ];
    }
    
}