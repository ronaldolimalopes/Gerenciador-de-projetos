<?php

namespace Ronaldolopes\GerenciadorProjetos\Modules;

interface Contract
{
    public function getNamespace() : array;
    public function getContainerConfig() : string;
    public function getEventConfig() : string;
    public function getMiddlewareConfig() : string;
    public function getRouteConfig() : string;
}
