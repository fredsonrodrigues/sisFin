<?php
 
// Criamos a fun��o que far� os c�lculos atrav�z do comando microtime() do PHP
$tempo = null;
function execucao(){ 
    $sec = explode(" ",microtime());
    $tempo = $sec[1] + $sec[0];
    return $tempo; 
 
}
 
// No inicio da p�gina executamos a fun��o para iniciar o calculo, gerando a variavel $inicio
$inicio = execucao();
 
     //echo "hora de inicio: ".$Time->TempoInicialParcial;
 
     $host = $_POST["host"];
     $login = $_POST["login"];
     $senha = $_POST["senha"];
 
     if(isset($_POST["listaTabela"])) {
               $listaTabela =1;
          }  else  {
               $listaTabela = 0;
          }
 
     if(isset($_POST["nomeTabelaVerdadeiro"])) {
               $nomeTabelaVerdadeiro =1;
          }  else  {
               $nomeTabelaVerdadeiro = 0;
          }
 
     if(isset($_POST["listaCampo"])) {
               $listaCampo =1;
          }  else  {
               $listaCampo = 0;
          }
 
     if(isset($_POST["nomeCampoVerdadeiro"])) {
               $nomeCampoVerdadeiro =1;
          }  else  {
               $nomeCampoVerdadeiro = 0;
          }          
 
     $repetir = $_POST["repetir"];
 
 
     $repeticao = 0;
    while ($repeticao < $repetir) {
          $link = null;
          $result = null;
          $tabelas = null;
          $result1 = null;
          $row = null;
 
          $link = mysql_connect($host, $login, $senha)or die("Falha ao se conectar ao banco. Verifique se os dados de conex�o est�o corretos.");; 
          if (!$link) {
               echo 'Nao foi possivel conectar: '. mysql_error() . '<br>';
               exit;
          } else {
               echo 'Conectado ao banco '. $login. ' no servidor '.$host. ' <br>';
          }
 
          $dbname = $login;
          mysql_select_db($dbname, $link);
 
          $sql = "SHOW TABLES FROM $dbname";
          $result = mysql_query($sql);
 
          if (!$result) {
               echo "DB Error, could not list tables\n";
               echo 'MySQL Error: ' . mysql_error();
               exit;
          }  /*else {
               echo 'tabela - consulta realizada com sucesso <br><br>';
          } */
 
          $contar = 0;
          while ($tabelas = mysql_fetch_row($result)) {
               //echo "Tabela: {$tabelas[0]}\n <br>";
               $contar++;
               if ($listaTabela == 1) {
                    if ($nomeTabelaVerdadeiro == 0) {
                         echo "Tabela: ".$contar."<br>";
                         } else {
                         echo "Tabela: {$tabelas[0]} <br>";
                         }
               }
 
               $result1 = mysql_query('SHOW COLUMNS FROM `'.$tabelas[0].'`'); 
               if (mysql_num_rows($result1) > 0) {
                    $contar1 = 0; 
                         while ($row = mysql_fetch_assoc($result1)) { 
                              //print '<span>'.$row['Field'].'</span><br />'; 
                              $contar1++;
                         if ($listaCampo == 1) {
                              if ($nomeCampoVerdadeiro == 0) {
                                   print '<span>Campo: '.$contar1.'</span><br />'; 
                              } else {
                                   print '<span>'.$row['Field'].'</span><br />';
                              }
                         }
                    }
               if ($listaTabela || $listaCampo) {
                    echo "<br>"; 
                    }
               } 
          }
          mysql_close($link);
          $repeticao++;
          echo "execu��o numero: ". $repeticao;
          echo "<br>";
     }
 
 
 
// Ap�s a execu��o da p�gina, geramos a variavel $fim, que nos dar� o tempo final da execu��o da p�gina
$fim = execucao();
 
// Agora � s� fazermos a subtra��o de um pelo outro, e usar o number_format() do PHP para formatar com 6 casas depois da virgula e pronto, mas caso voc� queira alterar esse n�mero de casas depois da v�rgula para mais ou menos, fique a vontade
$tempo = number_format(($fim-$inicio),6);
 
// Agora � s� imprimir o resultado
print "Tempo de Execu��o: <b>".$tempo."</b> segundos";
 
?>