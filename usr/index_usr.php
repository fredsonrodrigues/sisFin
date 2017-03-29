<?php
include 'cabc_usr.php';
include_once '../core/crud.php';
include_once 'vrf_lgin.php';
//$query = 'SELECT * FROM usuarios';
$crud = new crud();
switch ($_SESSION['nivel']) {
	case 3:
		$query = 'SELECT * FROM usuarios';
		break;
	case 1:
		$query = 'SELECT * FROM usuarios WHERE responsavel_cadastro = '.$_SESSION['usuarioID'].'';
		break;
}
?>

<div class="well">
	<h1 id="welcome">Bem vindo, <small> <?php echo $_SESSION['nomeUsuario']?></small></h1> 
</div>
<div class="col-md-12" id="conteudo">
	<br>
	<div class="row" id="cadop">
		<?php
		if ($_SESSION['nivel']==1) {
			echo "<div class='col-sm-6 col-md-12'>
			<a class='thumbnail' id='people'>
				<img src='../img/pessoas.png' alt='...''>
				<div class='caption'>
					<h3>Cadastrar Pessoas</h3>
				</div>
			</a>
		</div>";
		}elseif($_SESSION['nivel']==3){
			echo "<div class='col-sm-6 col-md-3'>
			<a class='thumbnail' id='people'>
				<img src='../img/pessoas.png' alt='...''>
				<div class='caption'>
					<h3>Cadastrar Pessoas</h3>
				</div>
			</a>
		</div>
		<div class='col-sm-6 col-md-3' id='typists'>
			<a class='thumbnail'>
				<img src='../img/digitador.png' alt='...'>
				<div class='caption'>
					<h3>Cadastrar Digitadores</h3>
				</div>
			</a>
		</div>
		<div class='col-sm-6 col-md-3' id='managers'>
			<a class='thumbnail'>
				<img src='../img/subcoord.png' alt='...''>
				<div class='caption'>
					<h3>Cadastrar Sub-Coordenadores</h3>
				</div>
			</a>
		</div>
		<div class='col-sm-6 col-md-3' id='Cmanagers'>
			<a class='thumbnail'>
				<img src='../img/subcoord.png' alt='...''>
				<div class='caption'>
					<h3>Cadastrar Coordenadores</h3>
				</div>
			</a>
		</div>";
		}
		?>
	</div>
	<div class="tbl">
	<div class="table-responsive">
		<table id="tabela1" class="table table-responsive" style="border:1px;">
			<thead>
				<tr>
					<th>Nome:</th>
					<th>Sexo:</th>
					<th>Nascimento:</th>
					<th>Endereco:</th>
					<th>Bairro:</th>
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
						<td><?php print($row['nome_completo']); ?></td>
						<td><?php print($row['sexo']); ?></td>
						<td><?php print date('d/m/Y',  strtotime($row['data_nasc']));?></td>
						<td><?php print($row['endereco']); ?></td>
						<td><?php print($row['bairro']); ?></td>
						<td><?php print date('d/m/Y',  strtotime($row['data_cadastro']));?></td>
						<td>
							<button type="button" class="btn btn-info edit" id="<?php print($row['id']);?>" titulo="<?php print($row['titulo_eleitor']);?>" name="<?php print($row['nome_completo']);?>" sexo="<?php print($row['sexo']);?>" idade="<?php print(date('d/m/Y',  strtotime($row['data_nasc'])));?>" endereco="<?php print($row['endereco']);?>" bairro="<?php print($row['bairro']);?>" dataCadastro="<?php print($row['data_cadastro']);?>" mae="<?php print($row['nome_mae']);?>">Alterar</button>
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
</div>
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Editar</h4>
			</div>
			<div class="modal-body" id="modal">
				<form id="edt">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<input type="text" hidden id="tipo" value="editacad">
								<input type="text" hidden id="cId" value="">
								<label for="InputName">Nome</label>
								<div class="input-group">
									<input type="text" class="form-control" name="edittName" id="cName" placeholder="Nome" required value="">
									<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="InputEndereco">Endereco</label>
								<div class="input-group">
									<input type="text" class="form-control" id="cEndereco" name="cEndereco" placeholder="Endereco" required value="">
									<span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
								</div>
							</div>
							<div class="form-inline">
								<div class="form-group">
									<label for="InputIdade">Bairro</label>
									<div class="input-group">
										<input type="nome" class="form-control" id="cBairro" name="cBairro" placeholder="Bairro" required value="">
										<span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
									</div>
								</div>
								<div class="form-group">
									<label for="InputIdade">Nascimento</label>
									<div class="input-group">
										<input type="nome" class="form-control" id="cNasc" name="cIdade" placeholder="Nascimento" required value="">
										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								</div>
								<div class="form-group">
									<label for="InputSexo">Sexo</label>
									<div class="input-group">
										<select class="form-control" name="cSexo" id="cSexo">
											<option value="M" '.$m.'>Masculino</option>
											<option value="F" '.$f.'>Feminino</option>
										</select>
									</br><span class="input-group-addon"><span class="glyphicon glyphicon-exclamation-sign"></span></span>
								</div>
							</div><br><br>
						</div><br>
						<div class="form-group">
						<label for="InputZona">Título </label>
							<div class="input-group">
								<input type="nome" class="form-control" id="cTitulo" name="cTitulo" placeholder="Título" required value="">
								<span class="input-group-addon"><span class="glyphicon glyphicon-edit"></span></span>
							</div>
						</div>
						<div class="form-group">
						<label for="InputZona">Nome da mãe </label>
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
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		$('#tabela1').DataTable();

		$('#cadop').hide();
		$("#agenda").click(function(){
			event.preventDefault();
			$('.tbl').hide();
			$('#cadop').show();
		});
		$("#people").click(function(){
			event.preventDefault();
			$("#conteudo").load("ag_aul.php");
		});
		$("#typists").click(function(){
			event.preventDefault();
			$("#conteudo").load("cr_usr.php");
		});
		$("#managers").click(function(){
			event.preventDefault();
			$("#conteudo").load("cr_sbcr.php");
		});
		$("#Cmanagers").click(function(){
			event.preventDefault();
			$("#conteudo").load("cr_crd.php");
		});
		$("#edita").click(function(){
			event.preventDefault();
			$("#agenda").hide();
			$("#conteudo").load("edt_usr.php");
		});
		$("#contato").click(function(){
			event.preventDefault();
			$("#agenda").hide();
			$("#conteudo").load("rel.php");
		});
	});
</script>