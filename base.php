<?php

require_once('lib/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 002');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(/*PDF_MARGIN_LEFT*/ 1, /*PDF_MARGIN_TOP*/ 1, /*PDF_MARGIN_RIGHT*/ 1);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('trebuchetmsi', 'BI', 20);

// add a page
$pdf->AddPage();

$pdf->SetFont('trebuchetmsi', '', 14, '', true);

$HTML['table'] = '<table>
					<tr>
						<td>One</td>
						<td>Two</td>
					</tr>
				  </table>'; 

$HTML['header'] = 'Санкт-Петербург: ул. Свеаборгская, 15, т.: (812) 371-87-67, e-mail: alber@nwst.ru <br>
Выборгское ш., 214, т.: (812) 715-77-07, e-mail: kor_al@nwst.ru
Псковская обл: г. Пустошка, ул. Революции, д 16, т.: (8114) 22-19-11, (911) 376-17-13 
Москва: т.: (926) 790-72-75, 
Новгородская область: т.: (8162) 92-03-62'; 

//$pdf->writeHTMLCell(0, 0, '', '', $HTML['sample'] , 0, 1, 0, true, '', true);


$pdf->SetXY(0, 0);
$pdf->Image('logo.jpg', '', '', 80, 40, '', '', 'T', false, 300, '', false, false, /* Border */ false, false, false, false);


$pdf->SetXY(80, 5);
$pdf->SetFont('trebuchetmsi', '', 8, '', true);
$pdf->SetTextColor(245,64,0);
$pdf->writeHTMLCell(0, 0, '', '', $HTML['header'] , 0, 1, 0, true, '', true);

$pdf->SetXY(0, 40);
$pdf->SetFont('trebuchetmsi', '', 8, '', true);
$pdf->SetTextColor(245,64,0);
$pdf->writeHTMLCell(0, 0, '', '', '<hr color="red">' , 0, 1, 0, true, '', true);



$pdf->SetXY(0, 40);
$pdf->SetFont('trebuchetmsi', '', 16, '', true);
$pdf->SetTextColor(245,64,0);
$pdf->writeHTMLCell(0, 0, '', '', '<div style="text-align:center">HELLO</div>' , 0, 1, 0, true, '', true);


$arr = array('logo.jpg','logo.jpg','logo.jpg', 'logo.jpg',
 'logo.jpg', 'logo.jpg', 'logo.jpg', 'logo.jpg', 'logo.jpg', 'logo.jpg'
 , 'logo.jpg', 'logo.jpg', 'logo.jpg', 'logo.jpg', 'logo.jpg', 'logo.jpg');

//print_r($arr); 


$rows = intval(count($arr) / 2 +1 )	; 
//echo $rows; 
//echo "<br><br>"; 

/*


foreach ($arr as $key => $value) {
	echo "key $key "; 
	if (  $key % 2 ) echo " is odd";
	echo "<br>"; 
}



*/

function draw_image($pdf, $x, $y, $image){

$pdf->SetXY($x, $y);
$pdf->Image($image, '', '', 80, 40, '', '', 'T', false, 300, '', false, false, /* Border */ false, false, false, false);

}

$X = 0; 
$Y = 50; 

$pages = $pdf->getNumPages(); 

foreach ($arr as $key => $value) {
	if (  $key % 2 ) {
//		$X = 1;	
//		echo "key $key ($X,$Y)"; 
//		$Y += 1; 
		$X = 80;
		draw_image($pdf, $X, $Y, $value); 
		$Y += 40; 
	} else {
//		echo "key $key ($X,$Y)"; 


		$pdf->startTransaction();

		draw_image($pdf, $X, $Y, $value);


		if($pages != $pdf->getNumPages()){
			$pdf = $pdf->rollbackTransaction();
			$Y = 0;

			$pdf->AddPage(); 
			$pages = $pdf->getNumPages(); 

			draw_image($pdf, $X, $Y, $value); 
		} else {
			$pdf->commitTransaction();
		}


	}
//			echo "<br>"; 

	$X = 0; 
}

$pdf->Output('somefile.pdf', 'I');
