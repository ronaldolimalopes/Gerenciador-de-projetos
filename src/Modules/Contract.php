<?php

namespace Ronaldolopes\GerenciadorProjetos\Modules;

interface Contract
{
    public function getNamespace() : array;
    public function getContainerConfig() : array;
    public function getEventConfig() : array;
    public function getMiddlewareConfig() : array;
    public function getRouteConfig() : array;
}
