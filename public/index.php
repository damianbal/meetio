<?php 

/**
 * 
 */


include '../vendor/autoload.php';


use damianbal\Core\App;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use RedBeanPHP\R as R;

// connect

$app = new App;

include '../src/Web/routes.php';

$app->create();