//Essa função direciona o campo de edição para o modal existente na página.
$('.edit').click(function(){
	var id = $(this).attr('id');
	var nome = $(this).attr('name');
	var sexo = $(this).attr('sexo');
	var idade = $(this).attr('idade');
	var endereco = $(this).attr('endereco');
	var bairro = $(this).attr('bairro');
	var titulo = $(this).attr('titulo');
	var mae = $(this).attr('mae');
//$('#modal').html(id);
$('#cId').val(id);
$('#cName').val(nome);
$('#cSexo').val(sexo);
$('#cNasc').val(idade);
$('#cEndereco').val(endereco);
$('#cBairro').val(bairro);
$('#cTitulo').val(titulo);
$('#cMae').val(mae);;
//$('.2').html('<input type="hidden" name="id" value="'+id+'">');
//document.getElementById('sv').name ='atualizar';
//document.getElementById('sv').value ='Editar';
$('#myModal').modal('show');

})
//Requisição para editar cadastro da pessoa
$('#edt').submit(function(){
	var tipo =$("#tipo").val();
	var id =$("#cId").val();
	var nome = $("#cName").val();
	var endereco = $("#cEndereco").val();
	var idd = $("#cNasc").val();
	var sexo = $("#cSexo").val();
	var nome_mae = $("#cMae").val();
	var titulo = $("#cTitulo").val();
	var bairro = $('#cBairro').val();
	i = idd.split("/")
	idade = i[2]+"-"+i[1]+"-"+i[0];
	//alert(idade)
		$.ajax({ //Função AJAX
			url:"../core/save.php",		//Arquivo php
			type:"post",				//Método de envio
			data: {tipo:tipo, id:id, nome:nome, endereco:endereco, idade:idade, bairro:bairro, sexo:sexo, nome_mae:nome_mae, titulo:titulo},	//Dados
   			success: function (result){	//Sucesso no AJAX
   				//alert(result)
   				if(result==1){	
                			alert("Alterado com Sucesso!");	//Redireciona
                			$('#myModal').modal('hide');
                			location.reload();
                		}else{
                			alert("Erro ao salvar");
                			$('#myModal').modal('hide');	//Informa o erro
                		}
                	}
                });
		return false;//Evita que a página seja atualizada
	});
//Requisição para excluir cadastro da pessoa.
$('.delete').click(function(){
	var tipo ='deletacad';
	var id = $(this).attr('id');
	var r = confirm("Deseja excluir?");
	if (r == true) {
		$.ajax({ //Função AJAX
			url:"../core/save.php",		//Arquivo php
			type:"post",				//Método de envio
			data: {tipo:tipo, id:id},	//Dados
   			success: function (result){	//Sucesso no AJAX
   				if(result==1){	
                			alert("excluido com Sucesso!");	//Redireciona
                			$('#myModal').modal('hide');
                			location.reload();
                		}else{
                			alert("Erro ao excluir");
                			$('#myModal').modal('hide');	//Informa o erro
                		}
                	}
                });
	} else {
		location.reload();
	}
		return false;//Evita que a página seja atualizada
	});