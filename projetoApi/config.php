<?php
$db_host = "localhost"; 
$db_name = "devsnotes";
$db_user = "root";
$db_pass = "";
//conexão com banco de dados
$pdo=new PDO("mysql:dbname=$db_name;host=$db_host",$db_user, $db_pass);

//array retorna vazio quando erro, e mensagem de sucesso
$array=[
    'error'=> '',
    'result'=> []
];