<?php

// $user = array_key_exists('PHP_AUTH_USER', $_SERVER) ? $_SERVER['PHP_AUTH_USER']: '';
// $pwd = array_key_exists('PHP_AUTH_PW', $_SERVER) ? $_SERVER['PHP_AUTH_PW']: '';

// if ($user !== 'mauro' || $pwd !== '1234') {
//     die;
// }



// echo "\n";
// echo "\n";
// echo "Hola";
// echo "\n";
// echo "\n";
// if (
//     !array_key_exists('HTTP_X_HASH', $_SERVER) ||
//     !array_key_exists('HTTP_X_TIMESTAMP', $_SERVER) ||
//     !array_key_exists('HTTP_X_UID', $_SERVER)
// ) {
//     echo "\n";
//     echo "\n";
//     echo "Entro al if a morir";
//     echo "\n";
//     echo "\n";

//     die;
// }

// list ($hash, $uid, $timestamp ) = [
//     $_SERVER['HTTP_X_HASH'],
//     $_SERVER['HTTP_X_UID'],
//     $_SERVER['HTTP_X_TIMESTAMP'],
// ];

// $secret = 'Sh!! No se lo cuentes a nadie!';

// $newHash = sha1($uid.$timestamp.$secret);
// echo "\n";
// echo "\n";
// echo $newHash;
// echo "\n";
// echo "\n";
// echo $hash;
// echo "\n";
// echo "\n";

// if ($newHash !== $hash) {
//     echo "\n";
//     echo "\n";
//     echo "No es igual el hash";
//     echo "\n";
//     echo "\n";
//     die;
// }
// echo "Hola";

// header( 'Content-Type: application/json' );

// if ( !array_key_exists( 'HTTP_X_TOKEN', $_SERVER ) ) {

// 	die;
// }

// $url = 'http://localhost:8001';

// $ch = curl_init( $url );
// curl_setopt( $ch, CURLOPT_HTTPHEADER, [
// 	"X-Token: {$_SERVER['HTTP_X_TOKEN']}",
// ]);
// curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
// $ret = curl_exec( $ch );

// // if ( curl_errno($ch) != 0 ) {
// // 	die ( curl_error($ch) );
// // }

// if ( $ret !== 'true' ) {
// 	// http_response_code( 403 );

// 	die;
// }


header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
// echo "Hola";

// Definimos los recursos disponibles
$allowedResourceTypes = [
    'books',
    'authors',
    'genres'
];

// echo $allowedResourceTypes;

// Validamos que el recurso este disponible
$resourceType = $_GET['resource_type'];

// echo "\nresourceType\n";
// echo $resourceType;
// echo "\nresourceType\n";

if (!in_array($resourceType, $allowedResourceTypes)) {
    die;
}

// Defino los recursos

$books = [
    1 => [
        'titulo' => 'Lo que el viento se llevo',
        'id_autor' => 2,
        'id_genero' => 2
    ],
    2 => [
        'titulo' => 'La Iliada',
        'id_autor' => 2,
        'id_genero' => 2
    ],
    3 => [
        'titulo' => 'La Odisea',
        'id_autor' => 2,
        'id_genero' => 2
    ]
];

header('Content-Type: application/json');

// Levantamos el id del recurso buscado
$resourceId = array_key_exists('resource_id', $_GET) ? $_GET['resource_id'] : '';
// echo $resourceId;

// Generamos la respuesta asumiendo que el pedido es correcto
switch (strtoupper($_SERVER['REQUEST_METHOD'])) {
    case 'GET':
        if (empty($resourceId)) {
            // echo "Empty";
            echo json_encode($books);
        } else {
            if (array_key_exists($resourceId, $books)) {
                echo json_encode($books[$resourceId]);
            }
        }
        break;

    case 'POST':
        $json = file_get_contents('php://input');

        $books[] = json_decode($json, true);

        // echo array_keys($books)[count($books) - 1];
        // echo "\n";
        echo json_encode($books[array_keys($books)[count($books) - 1]]);
        // echo "\n";
        break;

    case 'PUT':
        // validamos que el recurso buscado exista
        if (!empty($resourceId) && array_key_exists($resourceId, $books)) {

            $json = file_get_contents('php://input');

            $books[$resourceId] = json_decode($json, true);
        }

        // echo array_keys($books)[count($books) - 1];
        // echo "\n";
        echo json_encode($books);
        // echo "\n";
        break;

    case 'DELETE':
        if (empty($resourceId)) {
            // echo "Empty";
            echo json_encode($books);
        } else {
            if (array_key_exists($resourceId, $books)) {
                unset($books[$resourceId]);
                echo json_encode($books);
            }
        }
        break;
    default:
        break;
}
