<?php

require_once __DIR__ . '/vendor/autoload.php';

use Dnovikov\OpenApiTools\App;

$status = App::run();

exit($status);
