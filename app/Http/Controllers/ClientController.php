<?php

namespace Sistema\Http\Controllers;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Sistema\Repositories\ClientRepository;
use Sistema\Services\ClientService;
use Prettus\Validator\Exceptions\ValidatorException;

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
     * @param ClientRepository $repository
     * @param ClientService $service
     */
    public function __construct(ClientRepository $repository, ClientService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->query->get('limit', 15);
        return $this->repository->paginate($limit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            return $this->service->create($request->all());

        } catch (ValidatorException $e) {
            return Response::json ([
                'error' => true,
                'message' => $e->getMessageBag()
            ], 400);
        }
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
            return ['error' => true, 'message' => 'Cliente não encontrado.'];
        } catch (Exception $e) {
            return ['error' => true, 'message' => 'Ocorreu algum erro ao pesquisar o cliente.'];
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

        } catch (ValidatorException $e) {
            return Response::json ([
                'error' => true,
                'message' => $e->getMessageBag()
            ], 400);
        }catch (ModelNotFoundException $e) {
            return Response::json ([
                'error' => true,
                'message' => 'Cliente não encontrado.'
            ], 400);
        } catch (Exception $e) {
            return  Response::json ([
                'error' => true,
                'message' => 'Ocorreu algum erro ao atualizar o cliente.'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if ($this->repository->find($id)) {
                $this->repository->delete($id);
            }
            return response("", 404);
        } catch (QueryException $e) {
            return Response::json ([
                'error' => true,
                'message' => 'Cliente não pode ser apagado pois existe um ou mais projetos vinculados a ele.'
            ], 400);
        } catch (ModelNotFoundException $e) {
            return Response::json ([
                'error' => true,
                'message' => 'Cliente não encontrado.'
            ], 400);
        } catch (Exception $e) {
            return Response::json ([
                'error' => true,
                'message' => 'Ocorreu algum erro ao excluir o cliente.'
            ], 400);
        }
    }
}
