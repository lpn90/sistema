<?php

namespace Sistema\Http\Controllers;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sistema\Repositories\ProjectRepository;
use Sistema\Repositories\ProjectTaskRepository;
use Sistema\Services\ProjectService;
use LucaDegasperi\OAuth2Server\Exceptions\NoActiveAccessTokenException;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectController extends Controller
{

    /**
     * @var ProjectRepository
     */
    private $repository;

    /**
     * @var ProjectService
     */
    private $service;

    /**
     * @var ProjectTaskRepository
     */
    private $taskRepository;

    /**
     * ClientController constructor.
     * @param $repository
     */
    public function __construct(ProjectRepository $repository, ProjectService $service, ProjectTaskRepository $taskRepository)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->taskRepository = $taskRepository;
        $this->middleware('check.project.owner', ['except' => ['index', 'store', 'show']]);
        $this->middleware('check.project.permission', ['except' => ['index', 'store', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->repository->findOwner(\Authorizer::getResourceOwnerId(), $request->query->get('limit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return $this->repository->find($id);
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'Projeto não encontrado.'];
        } catch (Exception $e) {
            return ['error' => true, 'Ocorreu algum erro ao pesquisar o projeto.'];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            return $this->service->update($request->all(), $id);
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'Projeto não encontrado.'];
        } catch (Exception $e) {
            return ['error' => true, 'Ocorreu algum erro ao atualizar o projeto.'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return ['success' => true, 'Projeto deletado com sucesso!'];
        } catch (QueryException $e) {
            return ['error' => true, 'Projeto não pode ser apagado pois existe um ou mais clientes vinculados a ele.'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'Projeto não encontrado.'];
        } catch (Exception $e) {
            return ['error' => true, 'Ocorreu algum erro ao excluir o projeto.'];
        }
    }

    public function members($id)
    {
        try {
            return $this->service->members($id);
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'Projeto não encontrado.'];
        } catch (Exception $e) {
            return ['error' => true, 'Ocorreu algum erro ao pesquisar o projeto.'];
        }
    }

    private function erroMsgm($mensagem)
    {
        return [
            'error' => true,
            'message' => $mensagem,
        ];
    }

}
