<?php
/**
 * User: Leonardo
 * Date: 21/11/2016
 * Time: 17:25
 */

namespace Sistema\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use Sistema\Transformers\ProjectTransformer;


class ProjectPresenter extends FractalPresenter
{

    public function getTransformer()
    {
        return new ProjectTransformer();
    }

}