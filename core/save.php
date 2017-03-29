<?php
require_once 'crud.php';

//isset()
$value = isset($_POST['tipo']) ? $_POST['tipo'] : '';
$crud = new crud();
switch ($value) {
	case 'editausr':
	$id = $_POST['id'];
	$nome = $_POST['nome'];
	$edt = $crud->atualizaUsr($id,$nome);
	if ($edt == true) {
		echo 1;
	}else{
		echo 0;
	}
	break;
	case 'cria':
	$titulo = $_POST['titulo'];
	$nome = $_POST['nome'];
	$data_nasc = $_POST['data_nasc'];
	$sexo = $_POST['sexo'];
	$endereco = $_POST['endereco'];
	$bairro = $_POST['bairro'];
	$nome_mae = $_POST['nome_mae'];
	$data_cadastro = $_POST['datahj'];
	$responsavel_cadastro = $_POST['idCad'];
	$sub_coordenador = $_POST['sub_coordenador'];
	$cdt = $crud->criaCad($titulo,$nome,$data_nasc,$sexo,$endereco,$bairro,$nome_mae,$data_cadastro,$responsavel_cadastro,$sub_coordenador);
	if ($cdt == true) {
		echo 1;
	}else{
		echo 0;
	}
	break;

	case 'editacad':
	$id = $_POST['id'];
	$nome = $_POST['nome'];
	$endereco = $_POST['endereco'];
	$data_nasc = $_POST['idade'];
	$sexo = $_POST['sexo'];
	$titulo = $_POST['titulo'];
	$bairro = $_POST['bairro'];
	$nome_mae = $_POST['nome_mae'];
	$edt = $crud->atualizaCad($id,$titulo,$nome,$data_nasc,$sexo,$endereco,$bairro,$nome_mae);
	if ($edt == true) {
		echo 1;
	}else{
		echo 0;
	}
	break;
	
	case 'deletacad':
	$id = $_POST['id'];
	$del = $crud->deletaCad($id);
	if ($del == true) {
		echo 1;
	}else{
		echo 0;
	}
	break;

	case 'criaScr':
	$nome = $_POST['nome'];
	$sexo = $_POST['sexo'];
	$titulo = $_POST['titulo_eleitor'];
	$cpf = $_POST['cpf'];
	$rg = $_POST['rg'];
	$endereco = $_POST['endereco'];
	$bairro = $_POST['bairro'];
	$coord = $_POST['crd'];
	$cdt = $crud->criaSbcr($nome,$sexo,$titulo,$cpf,$rg,$endereco,$bairro,$coord);
	if ($cdt == true) {
		echo 1;
	}else{
		echo 0;
	}
	break;

	case 'criaUsr':
	$titulo = $_POST['titulo'];
	$nome = $_POST['nome'];
	$rg = $_POST['RG'];
	$cpf = $_POST['cpf'];
	$sexo = $_POST['sexo'];
	$endereco = $_POST['endereco'];
	$bairro = $_POST['bairro'];
	$user = $_POST['nomeUser'];
	$pass = $_POST['pass'];
	$cdt = $crud->criaUsr($titulo,$nome,$cpf,$rg,$sexo,$user,$pass,$endereco,$bairro);
	if ($cdt == true) {
		echo 1;
	}else{
		echo 0;
	}
	break;
}
?>