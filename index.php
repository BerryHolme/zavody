<?php
$f3 = require('lib/base.php');
$f3 = \Base::instance();
$f3->config("./app/configs/config.ini");
$f3->set('DB', new \DB\SQL('mysql:host=localhost;dbname=chat','root', ''));
$f3->run();
