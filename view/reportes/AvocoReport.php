
	
 <?php
 
$directorio = $_SERVER ['DOCUMENT_ROOT'];
$dom=$directorio.'/rp_l/view/dompdf/dompdf_config.inc.php';

$domLogo=$directorio.'/rp_l/view/images/cnt_encabezado_coactiva.jpg';
$logo = '<img src="'.$domLogo.'" width="100%">';



require_once( $dom);

$html =$resultSet;
 

$dompdf = new DOMPDF();
$dompdf->load_html(utf8_decode($html));
$dompdf->set_base_path("/");
$dompdf->set_paper("A4");
$pdf = $dompdf->render();
$canvas = $dompdf->get_canvas();

$header = $canvas->open_object();
$font = Font_Metrics::get_font("Arial", "normal");


$canvas->page_text(250, 802, "JEFATURA DE COACTIVA", $font, 8, array(0,0,0)); //footer
$canvas->page_text(150, 812, "Av. Eloy Alfaro N29-16 y 9 de Octubre. Edf. Plaza Doral Oficina 126, Primer Piso - Quito.", $font, 8, array(0,0,0)); //footer


/*
$canvas->image($domLogo,"jpg",0, 0, 100, 0);
$canvas->close_object();
$canvas->add_object($header, "all");


*/





header("Content-type: application/pdf");
echo $dompdf->output();

/*
$dompdf = new DOMPDF();
$dompdf->load_html(utf8_decode($html));
$dompdf->set_paper("A4", "portrait");
$canvas = $dompdf->get_canvas();
$canvas->page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));
$dompdf->render();
$dompdf->stream("mipdf.pdf", array("Attachment" => 0));*/
?>




