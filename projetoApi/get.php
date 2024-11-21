    <?php
    require('config.php');

    //meu metodo requerido vira variavel e converte para minusculo
    $method=strtolower($_SERVER['REQUEST_METHOD']);//util para diferenciar os tipos de requisição: GET, POST ETC...
    if($method==='get'){
        $id=filter_input(INPUT_GET, 'id');//FILTRA PARA PEGAR VALOR NA URL. 

        if($id){//SE ID FOI FORNECIDO
            $sql=$pdo->prepare("SELECT * FROM notes WHERE id=:id"); //PREPARA PARA CUNSULTAR NOTES QUANDO ID = ID FORNECIDO PELA URL
            $sql->bindValue(':id', $id); //ID DA CONSULTA == ID USER. assim ninguem add id inexsistente
            $sql->execute();
            //CONSULTA COM SEGURANÇA...

            if($sql->rowCount() > 0){
                $data=$sql->fetch(PDO::FETCH_ASSOC);

                $array['result']=[
                    'id'=>$data['id'],
                    'title'=>$data['title'],
                    'body'=>$data['body']
                ];
            }
        } else{
            $array['error']='Nao aceito';
        }
        
    } else{
        $array['error']='Nao aceito';
    }
    require('return.php');