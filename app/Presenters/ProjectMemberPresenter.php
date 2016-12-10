<?php
/**
 * User: Leonardo
 * Date: 21/11/2016
 * Time: 17:25
 */

namespace Sistema\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use Sistema\Transformers\ProjectMemberTransformer;


class ProjectMemberPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProjectMemberTransformer();
    }
}