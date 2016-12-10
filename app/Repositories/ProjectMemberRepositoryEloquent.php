<?php
/**
 * User: Leonardo
 * Date: 17/11/2016
 * Time: 17:41
 */

namespace Sistema\Repositories;


use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Sistema\Entities\ProjectMember;
use Sistema\Presenters\ProjectMemberPresenter;

class ProjectMemberRepositoryEloquent extends BaseRepository implements ProjectMemberRepository
{
    
    public function model()
    {
        return ProjectMember::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    public function presenter()
    {
        return ProjectMemberPresenter::class;
    }

}