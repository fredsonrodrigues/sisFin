<?php
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d');
include_once 'vrf_lgin.php';
include_once '../core/crud.php';
$id = $_SESSION['usuarioID'];
$query = 'SELECT * FROM sub_coord';
?>
<div class="container">
	<button type="button" class="btn btn-warning" aria-label="Left Align" id="volta">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Voltar
	</button>
	<h1>Cadastra Digitador</h1><h4>Insira os dados do novo digitador</h4>
	<form id="cdt">
		<div class="row">
			<div class="col-lg-12">
				<br>
				<div class="form-group">
					<input type="text" hidden id="tipo" value="criaUsr">
					<div class="form-group">
						<div class="input-group">
							<input type="text" class="form-control" id="uTitulo" name="uTitulo" placeholder="Titulo" required value="">
							<span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
						</div>
					</div>
					<div class="input-group">
						<input type="text" class="form-control" name="edittName" id="uName" placeholder="Nome completo" required value="">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" id="uCPF" name="uCPF" placeholder="CPF" required value="">
						<span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" id="uRG" name="uRG" placeholder="RG" required value="">
						<span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" id="uEndereco" name="uEndereco" placeholder="Endereço" required value="">
						<span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
					</div>
				</div>
				<div class="form-inline">
					<div class="form-group">
						<div class="input-group">
							<input type="text" class="form-control" id="uBairro" name="uBairro" placeholder="Bairro" required value="">
							<span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<select class="form-control" name="uSexo" id="uSexo">
								<option value="null" disabled>Sexo</option>
								<option value="M">Masculino</option>
								<option value="F">Feminino</option>
							</select>
						</br><span class="input-group-addon"><span class="glyphicon glyphicon-exclamation-sign"></span></span>
					</div>
				</div></br></br>
				<div class="form-inline">
					<div class="form-group">
						<div class="input-group">
							<input type="nome" class="form-control" id="uUser" name="uUser" placeholder="Nome do usuário" required value="">
							<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<input type="password" class="form-control" id="uPass" name="uPass" placeholder="Senha" required value="">
							<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<input type="password" class="form-control" id="uPass2" name="uPass2" placeholder="Repita a Senha" required value="">
							<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						</div>
					</div>
					
				</div>
			</div>
			<br>
		</br>
		<button type="submit" class="btn btn-success btn-lg btn-block" id="submit">Enviar</button>
	</div>
</form>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#volta').click(function(){
			location.reload();
		})
		$('#uSexo').val('null');
		$('#uSbcr').val('null');
		$('#cdt').submit(function(){
			var tipo =$("#tipo").val();
			var titulo = $("#uTitulo").val();
			var nome = $("#uName").val();
			var RG = $("#uRG").val();
			var endereco = $("#uEndereco").val();
			var bairro = $("#uBairro").val();
			var cpf = $("#uCPF").val();
			var sexo = $("#uSexo").val();
			var nomeUser = $("#uUser").val();
			var pass = $("#uPass").val();
			var pass2 = $("#uPass2").val();
			if (pass == pass2) {
	$.ajax({ //Função AJAX
			url:"../core/save.php",			//Arquivo php
			type:"post",				//Método de envio
			data: {tipo:tipo, titulo:titulo, nome:nome, RG:RG, cpf:cpf, sexo:sexo, endereco:endereco, bairro:bairro, nomeUser:nomeUser, pass:pass},	//Dados
   			success: function (result){			//Sucesso no AJAX
   				if(result==1){	
                			alert("Cadastrado com Sucesso!")	//Redireciona
                			$("#uName").val('');
                			$("#uCPF").val('');
                			$("#uSexo").val('null');
                			$("#uUser").val('');
                			$("#uPass").val('')
                			$("#uPass2").val('');
                			$("#uEndereco").val('');
                			$("#uTitulo").val('');
                			$("#uRG").val('');
                		}else{
                			alert("Erro ao salvar");		//Informa o erro
                		}
                	}
                });
} else {
	alert("opa!!!")
}
		return false;//Evita que a página seja atualizada
	});
	});
</script>