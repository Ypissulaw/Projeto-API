<?php
$array['pong'] = true;

header("Access-Control-Allow-Origin: *"); //acesso a quaqluer origem
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); //metodos permitidos
header("Content-Type: application/json"); // volta json
echo json_encode($array);
exit;

