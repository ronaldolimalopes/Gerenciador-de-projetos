<?php

namespace App\Models;
use Pimple\Container;

class Users
{
    private $db;
    private $event;

    public function __construct(Container $container)
    {
        $this->db = $container['db'];
        $this->event = $container['events'];
    }

    public function get($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM `users` WHERE id=?');
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $this->event->trigger('creating.users', null, $data);
         
        $sql = 'INSERT INTO `users` (`name`) VALUES (?)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_values($data));
        $result = $this->get($this->db->lastInsertId());

        $this->event->trigger('created.users', null, $result);

        return $result;
    }

    public function all()
    {
        $stmt = $this->db->prepare('SELECT * FROM `users`');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($id, array $data)
    {
        $this->event->trigger('updating.users', null, $data);
         
        $sql = 'UPDATE `users` SET name=? WHERE id=?';

        $data = array_merge($data, ['id' => $id]);
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_values($data));

        $result = $this->get($id);

        $this->event->trigger('updated.users', null, $data);

        return  $result;
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM `users` WHERE id=?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $result = $this->all();
        return  $result;
    }
}