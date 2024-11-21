<?php
require('config.php');

//meu metodo requerido vira variavel e converte para minusculo
$method=strtolower($_SERVER['REQUEST_METHOD']);
if($method==='get')
{
    //consulta que seleciona td info da tabela
    $sql=$pdo->query("SELECT * FROM notes");
    if($sql->rowCount()>0){
        //pega os registros selecionados, add na variavel
        //$data que obrigada a tranformar em um array assosiativo (tem resumo dele em alguma pasta)
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $item){
            $array['result'][] = [
                'id'=>$item['id'],
                'title'=>$item['title'],
            ];
        }
    }



}else{
    $array['error']='Nao aceito';
}
require('return.php');