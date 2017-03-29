<?php

 include_once 'core/crud.php';					//Seleciona banco de dados
  
  $nome=$_POST['user'];	//Pegando dados passados por AJAX
  $senha=$_POST['senha'];
  $crud = new crud();
  $vf = $crud->pesquisaLoginUsr($nome,$senha);
  

	if ($vf == 0){
		echo 0;	//Se a consulta não retornar nada é porque as credenciais estão erradas
	}
	
	else{
		echo 1;	//Responde sucesso
		if(!isset($_SESSION)) 	//verifica se há sessão aberta
		session_start();		//Inicia seção
		//Abrindo seções
		$_SESSION['usuarioID']=$vf['id']; 		
		$_SESSION['nomeUsuario']=$vf['usuario'];
		$_SESSION['nivel']=$vf['nivel'];
		exit;	
	}

?>
