<?php

namespace Framework\Router;

class RouteFactory
{
    public function make($uri, $handler) {
    	return new \Framework\Router\Route($uri, $handler);
    }
}



?>