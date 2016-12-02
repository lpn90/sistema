<?php
/**
 * User: Leonardo
 * Date: 17/11/2016
 * Time: 16:27
 */

namespace Sistema\Services;


use Sistema\Repositories\ProjectFileRepository;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Sistema\Validators\ProjectFileValidator;

class ProjectService
{
    /**
     * @var ProjectRepository
     */
    private $projectRepository;
    /**
     * @var ProjectFileRepository
     */
    protected $repository;

    /**
     * @var ProjectFileValidator
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
    public function __construct(ProjectFileRepository $repository, ProjectRepository $projectRepository, ProjectFileValidator $validator,  Storage $storage, Filesystem $filesystem)
    {
        $this->repository = $repository;
        $this->fileValidator = $validator;
        $this->storage = $storage;
        $this->fileSystem = $filesystem;
        $this->projectRepository = $projectRepository;
    }

    public function create(array $data)
    {
        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $project = $this->projectRepository->skipPresenter()->find($data['project_id']);
            $projectFile = $project->files()->create($data);
            $this->storage->put($projectFile->getFileName(), $this->fileSystem->get($data['file']));
            return ['error'=>false, 'message'=>'Arquivo inserido com sucesso!'];
        }
        catch(ValidatorException $e){
            $error = $e->getMessageBag();
            return [
                'error' => true,
                'message' => "Erro ao enviar o arquivo, alguns campos são obrigatórios!",
                'messages' => $error->getMessages(),
            ];
        }
    }

    public function delete($id)
    {
        $projectFile = $this->repository->skipPresenter()->find($id);
        if($this->storage->exists($projectFile->getFileName())){
            $this->storage->delete($projectFile->getFileName());
            return $projectFile->delete();
        }
    }

    
//    public function update(array $data, $id)
//    {
//
//        try{
//            $this->validator->with($data)->passesOrFail();
//
//            return $this->repository->update($data, $id);
//
//        }catch (ValidatorException $e){
//            return [
//                'error' => true,
//                'message' => $e->getMessageBag()
//            ];
//        }
//
//    }

//    public function listFile(array $data)
//    {
//        $project = $this->repository->skipPresenter()->find($data['project_id']);
//        $projectFile = $project->files()->create($data);
//
//        $this->storage->put($projectFile->id.".".$data['extension'], $this->filesystem->get($data['file']));
//    }

}