<?php

namespace Sistema\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Sistema\Repositories\ProjectTaskRepository;
use Sistema\Services\ProjectTaskService;
use Sistema\Validators\ProjectTaskValidator;

class ProjectTasksController extends Controller
{

    /**
     * @var ProjectTaskRepository
     */
    protected $repository;

    /**
     * @var ProjectTaskService
     */
    protected $service;

    /**
     * @var ProjectTaskValidator
     */
    protected $validator;

    /**
     * ProjectTaskController constructor.
     * @param ProjectTaskRepository $repository
     * @param ProjectTaskService $service
     * @param ProjectTaskValidator $validator
     */
    public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service, ProjectTaskValidator $validator)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->validator = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        return $this->service->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $taskId)
    {
        try{
            return $this->repository->findWhere(['project_id'=> $id, 'id' => $taskId]);
        }catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Tarefa não encontrada.'];
        } catch (Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao pesquisar a tarefa.'];
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $taskId, $id)
    {
        try{
            $data = $request->all();
            $data['project_id'] = $id;
            return $this->service->update($data,$taskId);
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Tarefa não encontrada.'];
        } catch (Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao atualizar a tarefa.'];
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $taskId
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $taskId)
    {
        try {
            if ($this->repository->find($taskId)){
                $this->repository->delete($taskId);
            }
            return ['success'=>true, 'Tarefa deletada com sucesso!'];
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Tarefa não encontrada.'];
        } catch (Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao excluir a tarefa.'];
        }
    }
}
