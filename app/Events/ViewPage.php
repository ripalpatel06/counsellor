<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Mockery\CountValidator\Exception;

class ViewPage extends Event
{
    use SerializesModels;

    protected $_entities = null;


    public function __construct($entities)
    {
        if ($entities instanceof Model) {
            $entities = new Collection([$entities]);
        }

        if (!$entities instanceof Collection) {
            throw new Exception('Provided entities must be a Model or a Collection');
        }

        $this->_entities = $entities;
    }

    public function getEntities()
    {
        return $this->_entities;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
