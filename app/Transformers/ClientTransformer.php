<?php
/**
 * User: Leonardo
 * Date: 21/11/2016
 * Time: 15:28
 */

namespace Sistema\Transformers;

use Sistema\Entities\Client;
use League\Fractal\TransformerAbstract;


class ClientTransformer extends TransformerAbstract
{

    public function transform(Client $client)
    {
        return [
            'client_id' => $client->id,
            'name' => $client->name,
            'responsible' => $client->responsible,
            'email' => $client->email,
            'phone' => $client->phone,
            'address' => $client->address,
            'obs' => $client->obs,
        ];
    }

}