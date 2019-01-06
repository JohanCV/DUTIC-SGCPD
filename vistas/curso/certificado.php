<?php
//require_once '../library/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

//require_once './library/vendor/autoload.php';

if(isset($_POST['crear'])){
	try {
		ob_start();
		require_once 'print_view.php';
	    //include dirname(__FILE__).'/res/example06.php';
	    $content = ob_get_clean();
	    
	    $html2pdf = new Html2Pdf('P','A4', 'es','true','UTF-8');
	    $html2pdf->writeHTML($content);
	    ob_end_clean();
	    $html2pdf->output('examplek.pdf');

	} 

	catch (Html2PdfException $e) {
	    $html2pdf->clean();
	    $formatter = new ExceptionFormatter($e);
	    echo $formatter->getHtmlMessage();
	}
}
?>
<form action="" method="POST">
	Nombre: <input type="text" placeholder="Otorgado a" name="titulo" />
	Curso: <input type="text" placeholder="Curso moodle" name="curso" />
	<input type="submit" value="Generar pdf" name="crear"/>
</form>