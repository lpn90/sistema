<?php
/**
 * User: Leonardo
 * Date: 21/11/2016
 * Time: 15:28
 */

namespace Sistema\Transformers;

use Sistema\Entities\Client;
use League\Fractal\TransformerAbstract;

/**
 * Class ClientTransformer
 * @package Sistema\Transformers
 */
class ClientTransformer extends TransformerAbstract
{
    /**
     * Transform the \Client entity
     * @param Client $client
     *
     * @return array
     */

    public function transform(Client $client)
    {
        return [
            'id' => $client->id,
            'name' => $client->name,
            'responsible' => $client->responsible,
            'email' => $client->email,
            'phone' => $client->phone,
            'address' => $client->address,
            'obs' => $client->obs,
        ];
    }

    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMemberTransformer());
    }

}