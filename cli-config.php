<?php

use damianbal\Core\App;

include 'vendor/autoload.php';

$app = new App;

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($app->getEntityManager());
