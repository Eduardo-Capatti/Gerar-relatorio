<?php
    require_once('dompdf/vendor/autoload.php');

    ob_start();
    require('relatorio.php');
    $html = ob_get_clean();

    use Dompdf\Dompdf;
    use Dompdf\Options;

    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);

    $dompdf = new Dompdf($options);

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A2', 'landscape');

    $dompdf->render();

    $dompdf->stream();

?>