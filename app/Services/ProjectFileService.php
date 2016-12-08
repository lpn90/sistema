<?php
/**
 * User: Leonardo
 * Date: 17/11/2016
 * Time: 16:27
 */

namespace Sistema\Services;


use Sistema\Repositories\ProjectFileRepository;
use Sistema\Repositories\ProjectRepository;
use Sistema\Validators\ProjectFileValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;


class ProjectFileService
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
     * ProjectFileService constructor.
     * @param $repository
     * @param $validator
     */
    public function __construct(ProjectFileRepository $repository, ProjectRepository $projectRepository, ProjectFileValidator $validator, Storage $storage, Filesystem $filesystem)
    {
        $this->repository = $repository;
        $this->fileValidator = $validator;
        $this->storage = $storage;
        $this->fileSystem = $filesystem;
        $this->projectRepository = $projectRepository;
    }

    public function create(array $data)
    {
        try {
            $this->fileValidator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $project = $this->projectRepository->skipPresenter()->find($data['project_id']);
            $projectFile = $project->files()->create($data);

            $this->storage->put($projectFile->id.".".$data['extension'], $this->fileSystem->get($data['file']));

            return $projectFile;
            //return ['error' => false, 'message' => 'Arquivo inserido com sucesso!'];
        } catch (ValidatorException $e) {
            $error = $e->getMessageBag();
            return [
                'error' => true,
                'message' => "Erro ao enviar o arquivo, alguns campos são obrigatórios!",
                'messages' => $error->getMessages(),
            ];
        }
    }

    public function update(array $data, $id)
    {
        try {
            $this->fileValidator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            return $this->repository->update($data, $id);
        } catch (ValidatorException $e) {
            $error = $e->getMessageBag();
            return [
                'error' => true,
                'message' => "Erro ao atualizar o projeto, alguns campos são obrigatórios!",
                'messages' => $error->getMessages(),
            ];
        }
    }

    public function delete($id)
    {
        $projectFile = $this->repository->skipPresenter()->find($id);
        if ($this->storage->exists($projectFile->getFileName())) {
            $this->storage->delete($projectFile->id.'.'.$projectFile->extension);
            $projectFile->delete();
        }
    }

    public function getFilePath($id)
    {
        $projectFile = $this->repository->skipPresenter()->find($id);
        return $this->getBaseURL($projectFile);
    }

    public function getBaseURL($projectFile)
    {
        switch ($this->storage->getDefaultDriver()) {
            case 'local':
                return $this->storage->getDriver()->getAdapter()->getPathPrefix()
                . '/' . $projectFile->getFileName();
        }
    }

    public function getFileName($id)
    {
        $projectFile = $this->repository->skipPresenter()->find($id);
        return $projectFile->getFileName();
    }

    public function getMimeType($id)
    {
        return $this->storage->mimeType($this->getFileName($id));
    }

    /*Validações */

    public function checkProjectOwner($projectFileId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        $projectId = $this->repository->skipPresenter()->find($projectFileId)->project_id;

        return $this->projectRepository->isOwner($projectId, $userId);
    }

    public function checkProjectMember($projectFileId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        $projectId = $this->repository->skipPresenter()->find($projectFileId)->project_id;

        return $this->repository->hasMember($projectId, $userId);
    }

    public function checkProjectPermission($projectFileId)
    {
        if($this->checkProjectOwner($projectFileId) or $this->checkProjectMember($projectFileId)){
            return true;
        }
        return false;
    }

}