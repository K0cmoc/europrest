<?php
$env = require  __DIR__ . '/env.php';
// test database! Important not to run tests on production or development databases
$env['db']['dsn'] = 'mysql:host=db_test;dbname=europrest_test';

return $env['db'];
