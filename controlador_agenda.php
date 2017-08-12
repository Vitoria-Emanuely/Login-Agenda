<?php

//
function prettyHeader($contatosAuxiliar){

    $contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT); //O array(PHP) $contatosJson foi codificado para json e foi deixado mais organizado ("bonitnho") com o JSON_PRETTY_PRINT;

    file_put_contents('contatos.json', $contatosJson); //Está sendo atribuído strings ao arquivo contatos.json e o mesmo está sendo salvo (contatos.json);

    header("Location: index.phtml"); //É redirecionado para a página index.phtml (página inicial) ao ser feito uma ação;


}


//TRANSFORMA  JSON EM ARRAY
function codific(){


    $contatosAuxiliar = file_get_contents('contatos.json'); //Transforma o arquivo contatos.json atribuindo strings ao mesmo (arquivo json);
    $contatosAuxiliar = json_decode($contatosAuxiliar, true); //O arquivo .json foi decodificado/transformado em um array (PHP), e o argumento true faz com que os dados do arquivo sejam lidos como um array associativo;
    return $contatosAuxiliar;
}

//CADASTRA OS CONTATOS
function cadastrar($nome,$email,$telefone){

    $contatosAuxiliar = codific();


    $contato = [
        'id'       => uniqid(),//Função que gera um ID único aleatório;
        'nome'     => $nome,
        'email'    => $email,
        'telefone' => $telefone
    ];

    array_push($contatosAuxiliar, $contato); //No array $contatosAuxiliar  está sendo adicionado valores do array $contato;

    prettyHeader($contatosAuxiliar);

}


//BUSCA OS CONTATOS
function buscar($busca = null){

    $contatosAuxiliar= codific();

    $contatosEncontrados = [];

    if ($busca == null || $busca == ""){

        $contatosEncontrados = getContact();

    } else {

        foreach ($contatosAuxiliar as $contato) {
            if ($contato['nome'] == $busca) {
                //echo "Achei o danado";
                $contatosEncontrados[] = $contato;
            }

        }
    }

    return $contatosEncontrados;

}



//PEGA O CONTATO
function getContact(){

    $contatosAuxiliar= codific();
    return $contatosAuxiliar;

}


//EXCLUIR O CONTATO
function excluirContato($id){

    $contatosAuxiliar= codific();

    foreach($contatosAuxiliar as $posicao => $contato){
        if($id == $contato['id']){

            unset($contatosAuxiliar[$posicao]);
        }
    }

    prettyHeader($contatosAuxiliar);

}


//EDITAR O CONTATO
function editarContato($id)
{

    $contatosAuxiliar = codific();

    foreach ($contatosAuxiliar as $contato) {
        if ($contato['id'] == $id) {
            //echo "Achei o danado";
            return $contato;
        }

    }
 }


//SALVAR CONTATO EDITADO
function salvarContatoEditado($id,$new){

    $contatosAuxiliar= codific();

    foreach($contatosAuxiliar as $posicao => $contato){
        if($contato['id'] == $id){
            $contatosAuxiliar[$posicao]['nome']= $new['nome'];
            $contatosAuxiliar[$posicao]['email']= $new['email'];
            $contatosAuxiliar[$posicao]['telefone']= $new['telefone'];


            break;
        }
    }

    prettyHeader($contatosAuxiliar);
}


//ROTAS
if ($_GET['acao'] == 'cadastrar'){
    cadastrar($_POST['nome'],$_POST['email'], $_POST['telefone'] );

}elseif($_GET['acao']=='excluir'){
    excluirContato($_GET['id']);

}elseif($_GET['acao']=='editar'){
    salvarContatoEditado($_POST['id'], $_POST);

}elseif($_GET['acao']=='buscar') {
   buscar($_GET['busca']);

}