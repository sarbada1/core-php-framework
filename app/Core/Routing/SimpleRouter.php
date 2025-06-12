<?php
namespace App\Core\Routing;

use App\Core\Http\Request;
use App\Core\Http\Response;

class SimpleRouter
{
    /**
     * Handle the request and return a response
     *
     * @param Request $request
     * @return Response
     */
    public function dispatch(Request $request)
    {
        // Just return a simple response for debugging
        return new Response('SimpleRouter is working! Requested path: ' . $request->uri());
    }
    
    /**
     * Add a dummy method to prevent errors
     */
    public function loadRoutes($path)
    {
        // Do nothing for now
    }
    
    /**
     * Add a dummy route method to prevent errors
     */
    public function get($uri, $action)
    {
        // Do nothing for now
    }
}