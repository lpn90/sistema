<?php
/**
 * User: Leonardo
 * Date: 14/12/2016
 * Time: 17:34
 */

namespace Sistema\Events;


use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Sistema\Entities\ProjectTask;

class TaskWasIncluded extends Event implements ShouldBroadcast
{
    use SerializesModels;
    
    public $task;

    public function __construct(ProjectTask $task)
    {
        $this->task = $task;
    }

    /**
     * @return array
     */
    public function broadcastOn()
    {
        return ['user.'.\Authorizer::getResourceOwnerId()];
    }

}