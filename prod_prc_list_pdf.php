<?
$all=rawurldecode($_REQUEST[all]);

ob_start();
    include('prod_prc_list_pdfs.php');
    $content = ob_get_clean();

    // convert in PDF
    require_once('html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'en');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('Product Price.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
	?>