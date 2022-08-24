<?php

namespace App;

use Ronaldolopes\GerenciadorProjetos\Modules\Contract;

class Module implements Contract
{
        public function getNamespace() : array
        {
            return [
                'App\\' => __DIR__.'/src'
            ];
        }

        public function getContainerConfig() : string
        {
            return __DIR__.'/config/containers.php';
        }

        public function getEventConfig() : string
        {
            return __DIR__.'/config/Event.php';
        }

        public function getMiddlewareConfig() : string
        {
            return __DIR__.'/config/Middlewares.php';
        }

        public function getRouteConfig() : string
        {
            return __DIR__.'/config/routes.php';
        }
}
