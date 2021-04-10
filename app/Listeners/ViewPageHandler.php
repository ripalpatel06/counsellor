<?php

namespace App\Listeners;

use App\Events\ViewPage;
use App\Listing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Session\Store;

class ViewPageHandler
{
    protected $_session;

    public function __construct(Store $session)
    {
        $this->_session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  ViewListings  $event
     * @return void
     */
    public function handle(ViewPage $event)
    {
        $event->getEntities()->each(function($entity){
            if (!$this->isEntityViewed($entity)) {
                $entity->increment('views');
                $this->storeListing($entity);
            }
        });
    }

    protected function isEntityViewed(Model $entity)
    {
        $viewed = $this->_session->get($this->_generateKey($entity), []);
        return array_key_exists($entity->id, $viewed);
    }

    protected function storeListing(Model $entity)
    {
        $key = "{$this->_generateKey($entity)}.{$entity->id}";
        $this->_session->put($key, time());
    }

    protected function _generateKey(Model $entity)
    {
        return 'viewed_'.class_basename($entity);
    }
}
