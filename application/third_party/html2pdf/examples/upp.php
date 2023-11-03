<?php
    // get the HTML
    ob_start();
    include(dirname(__FILE__).'/res/upp_view.php');
    $content = ob_get_clean();

    // convert to PDF
    require_once(dirname(__FILE__).'/../vendor/autoload.php');
    try
    {
        $html2pdf = new HTML2PDF('L', 'A4', 'en', true, 'UTF-8', 3);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('upp_new.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
