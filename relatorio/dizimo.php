<?php
require_once '../cem-api/config.php';
require_once '../cem-api/config/Conexao.php';
require_once "../cem-api/dao/DizimoDao.php";
require_once '../cem-api/model/Dizimo.php';

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

$porMembro = filter_input(INPUT_GET, "porMembro") !== null ? filter_input(INPUT_GET, "porMembro") : "";

$idMembro = !Empty($porMembro) ? filter_input(INPUT_GET, "idMembro") : null;

$dataInicio = filter_input(INPUT_GET, "dataInicio");
$dataFim = filter_input(INPUT_GET, "dataFim");


$dados = array("porNome" => $porMembro,"dataInicio" => $dataInicio,"dataFim" => $dataFim, "idMembro" => $idMembro);
$dizimoDao = new DizimoDao();

$dadosRetorno = $dizimoDao->gerarRelatorio($dados);

$bootstrap = file_get_contents("./css/bootstrap.min.css");

$html = '<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Relatório de Dizimos - CEM</title>
        <style>' . $bootstrap . '</style>
    </head>
    <body>
        <div class="container-fluid">
        <div class="h1 text-center">
        Relatório de Dizimos</div>';

$html .= '
<div class="row col-12">
	<table class="table table-hover dataTable" role="grid">
		<thead>
			<tr>
				<th scope="col" class="tamanho7">#</th>
				<th scope="col" class="tamanho50">Nome</th>
				<th scope="col" class="tamanho23">Valor</th>
				<th scope="col" class="tamanho15">Data Dizimo</th>
			</tr>
		</thead>
		<tbody>
    ' ;

foreach ($dadosRetorno as $dizimo) {
    $html .= '
                <tr>
    				<td class="tamanho7">'.$dizimo->getId() .'</td>
    				<td class="tamanho50">'. $dizimo->getNome().'</td>
    				<td class="tamanho23">'. money_format("%n", $dizimo->getValorDizimo()) .'</td>
    				<td class="tamanho15">'. date("d/m/Y", strtotime($dizimo->getDataDizimo())).'</td>
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

$dompdf->setPaper("A4", "portrait");

$dompdf->render();

$dompdf->stream("dizimos.pdf", array("Attachment" => false));