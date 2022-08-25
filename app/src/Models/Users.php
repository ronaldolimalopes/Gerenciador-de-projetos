<?php

namespace App\Models;
use Pimple\Container;
use Ronaldolopes\GerenciadorProjetos\QueryBuilder;

class Users
{
    private $db;
    private $event;

    public function __construct(Container $container)
    {
        $this->db = $container['db'];
        $this->event = $container['events'];
    }

    public function get($conditions)
    {
        $queryBuilder = new QueryBuilder;
        $query = $queryBuilder->select('users')->where($conditions)->getData();
        
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $this->event->trigger('creating.users', null, $data);
        
        $queryBuilder = new QueryBuilder;
        $query = $queryBuilder->insert('users', $data)->getData();
        
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute(array_values($query->bind));
        
        $result = $this->get($this->db->lastInsertId());

        $this->event->trigger('created.users', null, $result);

        return $result;
    }

    public function all()
    {
        $queryBuilder = new QueryBuilder;
        $query = $queryBuilder->select('users')->getData();
        
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($conditions, array $data)
    {
        $this->event->trigger('updating.users', null, $data);

        $queryBuilder = new QueryBuilder;
        $query = $queryBuilder->update('users', $data)->where($conditions)->getData();
        
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute(array_values($query->bind));

        $result = $this->get($conditions);
        $this->event->trigger('updated.users', null, $data);

        return  $result;
    }

    public function delete($conditions)
    {
        $result = $this->get($conditions);
        $queryBuilder = new QueryBuilder;
        $query = $queryBuilder->delete('users')->where($conditions)->getData();
        
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
       
        return  $result;
    }
}