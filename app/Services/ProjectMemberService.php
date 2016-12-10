<?php
/**
 * User: Leonardo
 * Date: 17/11/2016
 * Time: 16:27
 */

namespace Sistema\Services;


use Sistema\Repositories\ProjectMemberRepository;
use Prettus\Validator\Exceptions\ValidatorException;
use Sistema\Validators\ProjectMemberValidator;


class ProjectMemberService
{
    /**
     * @var ProjectMemberRepository
     */
    protected $repository;

    /**
     * @var ProjectMemberValidator
     */
    protected $validator;

    /**
     * ProjectFileService constructor.
     * @param $repository
     * @param $validator
     */
    public function __construct(ProjectMemberRepository $repository, ProjectMemberValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        }
        catch(ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }
    public function delete($id)
    {
        $projectMember = $this->repository->skipPresenter()->find($id);
        return $projectMember->delete();
    }

}