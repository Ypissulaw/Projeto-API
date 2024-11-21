<?php
    require('config.php');

    //meu metodo requerido vira variavel e converte para minusculo
    $method=strtolower($_SERVER['REQUEST_METHOD']);//util para diferenciar os tipos de requisição: GET, POST ETC...
    if($method==='put'){
        //le o pedido e converte em array associativo $input
        parse_str(file_get_contents('php://input'),$input);

        //valores convertidos no array assosiativo do $input
        $id=$input['id']??null;
        $title=$input['title']??null;
        $body=$input['body']??null;

        //filtragem
        $id=filter_var($id);
        $title=filter_var($title);
        $body=filter_var($body);

        if($id && $title && $body){
            $sql=$pdo->prepare("UPDATE notes SET title=:title, body=:body WHERE id=:id"); //PREPARA PARA CUNSULTAR NOTES QUANDO ID = ID FORNECIDO PELA URL
            $sql->bindValue(':id', $id); //ID DA CONSULTA == ID USER. assim ninguem add id inexsistente
            $sql->bindValue(':title', $title);
            $sql->bindValue(':body', $body);
            $sql->execute();

            $array['result']=[
                'id'=>$id,
                'title'=>$title,
                'body'=>$body
            ];
        }

        
    } else{
        $array['error']='Nao aceito';
    }
    require('return.php');