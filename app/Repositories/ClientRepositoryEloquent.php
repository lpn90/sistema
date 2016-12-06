<?php
/**
 * User: Leonardo
 * Date: 17/11/2016
 * Time: 15:35
 */

namespace Sistema\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use Sistema\Entities\Client;
use Sistema\Presenters\ClientPresenter;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{

    protected $fieldSearchable = [
        'name',
        'email',
    ];

    public function model()
    {
        return Client::class;
    }
    
    public function presenter()
    {
        return ClientPresenter::class;
    }

    public function boot()
    {
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }

}