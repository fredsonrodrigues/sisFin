<?php
require_once("fpdf/fpdf.php");
include_once '../usr/vrf_lgin.php';
include 'crud.php';
/**
* 
*/
class pdf extends FPDF
{
	
	function relatorioGeral($query)
	{
		$data = date('Y-m-d');
		$data = date('d/m/Y', strtotime($data));
		$pdf= new FPDF("P","pt","A4");
		$crud = new crud();
		$pdf->AddPage("L");
		//$pdf->Image('logog8.jpg');	 
		$pdf->SetFont('arial','B',18);
		$pdf->Cell(0,5,"","B",1,'C');
		$pdf->Cell(0,5,utf8_decode("Relatório"),0,1,'C');
		$pdf->Ln(8);
		//nome
		$pdf->SetFont('arial','B',12);
		$pdf->Cell(260,5,utf8_decode("Nome responsável = ".$_SESSION['nomeUsuario']),0,0,'L');
		$pdf->Cell(280,5,utf8_decode("Data = ".$data),0,0,'R');
		$pdf->Ln(8);
		$pdf->Cell(0,5,"","B",1,'C');
		$pdf->Ln(8);
		$pdf->SetFont('arial','B',8);
		$pdf->SetFillColor(255,255,153);
		$pdf->Cell(300,20,'NOME',1,0,'L',true);
		$pdf->SetFont('arial','',8);
		$pdf->Cell(120,20,utf8_decode("Telefone: "),1,0,'L',true);
		$pdf->Cell(120,20,utf8_decode("Celular: "),1,0,'L',true);
		$pdf->Cell(250,20,utf8_decode("Nome da Mãe: "),1,0,'L',true);
		$pdf->Ln(20);

					$table = $crud->dataview($query);
					if($table->rowCount()>0)
					{
						while($row=$table->fetch(PDO::FETCH_ASSOC))
						{
							$pdf->SetFont('arial','B',8);
							$pdf->Cell(300,16,utf8_decode($row['nome_completo']),1,0,'L');
							$pdf->SetFont('arial','',8);
							$pdf->Cell(120,16,utf8_decode("222-2222"),1,0,'L');
							$pdf->Cell(120,16,utf8_decode("9888-8888"),1,0,'L');
							$pdf->Cell(250,16,utf8_decode($row['nome_mae']),1,0,'L');
							$pdf->Ln(16);
							//$rowcount++;
						}
					}

		 
		$pdf->Output();
	}

	function relatorioG($query,$id=0)
	{
		$data = date('Y-m-d');
		$data = date('d/m/Y', strtotime($data));
		$pdf= new FPDF("P","pt","A4");
		$crud = new crud();
		$pdf->AddPage("L");
		//$pdf->Image('logog8.jpg');	 
		$pdf->SetFont('arial','B',18);
		$pdf->Cell(0,5,"","B",1,'C');
		$pdf->Cell(0,25,utf8_decode("Relatório"),0,1,'C');
		$pdf->Ln(8);
		//nome
		$pdf->SetFont('arial','B',10);
		$pdf->Cell(260,5,utf8_decode("Nome responsável = ".$_SESSION['nomeUsuario']),0,0,'L');
		$pdf->Cell(280,5,utf8_decode("Data = ".$data),0,0,'R');
		$pdf->Ln(8);
		$pdf->Cell(0,5,"","B",1,'C');
		$pdf->Ln(8);

					if ($id==0) {
						$table = $crud->dataview('SELECT * FROM sub_coord WHERE coord = 0');
					} else {
						$table = $crud->dataview('SELECT * FROM sub_coord WHERE coord = 0 AND id ='.$id);
					}
					$r=$table->fetchAll(PDO::FETCH_ASSOC);
					if($table->rowCount()>0)
					{
						foreach ($r as $rw)
						{
							$pdf->SetFont('arial','B',8);
							$pdf->SetFillColor(255,255,153);
							$pdf->Cell(300,20,'NOME',1,0,'L',true);
							$pdf->SetFont('arial','B',8);
							$pdf->Cell(120,20,utf8_decode("Telefone: "),1,0,'L',true);
							$pdf->Cell(120,20,utf8_decode("Celular: "),1,0,'L',true);
							$pdf->Cell(245,20,utf8_decode("Endereço: "),1,0,'L',true);
							$pdf->Ln(20);
							$pdf->SetFillColor(204,255,204);
								$pdf->Cell(300,16,utf8_decode($rw['nome']." (COORDENADOR)"),1,0,'L',true);
								$pdf->Cell(120,16,utf8_decode("222-2222"),1,0,'L',true);
								$pdf->Cell(120,16,utf8_decode("9888-8888"),1,0,'L',true);
								$pdf->Cell(245,16,utf8_decode($rw['endereco']),1,0,'L',true);
							$pdf->Ln(16);
							$cc = $query.' AND coord = '.$rw['id'];
							$tbl = crud::dataview($cc);
							while($row=$tbl->fetch(PDO::FETCH_ASSOC))
							{
								$pdf->SetFont('arial','',8);
								$pdf->Cell(300,16,utf8_decode($row['nome']),1,0,'L');
								$pdf->Cell(120,16,utf8_decode("222-2222"),1,0,'L');
								$pdf->Cell(120,16,utf8_decode("9888-8888"),1,0,'L');
								$pdf->Cell(245,16,utf8_decode($row['endereco']),1,0,'L');
								$pdf->Ln(16);
								//$rowcount++;
							}
						}
					}

		 
		$pdf->Output();
		//$pdf->Output("D","Relatorio_".$_SESSION['nomeUsuario'].".pdf");
	}

