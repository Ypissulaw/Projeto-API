<?php
    require('config.php');

    //meu metodo requerido vira variavel e converte para minusculo
    $method=strtolower($_SERVER['REQUEST_METHOD']);//util para diferenciar os tipos de requisição: GET, POST ETC...
    if($method==='post'){
        $title=filter_input(INPUT_POST, 'title');//FILTRA PARA PEGAR VALOR NA URL.
        $body=filter_input(INPUT_POST, 'body');//FILTRA PARA PEGAR VALOR NA URL.

        if($title && $body){//se title and body forem fornecidos
            $sql=$pdo->prepare("INSERT INTO notes (title, body) VALUES (:title, :body)");//prepara para inserir dados em titulo e corpo
            $sql->bindValue('title', $title);//linka titulo com titulo do banco de dados
            $sql->bindValue('body', $body);//linka corpo com corpo do banco de dados
            $sql->execute();

            //ja funfa, mas precisamos ao menos mostrar quem foi add,

            $id=$pdo->lastInsertId();//pega id do ultimo registro add. OBRIGATORIO

            $array['result']= 
            [
                'id'=> $id,
                'title'=> $title,
                'body'=> $body
            ]//CONSTRUINDO MINHA RESPOSTA
        } else{
            $array['error']='Campos não enviados';
        }
        
    } else{
        $array['error']='Nao aceito';
    }
    require('return.php');