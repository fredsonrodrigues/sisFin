<html>
     <head>
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
          <title>[PHP] Teste de desempenho de banco de dados</title>
          <style>
          .x {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:smaller;}
          .y {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:xx-small;}
          </style>
     </head>
     <body>
          <script language="Javascript">
              function validaForm(){
                      d = document.testemysql;
                      //validar host
                      if (d.host.value == ""){
                                  alert("O campo " + d.host.name + " deve ser preenchido!");
                                  d.host.focus();
                                  return false;
                        }     
                      //validar login
                      if (d.login.value == ""){
                                  alert("O campo " + d.login.name + " deve ser preenchido!");
                                  d.login.focus();
                                  return false;
                        }     
                      //validar senha
                      if (d.senha.value == ""){
                                  alert("O campo " + d.host.senha + " deve ser preenchido!");
                                  d.senha.focus();
                                  return false;
                        }     
                      //validar repetir
                      if (d.repetir.value == ""){
                                  alert("O campo Numero de Execuções de Teste deve ser preenchido!");
                                  d.repetir.focus();
                                  return false;
                        }     
              }

          </script>
          <h2>Teste simples de desempenho de banco de dados MySQL</h2>
          <form class="x" name="testemysql" action="fazteste.php" method="post" onSubmit="return validaForm()">
               <p class="x">Dados do servidor<br>
               <table border="0">
                    <tr>
                         <td class="x">Servidor: </td>
                         <td><input class="x" type="text" name="host" id="host"></td>
                    </tr>
                    <tr>
                         <td class="x">Usuario: </td>
                         <td><input class="x" type="text" name="login" id="login"></td>
                    </tr>
                    <tr>
                         <td class="x">Senha: </td>
                         <td><input class="x" type="password" name="senha" id="senha"></td>
                    </tr>
                    <tr>
                         <td class="y">Lista Tabelas?: </td>
                         <td><input class="x" type="checkbox" size="20" name="listaTabela" id="listaTabela"></td>
                         <td class="y">Nome Verdadeiro?: </td>
                         <td><input class="x" type="checkbox" name="nomeTabelaVerdadeiro" id="nomeTabelaVerdadeiro"></td>
                    </tr>
                    <tr>
                         <td class="y">Lista Campos?: </td>
                         <td><input class="x" type="checkbox" name="listaCampo" id="listaCampo"></td>
                         <td class="y">Nome Verdadeiro?: </td>
                         <td><input class="x" type="checkbox" name="nomeCampoVerdadeiro" id="nomeCampoVerdadeiro"></td>
                    </tr>
                    <tr>
                         <td class="x">Numero de Execuções do Teste: </td>
                         <td><input class="x" type="text" name="repetir" id="repetir"></td>
                    </tr>
               </table>
               <div class="x">
                    <input class="x" type="submit" value="enviar">
               </div>
          </form>
     </body>
</html>