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
        $stmt =  $this->db->prepare('SELECT * FROM `users` WHERE id=?');
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $this->event->trigger('creating.users', null, $data);
         //
        $this->event->trigger('created.users', null, $data);
    }
}