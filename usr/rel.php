<?php
include_once '../core/crud.php';
$q = 'SELECT * FROM sub_coord WHERE coord=0';
$c = 'SELECT * FROM sub_coord WHERE coord<>0';
$crud = new crud();
?>
<body>
	<div class="col-md-4">
	<div class="panel panel-default">
  		<div class="panel-body">
    	<h3 class="text-center">Relatório Geral</h3>
  		</div>
  		<div class="panel-footer">
		<h4 class="text-center">Exportar para:</h4>
		<div class="text-center">
			</br><a href="expr.php?op=e1"><button class="btn btn-success">Excel</button></a>
			<a href="expr.php?op=e2"><button class="btn btn-danger">PDF</button></a>
		</div>
  		</div>
	</div>
	</div>
	<div class="col-md-4">
	<div class="panel panel-default">
  		<div class="panel-body">
    	<h3 class="text-center">Relatório De Coordenadores</h3>
  		</div>
  		<div class="panel-footer">
		<h4 class="text-center">
			<select class="form-control" id="chk">
			<option value="null" selected>Todos</option>
			<?php
			$x = $crud->dataview($q);
			$x=$x->fetchAll(PDO::FETCH_ASSOC);
			foreach ($x as $key){
				echo "<option value=".$key['id'].">".$key['nome']."</option>";
			}
			?>
			</select>
		</h4>
		<div class="text-center">
			<a href="" id="s1e"><button class="btn btn-success">Excel</button></a>
			<a href="" id="s2e"><button class="btn btn-danger">PDF</button></a>
		</div>
  		</div>
	</div>
	</div>
	<div class="col-md-4">
	<div class="panel panel-default">
  		<div class="panel-body">
    	<h3 class="text-center">Relatório De Subcoordenadores</h3>
  		</div>
  		<div class="panel-footer">
		<h4 class="text-center">
			<select class="form-control" id="2chk">
			<option value="null" selected>Todos</option>
			<?php
			$w = $crud->dataview($c);
			$w=$w->fetchAll(PDO::FETCH_ASSOC);
			foreach ($w as $key){
				echo "<option value=".$key['id'].">".$key['nome']."</option>";
			}
			?>
			</select>
		</h4>
		<div class="text-center">
			<a href="" id="c1e"><button class="btn btn-success">Excel</button></a>
			<a href="" id="c2e"><button class="btn btn-danger">PDF</button></a>
		</div>
  		</div>
	</div>
	</div>
</body>
<script type="text/javascript">
	$('#s2e').click(function(){
		var c = $('#chk').val()
		if (c!=null) {
		alert(c)
		$('#s2e').attr("href", "expr.php?op=s2&ap="+c);
		} else {
		$('#s2e').attr("href", "expr.php?op=s2ap=null");
		}
	})
	$('#s1e').click(function(){
		var c = $('#chk').val()
		if (c!=null) {
		alert(c)
		$('#s1e').attr("href", "expr.php?op=s1&ap="+c);
		} else {
		$('#s1e').attr("href", "expr.php?op=s1");
		}
	})
	$('#c2e').click(function(){
		var c = $('#2chk').val()
		if (c!=null) {
		alert(c)
		$('#c2e').attr("href", "expr.php?op=c2&ap="+c);
		} else {
		$('#c2e').attr("href", "expr.php?op=c2ap=null");
		}
	})
	$('#c1e').click(function(){
		var c = $('#2chk').val()
		if (c!=null) {
		alert(c)
		$('#c1e').attr("href", "expr.php?op=c1&ap="+c);
		} else {
		$('#c1e').attr("href", "expr.php?op=c1=null");
		}
	})
</script>