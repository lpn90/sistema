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
     * @param $id
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
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        return $this->service->create($request->all());
    }


    /**
     * Display the specified resource.
     *
     * @param $noteId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     *
     */
    public function show($id, $idNote)
    {
        return $this->repository->findWhere(['project_id'=> $id, 'id' => $idNote]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param $id
     * @param $noteId
     * @return array|mixed
     */
    public function update(Request $request, $id, $idNote)
    {

        return $this->service->update($request->all(),$idNote);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param $noteId
     * @return int
     * @internal param int $id
     */
    public function destroy($idNote)
    {
        return $this->repository->delete($idNote);
    }
}
