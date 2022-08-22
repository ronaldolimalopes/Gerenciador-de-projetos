<?php

use App\Events\UsersCreated;

$container['events']->attach('created.users', new UsersCreated);