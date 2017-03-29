<?php
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d');
include_once 'vrf_lgin.php';
include_once '../core/crud.php';
$id = $_SESSION['usuarioID'];
$crud = new crud();
$query = 'SELECT * FROM sub_coord';
?>
<div class="container">
	<button type="button" class="btn btn-warning" aria-label="Left Align" id="volta">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Voltar
	</button>
	<h1>Cadastra Pessoas</h1><h4>Insira os dados da pessoa abaixo</h4>
	<form id="cdt">
		<div class="row">
			<div class="col-lg-12">
				<br>
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" name="edittName" id="cName" placeholder="Nome completo" required value="">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" id="cEndereco" name="cEndereco" placeholder="Endereco" required value="">
						<span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
					</div>
				</div>
				<div class="form-inline">
					<div class="form-group">
						<div class="input-group">
							<input type="nome" class="form-control" id="cBairro" name="cBairro" placeholder="Bairro" required value="">
							<span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<input type="nome" class="form-control" id="cNasc" name="cNasc" placeholder="Nascimento" required value="">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<select class="form-control" name="cSexo" id="cSexo">
								<option value="null" disabled>Sexo</option>
								<option value="M">Masculino</option>
								<option value="F">Feminino</option>
							</select>
						</br><span class="input-group-addon"><span class="glyphicon glyphicon-exclamation-sign"></span></span>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<select class="form-control" name="cSbcd" id="cSbcd">
								<option value="null" disabled>Sub Coordenador</option>
								<?php
								$select = $crud->dataview($query);
								if($select->rowCount()>0)
								{
									while($row=$select->fetch(PDO::FETCH_ASSOC))
									{
										?>
											<option value="<?php print($row['id']);?>"><?php print($row['nome']); ?></option>
										<?php
									}
								}
								?>
							</select>
						</br><span class="input-group-addon"><span class="glyphicon glyphicon-exclamation-sign"></span></span>
					</div>
				</div>
			</div>
			<br>
			<div class="form-group">
				<div class="input-group">
					<input type="nome" class="form-control" id="cMae" name="cMae" placeholder="Nome da mãe" required value="">
					<span class="input-group-addon"><span class="glyphicon glyphicon-heart-empty"></span></span>
				</div>
			</div>
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
		$('#cSexo').val('null');
		$('#cSbcd').val('null');
		$('#cdt').submit(function(){
			var tipo =$("#tipo").val();
			var titulo = $("#cTitulo").val();
			var nome = $("#cName").val();
			var idd = $("#cNasc").val();
			var endereco = $("#cEndereco").val();
			var bairro = $("#cBairro").val();
			var sexo = $("#cSexo").val();
			var nome_mae = $("#cMae").val();
			var datahj = $("#data").val();
			var idCad = <?php echo $id;?>;
			var sub_coordenador = $("#cSbcd").val();
			i = idd.split("/")
			data_nasc = i[2]+"-"+i[1]+"-"+i[0];
	$.ajax({ //Função AJAX
			url:"../core/save.php",			//Arquivo php
			type:"post",				//Método de envio
			data: {tipo:tipo, titulo:titulo, nome:nome, data_nasc:data_nasc, endereco:endereco, bairro:bairro, sexo:sexo, nome_mae:nome_mae, datahj:datahj, idCad:idCad, sub_coordenador:sub_coordenador},	//Dados
   			success: function (result){			//Sucesso no AJAX
   				if(result==1){	
                			alert("Cadastrado com Sucesso!")	//Redireciona
                			$("#cName").val('');
                			$("#cNasc").val('');
                			$("#cEndereco").val('');
                			$("#cBairro").val('');
                			$("#cSexo").val('');
                			$("#cMae").val('');
                		}else{
                			alert("Erro ao salvar");		//Informa o erro
                		}
                	}
                });
		return false;//Evita que a página seja atualizada
	});
	});
</script>