	function relatorioSubc($query,$id=0)
	{
		$data = date('Y-m-d');
		$data = date('d/m/Y', strtotime($data));
		$pdf= new FPDF("P","pt","A4");
		$crud = new crud();
		$pdf->AddPage("L");
		//$pdf->Image('logog8.jpg');	 
		$pdf->SetFont('arial','B',18);
		$pdf->Cell(0,5,"","B",1,'C');
		$pdf->Cell(0,25,utf8_decode("Relatório"),0,1,'C');
		$pdf->Ln(8);
		//nome
		$pdf->SetFont('arial','B',10);
		$pdf->Cell(260,5,utf8_decode("Nome responsável = ".$_SESSION['nomeUsuario']),0,0,'L');
		$pdf->Cell(280,5,utf8_decode("Data = ".$data),0,0,'R');
		$pdf->Ln(8);
		$pdf->Cell(0,5,"","B",1,'C');
		$pdf->Ln(8);

					if ($id==0) {
						$table = $crud->dataview('SELECT * FROM sub_coord WHERE coord <> 0');
					} else {
						$table = $crud->dataview('SELECT * FROM sub_coord WHERE coord <> 0 AND id ='.$id);
					}
					$r=$table->fetchAll(PDO::FETCH_ASSOC);
					if($table->rowCount()>0)
					{
						foreach ($r as $rw)
						{
							$pdf->SetFont('arial','B',8);
							$pdf->SetFillColor(255,255,153);
							$pdf->Cell(300,20,'NOME',1,0,'L',true);
							$pdf->SetFont('arial','B',8);
							$pdf->Cell(120,20,utf8_decode("Telefone: "),1,0,'L',true);
							$pdf->Cell(120,20,utf8_decode("Celular: "),1,0,'L',true);
							$pdf->Cell(245,20,utf8_decode("Endereço: "),1,0,'L',true);
							$pdf->Ln(20);
							$pdf->SetFillColor(204,255,204);
								$pdf->Cell(300,16,utf8_decode($rw['nome']." (SUBCOORDENADOR)"),1,0,'L',true);
								$pdf->Cell(120,16,utf8_decode("222-2222"),1,0,'L',true);
								$pdf->Cell(120,16,utf8_decode("9888-8888"),1,0,'L',true);
								$pdf->Cell(245,16,utf8_decode($rw['endereco']),1,0,'L',true);
							$pdf->Ln(16);
							$cc = $query.' AND responsavel_cadastro = '.$rw['id'];
							$tbl = $crud->dataview($cc);
							while($row=$tbl->fetch(PDO::FETCH_ASSOC))
							{
								$pdf->SetFont('arial','',8);
								$pdf->Cell(300,16,utf8_decode($row['nome_completo']),1,0,'L');
								$pdf->Cell(120,16,utf8_decode("222-2222"),1,0,'L');
								$pdf->Cell(120,16,utf8_decode("9888-8888"),1,0,'L');
								$pdf->Cell(245,16,utf8_decode($row['endereco']),1,0,'L');
								$pdf->Ln(16);
								//$rowcount++;
							}
						}
					}

		 
		$pdf->Output();
		//$pdf->Output("D","Relatorio_".$_SESSION['nomeUsuario'].".pdf");
	}
}

?>