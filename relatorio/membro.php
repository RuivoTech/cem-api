<?php
require_once './config.php';
require_once './config/Conexao.php';
require_once "./dao/MembroDao.php";
require_once './model/Membro.php';
require_once './model/Contato.php';
require_once './model/Endereco.php';
require_once './model/DadosIgreja.php';
require_once './utils/Filtros.php';

// chamando os arquivos necess�rios do DOMPdf
require_once 'dompdf/lib/html5lib/Parser.php';
require_once 'dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once 'dompdf/lib/php-svg-lib/src/autoload.php';
require_once 'dompdf/autoload.inc.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
setlocale(LC_MONETARY, 'pt_BR');

// definindo os namespaces
Dompdf\Autoloader::register();
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dados = $_REQUEST;

$membroDao = new MembroDao();

$dadosRetorno = $membroDao->gerarRelatorio($dados);

$html = '<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Relatório de Membros - CEM</title>
        <style>
            table {
                border-collapse: collapse;
                font-size: 18px;
            }
            table td,
            table th {
                min-width: 30px;
                border-left: 1px solid #ccc;
                border-right: 1px solid #ccc;
                border-top: 1px solid #ccc;
                border-bottom: 1px solid #ccc;
            }
            tbody tr:nth-of-type(2n+1) {background: #CCC}
            .text-center {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div>
        <h1 class="text-center">
            Relatório de Membros
        </h1>';

$html .= '
<div>
	<table border="1">
		<thead>
			<tr>
				<th>#</th>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Celular</th>
                <th>Data Nascimento</th>
			</tr>
		</thead>
		<tbody>
    ' ;

foreach ($dadosRetorno as $membro) {
    $html .= '
                <tr>
    				<td>'.$membro->getId() .'</td>
    				<td>'. $membro->getNome().'</td>
    				<td>'. $membro->getContato()->getEmail() .'</td>
    				<td>'. $membro->getContato()->getCelular() .'</td>
                    <td class="text-center">'. $membro->getDataNascimento() .'</td>
			    </tr>';
}

$html .= '
        </tbody>
	       </table>
    </div>';

$html .= '</div>
    </body>
</html>';

$dompdf->loadHtml($html);

$dompdf->setPaper("A4", "landscape");

$dompdf->render();

$dompdf->stream("dizimos.pdf", array("Attachment" => false));