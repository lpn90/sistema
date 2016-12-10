<?php
/**
 * User: Leonardo
 * Date: 17/11/2016
 * Time: 17:41
 */

namespace Sistema\Repositories;


use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Sistema\Entities\ProjectFile;
use Sistema\Presenters\ProjectFilePresenter;
use Sistema\Validators\ProjectFileValidator;

class ProjectFileRepositoryEloquent extends BaseRepository implements ProjectFileRepository
{
    
    public function model()
    {
        return ProjectFile::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function validator()
    {
        return ProjectFileValidator::class;
    }
    
    public function presenter()
    {
        return ProjectFilePresenter::class;
    }

}