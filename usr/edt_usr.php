<?php
include_once 'vrf_lgin.php';
include_once '../core/crud.php';
$id = $_SESSION['usuarioID'];
$crud = new crud();
$edit = $crud->getID($id);

?>
<div class="container">
<button type="button" class="btn btn-warning" aria-label="Left Align" id="volta">
  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Voltar
</button>
	<div class="row">
			<div class="col-lg-9">
				<h1>Cadastrar Pessoa</h1>
		<form id="edit">
			<div class="row" id="here"></div>
				<div class="form-group">
					<input type="text" hidden id="tipo" value="editausr">
					<label for="InputName">Por qual Nome deseja ser chamado?</label>
					<div class="input-group">
						<input type="text" class="form-control" name="editName" id="editName" placeholder="nome" required value="<?php echo $edit['usuario'];?>">
						<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
					</div>
				</div>
				<button type="submit" class="btn btn-success btn-lg btn-block" id="submit">Atualizar</button>
			</div>
		</form>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
		$('#volta').click(function(){
			location.reload()
		})
		$('#edit').submit(function(){ //Ao submeter formulário
			var id = <?php echo $id;?>;
			var nome=$('#editName').val();
			var tipo=$('#tipo').val();
		$.ajax({ //Função AJAX
			url:"../core/save.php",			//Arquivo php
			type:"post",				//Método de envio
			data: {id:id, tipo:tipo, nome:nome},	//Dados
   			success: function (result){			//Sucesso no AJAX
   				if(result==1){	
   					//alert(result)					
   					$("#errow").fadeOut();
                			$('#here').html('<div class="alert alert-success" role="alert"><strong>Certo! </strong>Seu nome será atualizado no próximo login!</div>');	//Redireciona
                		}else{
                			$('#here').html('<div class="alert alert-error" role="alert"><strong>Ops! </strong>Operação mal sucedida!</div>');		//Informa o erro
                		}
                	}
                });
		return false;//Evita que a página seja atualizada
	})
	})
</script>
</div>