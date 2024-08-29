<?php

use Tracy\Debugger;

require_once "./vendor/autoload.php";

Debugger::enable();

$dotenv = Dotenv\Dotenv::createImmutable(dirname('..'));
$dotenv->load();
