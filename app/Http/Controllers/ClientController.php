<?php

namespace Sistema\Http\Controllers;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sistema\Repositories\ClientRepository;
use Sistema\Services\ClientService;

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    private $repository;

    /**
     * @var ClientService
     */
    private $service;

    /**
     * ClientController constructor.
     * @param $repository
     */
    public function __construct(ClientRepository $repository, ClientService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            return $this->repository->find($id);
        }catch (ModelNotFoundException $e) {
            return ['error'=>true, 'message'=>'Cliente não encontrado.'];
        } catch (Exception $e) {
            return ['error'=>true, 'message'=>'Ocorreu algum erro ao pesquisar o cliente.'];
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            return $this->service->update($request->all(),$id);
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'message'=>'Cliente não encontrado.'];
        } catch (Exception $e) {
            return ['error'=>true, 'message'=>'Ocorreu algum erro ao atualizar o cliente.'];
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if ($this->repository->find($id)){
                $this->repository->delete($id);
            }
            return ['error'=>false, 'message'=>'Cliente deletado com sucesso!'];
        } catch (QueryException $e) {
            return ['error'=>true, 'message'=>'Cliente não pode ser apagado pois existe um ou mais projetos vinculados a ele.'];
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'message'=>'Cliente não encontrado.'];
        } catch (Exception $e) {
            return ['error'=>true, 'message'=>'Ocorreu algum erro ao excluir o cliente.'];
        }
    }
}
