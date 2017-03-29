<?php
include_once '../usr/vrf_lgin.php';
include_once '../core/pdf.php';
include_once '../core/exp.php';

$op = $_GET['op'];
$exp = new exp();
$pdf = new pdf();
switch ($op) {
	case 'e1':
		if ($_SESSION['nivel']==3) {
			$query = 'SELECT * FROM usuarios';
		}
		elseif ($_SESSION['nivel']==1) {
			$query = 'SELECT * FROM usuarios WHERE responsavel_cadastro = '.$_SESSION['usuarioID'].'';
		}
		$exp->excelGeral($query);
		break;
	case 'e2':
		if ($_SESSION['nivel']==3) {
			$query = 'SELECT * FROM usuarios';
		}
		elseif ($_SESSION['nivel']==1) {
			$query = 'SELECT * FROM usuarios WHERE responsavel_cadastro = '.$_SESSION['usuarioID'].'';
		}
		$pdf->relatorioGeral($query);
		break;
	case 'c1':
		if ($_SESSION['nivel']==3) {
			$query = 'SELECT * FROM usuarios WHERE 1=1';
		}
		elseif ($_SESSION['nivel']==1) {
			$query = 'SELECT * FROM usuarios WHERE responsavel_cadastro = '.$_SESSION['usuarioID'].'';
		}
		$cd = $_GET['ap'];
		if ($cd=='null') {
			$exp->excelCord($query);
		} else {
			$exp->excelCord($query,$cd);
		}
		break;
	case 'c2':
		if ($_SESSION['nivel']==3) {
			$query = 'SELECT * FROM usuarios WHERE 1=1';
		}
		elseif ($_SESSION['nivel']==1) {
			$query = 'SELECT * FROM usuarios WHERE responsavel_cadastro = '.$_SESSION['usuarioID'].'';
		}
		$cd = $_GET['ap'];
		if ($cd=='null') {
			$pdf->relatorioSubc($query);
		} else {
			$pdf->relatorioSubc($query,$cd);
		}
		break;
	case 's1':
		if ($_SESSION['nivel']==3) {
			$query = 'SELECT * FROM sub_coord WHERE 1=1';
		}
		elseif ($_SESSION['nivel']==1) {
			$query = 'SELECT * FROM sub_coord WHERE coord = '.$_SESSION['usuarioID'].'';
		}
		$cd = $_GET['ap'];
		if ($cd=='null') {
			$exp->excelSucCord($query);
		} else {
			$exp->excelSucCord($query,$cd);
		}
		break;
	case 's2':
		if ($_SESSION['nivel']==3) {
			$query = 'SELECT * FROM sub_coord WHERE 1=1';
		}
		elseif ($_SESSION['nivel']==1) {
			$query = 'SELECT * FROM sub_coord WHERE coord = '.$_SESSION['usuarioID'].'';
		}
		$cd = $_GET['ap'];
		if ($cd=='null') {
			$pdf->relatorioG($query);
		} else {
			$pdf->relatorioG($query,$cd);
		}
		break;
	case 'value':
		# code...
		break;
	
	default:
		# code...
		break;
}

?>