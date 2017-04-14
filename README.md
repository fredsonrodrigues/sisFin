# sisFin

Sistema básico de cadastro de pessoas.


O banco é configurado no arquivo core/def.php :

```php
<?php
//descomentar e configurar de acordo com o banco de dados local
/*define('DB_HOST', "SEU HOST");
define('DB_NAME', "SEU BANCO");
define('DB_USER', "SEU USUARIO DO BANCO");
define('DB_PASS', "SENHA DO BANCO DE DADOS");*/

?>
```

### Bibliotecas inclusas:

 * [FPDF](http://www.fpdf.org/) para a geração de arquivos pdf (relatórios)
 * [PHPExcel](https://github.com/PHPOffice/PHPExcel) para a geração dos relatórios em formatos .xls
