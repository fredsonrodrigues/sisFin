<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>I-SIS</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

	<!-- CSS Files -->
	<link href="css/bootstrapmt.min.css" rel="stylesheet" />
	<link href="css/material-kit.css" rel="stylesheet"/>

</head>

<body class="signup-page">
	<nav class="navbar navbar-transparent navbar-absolute">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php"><strong>I-SIS </strong>- sistema de cadastro</a>
			</div>

			<div class="collapse navbar-collapse" id="navigation-example">
				<ul class="nav navbar-nav navbar-right">
					
					<li>
						<a href="" target="_blank" class="btn btn-simple">
							<i class="fa fa-twitter"></i>
						</a>
					</li>
					<li>
						<a href="" target="_blank" class="btn btn-simple">
							<i class="fa fa-facebook-square"></i>
						</a>
					</li>
					<li>
						<a href="" target="_blank" class="btn btn-simple">
							<i class="fa fa-instagram"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="wrapper">
		<div class="header header-filter" style="background-image: url('img/people.jpg'); background-size: cover; background-position: top center;">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
						<div class="card card-signup" style="margin: 200px 0 40px;">
							<form class="form" method="" action="" id="login">
								<div class="header header-info text-center" style="margin-left: 0px;margin-right: 0px;margin-top: 0px;">
									<h4>Login</h4>
								</div>
								<p class="text-divider">Acesse sua conta</p>
								<div class="content">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">face</i>
										</span>
										<input type="text" class="form-control" placeholder="Nome" id="user">
									</div>

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">lock_outline</i>
										</span>
										<input type="password" placeholder="Senha" class="form-control" id="senha" />
									</div>
									<div class="alert alert-danger" id="errolog">Usuario ou senha incorreto</div>
								</div>
								<div class="footer text-center">
									<button type="submit" class="btn btn-success btn-wd btn-lg">Entrar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<footer class="footer">
				<div class="container">
					<div class="copyright pull-right">
						Desenvolvido com Bootstrap-material by <a href="http://www.creative-tim.com" target="_blank">Aliança Tecnologia - 2016</a>
					</div>
				</div>
			</footer>

		</div>

	</div>


</body>
<!--   Core JS Files   -->
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/bootstrapmt.min.js" type="text/javascript"></script>
<script src="js/material.min.js"></script>



<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
<script src="js/material-kit.js" type="text/javascript"></script>

<script type="text/javascript">
	$().ready(function(){
			// the body of this function is in assets/material-kit.js
			$(window).on('scroll', materialKit.checkScrollForTransparentNavbar);
		});
	$(document).ready(function(){
		$('#errolog').hide(); //Esconde o elemento com id errolog
		$('#login').submit(function(){ 	//Ao submeter formulário
		var user=$('#user').val();	//Pega valor do campo email
		var senha=$('#senha').val();	//Pega valor do campo senha
		$.ajax({			//Função AJAX
			url:"login.php",			//Arquivo php
			type:"post",				//Método de envio
			data: "user="+user+"&senha="+senha,	//Dados
   			success: function (result){			//Sucesso no AJAX
   					alert(result)					
   				if(result==1){	
   					$("#errolog").fadeOut();	
                			location.href='usr/index_usr.php'	//Redireciona
                		}else{
                			$('#errolog').fadeIn();		//Informa o erro
                			//alert(result)
                		}
                		$('#myModal').on('hidden.bs.modal', function () {
                			$('#user').val('');
                			$('#senha').val('');
                			$("#errolog").fadeOut();
                		})
                	}
                })
		return false;	//Evita que a página seja atualizada
	})
	})
</script>




</html>