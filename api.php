<?php

$servidor = "http://rabano.ddns.net:7878/";
$dbname = "estacionamiento";
$user = "androidindmakak";
$pass = "N7/UPOBVxmIy-cgp";

$conn = new mysqli($servidor, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Error" . $conn->connect_error);
}

$requestUri = $_SERVER['REQUEST_URI'];
$parsedURi = parse_url($requestUri);
$urlPath = $parsedURi['path'];

switch ($urlPath) {
    case '/api.php/registro':
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && $urlPath == '/api.php/registro'){
            $sql_1 = "SELECT * FROM registro";
            $result_1 = $conn->query($sql_1);

            while ($row = $result_1->fetch_assoc()) {
                $registro[] = $row;
            }
            echo json_encode($result_1);
            break;
        } else {
            echo json_encode(array("error"=> "Error al obtener la consulta"));
        }

    case '/api.php/registrar':
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $urlPath == '/api.php/registrar') {
            $nom = $_POST["nombre"];
            $correo = $_POST["correo"];
            $noservpub = $_POST["noServPub"];
            $sql_2 = "INSERT INTO registro (nombre, correo, noservpub) 
            VALUES ('" . $nom . "', '" . $correo . "', '" . $noservpub . "');";

            $result_2 = $conn->query($sql_2);
            echo json_encode($result_2);
            echo json_encode(array("Mensaje" => "Se ha registrado con exito"));
        } else {
            echo json_encode(array("error" => "Error al registrar"));
        }
        break;
}
