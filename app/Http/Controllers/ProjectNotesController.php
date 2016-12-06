<?php

namespace Sistema\Http\Controllers;

use Illuminate\Http\Request;
use Sistema\Repositories\ProjectNoteRepository;
use Sistema\Services\ProjectNoteService;



class ProjectNotesController extends Controller
{

    /**
     * @var ProjectNoteRepository
     */
    protected $repository;

    /**
     * @var ProjectNoteService
     */
    protected $service;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
    {
        $this->repository = $repository;
        $this->service  = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *@param int $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        return $this->service->create($request->all());
    }


    /**
     * Display the specified resource.
     *
     * @param int $noteId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     *
     */
    public function show($id, $idNote)
    {
        $result = $this->repository->findWhere(['project_id'=> $id, 'id' => $idNote]);
        if(isset($result['data']) && count($result['data'])==1){
            $result = [
                'data' => $result['data'][0]
            ];
        }
        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param int $id
     * @param int $noteId
     * @return array|mixed
     */
    public function update(Request $request, $id, $idNote)
    {

        return $this->service->update($request->all(),$idNote);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @return int
     * @internal param int $idNote
     */
    public function destroy($idNote)
    {
        if ($this->repository->find($idNote)){
            $this->repository->delete($idNote);
        }
        return [
            'error' => false,
            'message' => 'Nota excluida com Sucesso.'
        ];
    }
}
