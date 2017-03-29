<?php
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d');
$query = 'SELECT * FROM sub_coord WHERE coord <> 0';
include_once 'vrf_lgin.php';
include_once '../core/crud.php';
$crud = new crud();
$id = $_SESSION['usuarioID'];
?>
<div class="container">
<button type="button" class="btn btn-warning" aria-label="Left Align" id="volta">
  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Voltar
</button></br></br>
<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#collapse1">Cadastrar Novo Subcoordenador</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse">
      <div class="panel-body">
      		<h1>Cadastra Sub-Coordenador</h1><h4>Insira os dados do novo Subcoordenador</h4>
	<form id="cdt">
		<div class="row">
			<div class="col-lg-12">
				<br>
				<div class="form-group">
				<input type="text" hidden id="tipo" value="criaScr">
					<div class="input-group">
						<input type="text" class="form-control" name="edittName" id="scName" placeholder="Nome completo" required value="">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" id="scCPF" name="scCPF" placeholder="CPF" required value="">
						<span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" id="scRg" name="scRg" placeholder="RG" required value="">
						<span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" id="scTit" name="scTit" placeholder="Título de eleitor" required value="">
						<span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
					</div>
				</div>
					<div class="form-group">
						<div class="input-group">
							<select class="form-control" name="scSexo" id="scSexo">
								<option value="null" disabled>Sexo</option>
								<option value="M">Masculino</option>
								<option value="F">Feminino</option>
							</select>
						</br><span class="input-group-addon"><span class="glyphicon glyphicon-exclamation-sign"></span></span>
					</div></br>
					<div class="form-group">
						<div class="input-group">
							<select class="form-control" name="cCrd" id="cCrd">
								<option value="null" disabled selected>Coordenador</option>
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
					</div><br>
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" id="scEnd" name="scEnd" placeholder="Endereço" required value="">
						<span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" id="scBair" name="scBair" placeholder="Bairro" required value="">
						<span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
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
  </div>
</div>
</div>
</div>
</div>
<div class="tbl">
	<div class="table-responsive">
		<table id="tabela1" class="table table-responsive" style="border:1px;">
			<thead>
				<tr>
					<th>Nome:</th>
					<th>Sexo:</th>
					<th>Endereco:</th>
					<th>Bairro:</th>
					<th>Endereço Seção:</th>
					<th>Bairro Seção:</th>
					<th>Data Cadastro</th>
					<th>Ações:</th>
				</tr>
			</thead>
			<?php
			$table = $crud->dataview($query);
			if($table->rowCount()>0)
			{
				while($row=$table->fetch(PDO::FETCH_ASSOC))
				{
					?>
					<tr>
						<td><?php print($row['nome']); ?></td>
						<td><?php print($row['sexo']); ?></td>
						<td><?php print($row['endereco']); ?></td>
						<td><?php print($row['bairro']); ?></td>
						<td><?php print($row['cpf']); ?></td>
						<td><?php print($row['rg']); ?></td>
						<td></td>
						<td>
							<button type="button" class="btn btn-info edit" id="<?php print($row['id']);?>" cpf="<?php print($row['cpf']);?>" name="<?php print($row['nome']);?>" sexo="<?php print($row['sexo']);?>" endereco="<?php print($row['endereco']);?>" bairro="<?php print($row['bairro']);?>" rg="<?php print($row['rg']);?>">Alterar</button>
							<button type="button" class="btn btn-danger delete" id="<?php print($row['id']); ?>">Excluir</button>
						</td>
					</tr>
					<?php
				}
				?>
				</table><?php
			}
			else
			{
				?>
				</table>
				<?php
			}
			?>
	</div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#volta').click(function(){
			location.reload();
		});
		$('#scSexo').val('null');
		$('#cdt').submit(function(){
			var tipo = $("#tipo").val();
			var nome = $("#scName").val();
			var cpf = $("#scCPF").val();
			var rg = $("#scRg").val();
			var sexo = $("#scSexo").val();
			var titulo_eleitor = $("#scTit").val();
			var endereco = $("#scEnd").val();
			var bairro = $("#scBair").val();
			var crd = $('#cCrd').val();
		$.ajax({ //Função AJAX
			url:"../core/save.php",			//Arquivo php
			type:"post",				//Método de envio
			data: {tipo:tipo, nome:nome, cpf:cpf, rg:rg, sexo:sexo, titulo_eleitor:titulo_eleitor, endereco:endereco, bairro:bairro,crd:crd},	//Dados
   			success: function (result){			//Sucesso no AJAX
   				alert(result)
   				if(result==1){	
                			alert("Cadastrado com Sucesso!")	//Redireciona
                			$("#scName").val('');
                			$("#scCPF").val('');
                			$("#scRg").val('');
                			$("#scSexo").val('null');
                			$("#scTit").val('');
                			$("#scEnd").val('');
                			$("#scBair").val('');
                		}else{
                			alert("Erro ao salvar");		//Informa o erro
                		}
                	}
                });
	
		return false;//Evita que a página seja atualizada
	});
	});
</script>