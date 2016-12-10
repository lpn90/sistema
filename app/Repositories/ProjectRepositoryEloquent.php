<?php
/**
 * User: Leonardo
 * Date: 17/11/2016
 * Time: 17:41
 */

namespace Sistema\Repositories;


use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Sistema\Entities\Project;
use Sistema\Presenters\ProjectPresenter;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{

    public function model()
    {
        return Project::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /* Verifica se o usuário é dono do Projeto */

    public function isOwner($projectId, $userId)
    {
        if (count($this->skipPresenter()->findWhere(['id' => $projectId, 'owner_id' => $userId]))) {
            return true;
        }
        return false;
    }

    public function hasMember($projectId, $memberId)
    {
        $project = $this->skipPresenter()->find($projectId);

        foreach ($project->members as $member) {
            if ($member->id == $memberId) {
                return true;
            }
        }
        return false;
    }

    public function findWithOwnerAndMember($userId)
    {
        return $this->scopeQuery(function ($query) use ($userId) {
            return $query->select('projects.*')
                ->leftJoin('project_members', 'project_members.project_id', '=', 'projects.id')
                ->where('project_members.member_id', '=', $userId)
                ->union($this->model->query()->getQuery()->where('owner_id', '=', $userId));
        })->all();
    }

    public function presenter()
    {
        return ProjectPresenter::class;
    }

}