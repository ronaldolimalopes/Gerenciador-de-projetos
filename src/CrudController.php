<?php
namespace Ronaldolopes\GerenciadorProjetos;

abstract class CrudController
{
    abstract protected function getModel(): string;

    public function index($container,$request)
    { 
        return $container[$this->getModel()]->all();
    }

    public function show($container, $request)
    { 
        $data = $container[$this->getModel()]->get(['id' => $request->attributes->get(1)]);
        return json_encode(['data' => $data]); 
    }

    public function create($container, $request)
    { 
        return $container[$this->getModel()]->create($request->request->all());
    }

    public function update($container, $request)
    { 
        return $container[$this->getModel()]->update(['id' => $request->attributes->get(1)], $request->request->all());
    }

    public function delete($container, $request)
    { 
        return $container[$this->getModel()]->delete(['id' => $request->attributes->get(1)]);
    }
}