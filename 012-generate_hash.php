<?php

$time = time();
echo "Time: $time".PHP_EOL."Hash: ".sha1($argv[1].$time.'Sh!! No se lo cuentes a nadie!').PHP_EOL;

// curl http://localhost:8000/books -H "X-HASH: f6c0e3acc7827838cccda4ede235154045de7ea2" -H "X-UID: 1" -H "X-TIMESTAMP: 1663877343"