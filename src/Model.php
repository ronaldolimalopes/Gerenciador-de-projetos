<?php
namespace Ronaldolopes\GerenciadorProjetos;

use Pimple\Container;
use Ronaldolopes\GerenciadorProjetos\QueryBuilder;

class Model
{
    private $db;
    private $event;
    protected $table = 'users';

    public function __construct(Container $container)
    {
        $this->db = $container['db'];
        $this->event = $container['events'];

        if(!$this->table){
            $table = explode('\\', get_called_class());
            $table = array_pop($table);
            $this->table = strtolower($table);
        }
    }

    public function get($conditions)
    {
        $queryBuilder = new QueryBuilder;
        $query = $queryBuilder->select($this->table)->where($conditions)->getData();
        
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $this->event->trigger('creating.'.$this->table, null, $data);
        
        $queryBuilder = new QueryBuilder;
        $query = $queryBuilder->insert($this->table, $data)->getData();
        
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute(array_values($query->bind));
        
        $result = $this->get($this->db->lastInsertId());

        $this->event->trigger('created.'.$this->table, null, $result);

        return $result;
    }

    public function all()
    {
        $queryBuilder = new QueryBuilder;
        $query = $queryBuilder->select($this->table)->getData();
        
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($conditions, array $data)
    {
        $this->event->trigger('updating.'.$this->table, null, $data);

        $queryBuilder = new QueryBuilder;
        $query = $queryBuilder->update($this->table, $data)->where($conditions)->getData();
        
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute(array_values($query->bind));

        $result = $this->get($conditions);
        
        $this->event->trigger('updated.'.$this->table, null, $data);

        return  $result;
    }

    public function delete($conditions)
    {
        $result = $this->get($conditions);
        $queryBuilder = new QueryBuilder;
        $query = $queryBuilder->delete($this->table)->where($conditions)->getData();
        
        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);
       
        return  $result;
    }
}