<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;

class ViewThrottle
{
    const THROTTLE_TIME = 300;
    const SESSION_KEY_PATTERN = '/^viewed_/';

    protected $_session;

    public function __construct(Store $session)
    {
        $this->_session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $sessionData = $this->_session->all();
        $pattern = self::SESSION_KEY_PATTERN;
        $sessionEntities = array_keys(array_flip(preg_grep($pattern, array_keys($sessionData))));

        foreach ($sessionEntities as $id) {
            $entities = $this->_getViewedEntities($id);

            if ($entities) {
                $entities = $this->_cleanExpiredViews($entities);
                $this->_storeListings($id, $entities);
            }
        }

        return $next($request);
    }

    protected function _getViewedEntities($key)
    {
        return $this->_session->get($key, null);
    }

    protected function _cleanExpiredViews($key)
    {
        $now = time();
        $throttleTime = self::THROTTLE_TIME;

        return array_filter($key, function ($timestamp) use ($now, $throttleTime)
        {
            return ($timestamp + $throttleTime) > $now;
        });
    }

    protected function _storeListings($key, $entities)
    {
        $this->_session->put($key, $entities);
    }
}
