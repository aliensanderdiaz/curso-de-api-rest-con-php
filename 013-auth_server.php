<?php

$method = strtoupper( $_SERVER['REQUEST_METHOD'] );

$token = "5d0937455b6744.68357201";

if ( $method === 'POST' ) {
    if ( !array_key_exists( 'HTTP_X_CLIENT_ID', $_SERVER ) || !array_key_exists( 'HTTP_X_SECRET', $_SERVER ) ) {
        http_response_code( 400 );

        die( 'Faltan parametros' );
    }

    $clientId = $_SERVER['HTTP_X_CLIENT_ID'];
    $secret = $_SERVER['HTTP_X_SECRET'];

    if ( $clientId !== '1' || $secret !== 'SuperSecreto!' ) {
        http_response_code( 403 );

        die ( "No autorizado");
    }
    echo "\n";
    echo "\n";
    echo "$token";
    echo "\n";
    echo "\n";
} elseif ( $method === 'GET' ) {
    if ( !array_key_exists( 'HTTP_X_TOKEN', $_SERVER ) ) {
        http_response_code( 400 );

        die ( 'Faltan parametros' );
    }

    if ( $_SERVER['HTTP_X_TOKEN'] == $token ) {
        echo 'true';
    } else {
        echo 'false';
    }
} else {
    echo 'false';
}


// curl http://localhost:8001 -X 'POST' -H 'X-Client-Id: 1' -H 'X-Secret: SuperSecreto!'
// 1115d0937455b6744.68357201
// 5d0937455b6744.68357201
// curl http://localhost:8000/books -H 'X-Token: 5d0937455b6744.68357201'

