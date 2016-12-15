<?php
/**
 * User: Leonardo
 * Date: 17/11/2016
 * Time: 16:27
 */

namespace Sistema\Services;


use Sistema\Repositories\ClientRepository;
use Sistema\Validators\ClientValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientService
{
    /**
     * @var ClientRepository
     */
    protected $repository;

    /**
     * @var ClientValidator
     */
    protected $validator;

    /**
     * ClientService constructor.
     * @param $repository
     * @param $validator
     */
    public function __construct(ClientRepository $repository, ClientValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {
        $this->validator->with($data)->passesOrFail();

        return $this->repository->create($data);
    }

    public function update(array $data, $id)
    {

        try {
            $this->validator->with($data)->passesOrFail();

            return $this->repository->update($data, $id);

        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

}