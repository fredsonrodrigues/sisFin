<?php
include_once 'conex.php';
class crud
{
	//Aqui fazemos a verificação do login do usuário e do seu nível de acesso
	public function pesquisaLoginUsr($nome,$senha)
	{
		$db = new Database();
		$pdo = $db->connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pwd = sha1($senha);
		$sql = "SELECT * FROM login where nome ='".$nome."' AND senha ='".$pwd."'";
		$q = $pdo->prepare($sql);
		$q->execute();
		$data = $q->fetch(PDO::FETCH_ASSOC);
		return $data;
	}
	//a partir dessa função, o usuário pode alterar as credenciais.
	public function getID($id)
	{
		$db = new Database();
		$pdo = $db->connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare("SELECT * FROM login WHERE id=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	//Nessa função, fazemos a montagem da tabela de dados.
	public function dataview($query)
	{
		$db = new Database();
		$pdo = $db->connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare($query);
		$stmt->execute();
		return $stmt;
		
	}
	//Esta é a função que atualiza o Nome do usuário.
	public function atualizaUsr($id,$nome)
	{
		$db = new Database();
		$pdo = $db->connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try
		{
			$stmt=$pdo->prepare("UPDATE login SET usuario=:name
				WHERE id=:id ");
			$stmt->bindparam(":name",$nome);
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			
			return true;	
		}catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	//Esta é a função que atualiza o cadastro com os dados vindos da edição.
	public function atualizaCad($id,$titulo,$nome,$data_nasc,$sexo,$endereco,$bairro,$nome_mae)
	{
		$db = new Database();
		$pdo = $db->connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try
		{
			$stmt=$pdo->prepare("UPDATE usuarios SET titulo_eleitor=:titulo_eleitor, nome_completo=:nome_completo, data_nasc=:data_nasc, sexo=:sexo, endereco=:endereco, bairro=:bairro, nome_mae=:nome_mae WHERE id=:id ");
			$stmt->bindparam(":id",$id);
			$stmt->bindparam(":titulo_eleitor",$titulo);
			$stmt->bindparam(":nome_completo",$nome);
			$stmt->bindparam(":data_nasc",$data_nasc);
			$stmt->bindparam(":sexo",$sexo);
			$stmt->bindparam(":endereco",$endereco);
			$stmt->bindparam(":bairro",$bairro);
			$stmt->bindparam(":nome_mae",$nome_mae);
			$stmt->execute();
			
			return true;	
		}catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}

	//Essa é a função responsável pela criação do cadastro da pessoa no sistema.
	public function criaCad($titulo,$nome,$data_nasc,$sexo,$endereco,$bairro,$nome_mae,$data_cadastro,$responsavel_cadastro,$sub_coordenador)
	{
		$db = new Database();
		$pdo = $db->connect();
		try
		{
			$stmt=$pdo->prepare("INSERT INTO usuarios(titulo_eleitor,nome_completo,data_nasc,sexo,endereco,bairro,nome_mae,data_cadastro,responsavel_cadastro,sub_coordenador) VALUES(:titulo_eleitor, :nome_completo, :data_nasc, :sexo, :endereco, :bairro, :nome_mae, :data_cadastro, :responsavel_cadastro, :sub_coordenador)");
			$stmt->bindparam(":titulo_eleitor",$titulo);
			$stmt->bindparam(":nome_completo",$nome);
			$stmt->bindparam(":data_nasc",$data_nasc);
			$stmt->bindparam(":sexo",$sexo);
			$stmt->bindparam(":endereco",$endereco);
			$stmt->bindparam(":bairro",$bairro);
			$stmt->bindparam(":nome_mae",$nome_mae);
			$stmt->bindparam(":data_cadastro",$data_cadastro);
			$stmt->bindparam(":responsavel_cadastro",$responsavel_cadastro);
			$stmt->bindparam(":sub_coordenador",$sub_coordenador);
			$stmt->execute();
			
			return true;	
		}catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	//Essa é a função responsável por deletar a pessoa da lista.
	public function deletaCad($id)
	{
		$db = new Database();
		$pdo = $db->connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare("DELETE FROM usuarios WHERE id=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		return true;
	}

	public function criaUsr($titulo,$nome,$cpf,$rg,$sexo,$user,$pass,$endereco,$bairro)
	{
		$db = new Database();
		$pdo = $db->connect();
		$pwd = sha1($pass);
		$nivel = 1;
		
		try
		{
			$stmt=$pdo->prepare("INSERT INTO login(nome, senha, nivel, usuario, titulo_eleitor, cpf, rg, sexo, endereco, bairro) VALUES(:nome, :senha, :nivel, :usuario, :titulo_eleitor, :cpf, :rg, :sexo, :endereco, :bairro)");
			$stmt->bindparam(":nome",$user);
			$stmt->bindparam(":senha",$pwd);
			$stmt->bindparam(":nivel",$nivel);
			$stmt->bindparam(":usuario",$nome);
			$stmt->bindparam(":titulo_eleitor",$titulo);
			$stmt->bindparam(":cpf",$cpf);
			$stmt->bindparam(":rg",$rg);
			$stmt->bindparam(":sexo",$sexo);
			$stmt->bindparam(":endereco",$endereco);
			$stmt->bindparam(":bairro",$bairro);
			$stmt->execute();
			
			return true;	
		}catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
		
	}

	public function criaSbcr($nome,$sexo,$titulo,$cpf,$rg,$endereco,$bairro,$coord)
	{
		$db = new Database();
		$pdo = $db->connect();
		try
		{
			$stmt=$pdo->prepare("INSERT INTO sub_coord(nome, sexo, titulo_eleitor, cpf, rg, endereco, bairro, coord) VALUES(:nome, :sexo, :titulo_eleitor, :cpf, :rg, :endereco, :bairro, :coord)");
			$stmt->bindparam(":nome",$nome);
			$stmt->bindparam(":sexo",$sexo);
			$stmt->bindparam(":titulo_eleitor",$titulo);
			$stmt->bindparam(":cpf",$cpf);
			$stmt->bindparam(":rg",$rg);
			$stmt->bindparam(":endereco",$endereco);
			$stmt->bindparam(":bairro",$bairro);
			$stmt->bindparam(":coord",$coord);
			$stmt->execute();
			
			return true;	
		}catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
		
	}
}
?>