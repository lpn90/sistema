<?php
/**
 * User: Leonardo
 * Date: 17/11/2016
 * Time: 16:27
 */

namespace Sistema\Services;


use Sistema\Repositories\ProjectRepository;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Sistema\Validators\ProjectValidator;

class ProjectService
{
    /**
     * @var ProjectRepository
     */
    protected $repository;

    /**
     * @var ProjectValidator
     */
    protected $validator;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Storage
     */
    private $storage;

    /**
     * ClientService constructor.
     * @param $repository
     * @param $validator
     */
    public function __construct(ProjectRepository $repository, ProjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {

        try{
            $this->validator->with($data)->passesOrFail();

            return $this->repository->create($data);

        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

    public function update(array $data, $id)
    {

        try{
            $this->validator->with($data)->passesOrFail();

            return $this->repository->update($data, $id);

        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }
    
    public function addMember(array $data)
    {
        $project = $this->repository->skipPresenter()->find($data['project_id']);
        return $project->members()->create($data);
    }

    public function removeMember($id, $memberId)
    {
        $project = $this->repository->skipPresenter()->find($id);
        $project->members()->destroy($memberId);
    }

    public function isMember($id, $memberId)
    {
        $project = $this->repository->skipPresenter()->find($id);

        foreach ($project->members as $member){
            if($member->id == $memberId){
                return true;
            }
        }
        return false;
    }

    public function members($id)
    {
        $project = $this->repository->skipPresenter()->find($id);
        return $project->members;
    }

    /*Validações */

    public function checkProjectOwner($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($projectId, $userId);
    }

    public function checkProjectMember($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($projectId, $userId);
    }

    public function checkProjectPermission($projectId)
    {
        if($this->checkProjectOwner($projectId) or $this->checkProjectMember($projectId)){
            return true;
        }
        return false;
    }

}