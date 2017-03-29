<?php
include_once '../usr/vrf_lgin.php';
// Incluimos a classe PHPExcel
include_once  'PHPExcel/Classes/PHPExcel.php';
include_once 'crud.php';
/**
* 
*/
class exp extends PHPExcel
{
	
	public function excelGeral($query)
	{
		$data = date('Y-m-d');
		$data = date('d/m/Y', strtotime($data));
		// Instanciamos a classe
		$objPHPExcel = new PHPExcel();

		// Definimos o estilo da fonte
		$objPHPExcel->getActiveSheet()->getStyle('3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A3:J3')->applyFromArray(
		    array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => '#7CFC00')
		        )
		    )
		);
		$objPHPExcel->setActiveSheetIndex()->mergeCells('A1:J1');
		$objPHPExcel->setActiveSheetIndex()->mergeCells('A2:C2');
		$objPHPExcel->setActiveSheetIndex()->mergeCells('D2:E2');
		// Criamos as colunas
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A1", "Relatório Sistema I-SIS" )
		            ->setCellValue('A2', 'Responsável pelo cadastro: '.$_SESSION['nomeUsuario'])
		            ->setCellValue("D2", "Data: ".$data )
		            ->setCellValue('A3', 'Nome Completo')
		            ->setCellValue('B3', "Sexo")
		            ->setCellValue("C3", "Nascimento")
		            ->setCellValue("D3", "Endereco")
		            ->setCellValue("E3", "Bairro")
		            ->setCellValue("F3", "Data de Cadastro");

		// Podemos configurar diferentes larguras paras as colunas como padrão
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);

					$rowcount = 4;
					$table = crud::dataview($query);
					if($table->rowCount()>0)
					{
						while($row=$table->fetch(PDO::FETCH_ASSOC))
						{
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $rowcount, $row['nome_completo']);
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $rowcount, $row['sexo']);
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $rowcount, date('d/m/Y', strtotime($row['data_nasc'])));
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $rowcount, $row['endereco']);
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $rowcount, $row['bairro']);
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $rowcount, date('d/m/Y', strtotime($row['data_cadastro'])));
							$rowcount++;
						}
					}
		// Também podemos escolher a posição exata aonde o dado será inserido (coluna, linha, dado);

		// Exemplo inserindo uma segunda linha, note a diferença no segundo parâmetro

		// Podemos renomear o nome das planilha atual, lembrando que um único arquivo pode ter várias planilhas
		$objPHPExcel->getActiveSheet()->setTitle('Credenciamento para o Evento');

		// Cabeçalho do arquivo para ele baixar
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="RELATORIO_I-SIS.xls"');
		header('Cache-Control: max-age=0');
		// Se for o IE9, isso talvez seja necessário
		header('Cache-Control: max-age=1');

		// Acessamos o 'Writer' para poder salvar o arquivo
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

		// Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
		$objWriter->save('php://output'); 

		exit;
	}

	public function excelSucCord($query,$id=0)
	{
		$data = date('Y-m-d');
		$data = date('d/m/Y', strtotime($data));
		// Instanciamos a classe
		$objPHPExcel = new PHPExcel();
		$crud = new crud();

		// Definimos o estilo da fonte
		$objPHPExcel->getActiveSheet()->getStyle('3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray(
		    array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'F28A8C')
		        )
		    )
		);
		$objPHPExcel->setActiveSheetIndex()->mergeCells('A1:G1');
		$objPHPExcel->setActiveSheetIndex()->mergeCells('A2:C2');
		$objPHPExcel->setActiveSheetIndex()->mergeCells('D2:E2');
		// Criamos as colunas
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A1", "Relatório Sistema I-SIS" )
		          ->setCellValue('A2', 'Responsável pelo cadastro: '.$_SESSION['nomeUsuario'])
		          ->setCellValue("D2", "Data: ".$data )
		          ->setCellValue('A3', 'Nome Completo')
		          ->setCellValue('B3', "Sexo")
		          ->setCellValue("C3", "Titulo de eleitor")
		          ->setCellValue("D3", "CPF")
		          ->setCellValue("E3", "RG")
		          ->setCellValue("F3", "Endereço")
		          ->setCellValue("G3", "Bairro");

		// Podemos configurar diferentes larguras paras as colunas como padrão
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);

					$rowcount = 4;
					if ($id==0) {
						$table = $crud->dataview('SELECT * FROM sub_coord WHERE coord = 0');
					} else {
						$table = $crud->dataview('SELECT * FROM sub_coord WHERE coord = 0 AND id ='.$id);
					}
					$r=$table->fetchAll(PDO::FETCH_ASSOC);
					if($table->rowCount()>0)
					{
						$c = 0;
						foreach ($r as $rw)
						{
							$cc = $query.' AND coord = '.$rw['id'];
							$objPHPExcel->getActiveSheet()->getStyle($rowcount)->getFont()->setBold(true);
							$objPHPExcel->getActiveSheet()->getStyle('A'.$rowcount.':G'.$rowcount)->applyFromArray(
							array(
							      'fill' => array(
							            'type' => PHPExcel_Style_Fill::FILL_SOLID,
							            'color' => array('rgb' => '#FAFAD2')
							        )
							    )
							);
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $rowcount, $rw['nome'].' (COORDENADOR)');
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $rowcount, $rw['sexo']);
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $rowcount, $rw['titulo_eleitor']);
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $rowcount, $rw['cpf']);
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $rowcount, $rw['rg']);
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $rowcount, $rw['endereco']);
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $rowcount, $rw['bairro']);
							$rowcount++;
							$tbl = crud::dataview($cc);
							while($row=$tbl->fetch(PDO::FETCH_ASSOC))
							{
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $rowcount, $row['nome'].' (SUB-COORDENADOR)');
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $rowcount, $row['sexo']);
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $rowcount, $row['titulo_eleitor']);
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $rowcount, $row['cpf']);
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $rowcount, $row['rg']);
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $rowcount, $row['endereco']);
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $rowcount, $row['bairro']);
								$rowcount++;
							}
						}
					}
		// Também podemos escolher a posição exata aonde o dado será inserido (coluna, linha, dado);
		// Exemplo inserindo uma segunda linha, note a diferença no segundo parâmetro
		// Podemos renomear o nome das planilha atual, lembrando que um único arquivo pode ter várias planilhas
		$objPHPExcel->getActiveSheet()->setTitle('Credenciamento para o Evento');
		// Cabeçalho do arquivo para ele baixar
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="RELATORIO_I-SIS_subcord.xls"');
		header('Cache-Control: max-age=0');
		// Se for o IE9, isso talvez seja necessário
		header('Cache-Control: max-age=1');
		// Acessamos o 'Writer' para poder salvar o arquivo
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		// Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
		$objWriter->save('php://output'); 

		exit;
	}

	public function excelCord($query,$id=0)
	{
		$data = date('Y-m-d');
		$data = date('d/m/Y', strtotime($data));
		// Instanciamos a classe
		$objPHPExcel = new PHPExcel();
		$crud = new crud();
		// Definimos o estilo da fonte
		$objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('2')->getFont()->setBold(true);
		$objPHPExcel->setActiveSheetIndex()->mergeCells('A1:J1');
		$objPHPExcel->setActiveSheetIndex()->mergeCells('A2:C2');
		$objPHPExcel->setActiveSheetIndex()->mergeCells('D2:E2');
		// Criamos as colunas
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A1", "Relatório Sistema I-SIS" )
		          ->setCellValue('A2', 'Responsável pelo cadastro: '.$_SESSION['nomeUsuario'])
		          ->setCellValue("D2", "Data: ".$data );

		// Podemos configurar diferentes larguras paras as colunas como padrão
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);

					$rowcount = 3;
					if ($id==0) {
						$table = $crud->dataview('SELECT * FROM sub_coord WHERE coord <> 0');
					} else {
						$table = $crud->dataview('SELECT * FROM sub_coord WHERE coord <> 0 AND id ='.$id);
					}
					$r=$table->fetchAll(PDO::FETCH_ASSOC);
					if($table->rowCount()>0)
					{
						$c = 0;
						foreach ($r as $rw)
						{
							$objPHPExcel->getActiveSheet()->getStyle($rowcount)->getFont()->setBold(true);
							$objPHPExcel->getActiveSheet()->getStyle('A'.$rowcount.':J'.$rowcount)->applyFromArray(
							    array(
							        'fill' => array(
							            'type' => PHPExcel_Style_Fill::FILL_SOLID,
							            'color' => array('rgb' => 'F28A8C')
							        )
							    )
							);
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $rowcount, 'Nome Completo');
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $rowcount, 'Sexo');
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $rowcount, 'Titulo de eleitor');
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $rowcount, 'Endereço');
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $rowcount, 'Bairro');
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $rowcount, 'Data Cadastro');
							$rowcount++;
							$cc = $query.' AND responsavel_cadastro = '.$rw['id'];
							$objPHPExcel->getActiveSheet()->getStyle($rowcount)->getFont()->setBold(true);
							$objPHPExcel->getActiveSheet()->getStyle('A'.$rowcount.':F'.$rowcount)->applyFromArray(
							array(
							      'fill' => array(
							            'type' => PHPExcel_Style_Fill::FILL_SOLID,
							            'color' => array('rgb' => '#FAFAD2')
							        )
							    )
							);
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $rowcount, $rw['nome'].' (SUBCOORDENADOR)');
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $rowcount, $rw['sexo']);
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $rowcount, $rw['titulo_eleitor']);
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $rowcount, $rw['endereco']);
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $rowcount, $rw['bairro']);
							$rowcount++;
							$tbl = $crud->dataview($cc);
							$c++;
							while($row=$tbl->fetch(PDO::FETCH_ASSOC))
							{
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $rowcount, $row['nome_completo']);
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $rowcount, $row['sexo']);
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $rowcount, $row['titulo_eleitor']);
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $rowcount, $row['endereco']);
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $rowcount, $row['bairro']);
								$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $rowcount, date('d/m/Y', strtotime($row['data_cadastro'])));
								$rowcount++;
							}
						}
					}
		// Também podemos escolher a posição exata aonde o dado será inserido (coluna, linha, dado);
		// Exemplo inserindo uma segunda linha, note a diferença no segundo parâmetro
		// Podemos renomear o nome das planilha atual, lembrando que um único arquivo pode ter várias planilhas
		$objPHPExcel->getActiveSheet()->setTitle('Credenciamento para o Evento');
		// Cabeçalho do arquivo para ele baixar
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="RELATORIO_I-SIS_subcord.xls"');
		header('Cache-Control: max-age=0');
		// Se for o IE9, isso talvez seja necessário
		header('Cache-Control: max-age=1');
		// Acessamos o 'Writer' para poder salvar o arquivo
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		// Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
		$objWriter->save('php://output'); 

		exit;
	}
}

?>