<?php

declare(strict_types=1);

// error reporting
ini_set('display_errors', '1');

// get page
$page = $_GET['page'];

// require page
require dirname(__DIR__) . '/' . $page . '.php';
