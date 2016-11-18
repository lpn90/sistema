<?php
/**
 * User: Leonardo
 * Date: 17/11/2016
 * Time: 16:27
 */

namespace Sistema\Services;


use Sistema\Repositories\ProjectNoteRepository;
use Prettus\Validator\Exceptions\ValidatorException;
use Sistema\Validators\ProjectNoteValidator;

class ProjectNoteService
{
    /**
     * @var ProjectNoteRepository
     */
    protected $repository;

    /**
     * @var ProjectNoteValidator
     */
    protected $validator;

    /**
     * ClientService constructor.
     * @param $repository
     * @param $validator
     */
    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
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

}