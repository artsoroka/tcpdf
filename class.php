<?php
//error_reporting(false); 
require_once('lib/tcpdf.php');

class Wrapper {

	public $imagesArray = array(); 

	public function __construct(){
		
		$this->tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$this->tcpdf->SetCreator(PDF_CREATOR);
		$this->tcpdf->SetAuthor('1ADW');
		$this->tcpdf->SetTitle('NWST');
		$this->tcpdf->SetSubject('TEST');
		$this->tcpdf->SetKeywords('KEYWORDS');
		$this->tcpdf->setPrintHeader(false);
		$this->tcpdf->setPrintFooter(false);
		$this->tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$this->tcpdf->SetMargins(/*PDF_MARGIN_LEFT*/ 1, /*PDF_MARGIN_TOP*/ 1, /*PDF_MARGIN_RIGHT*/ 1);
		$this->tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$this->tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$this->tcpdf->SetFont('trebuchetmsi', 'BI', 20);
		$this->tcpdf->AddPage();

	}

	public function __destruct(){
		echo "GC"; 
	}
	public function render(){
		
		$this->description_section(); 
		$this->photo_section(); 
		//$this->tcpdf->save(); 
		//$this->tcpdf->__destruct(); 
		//print_r($this->tcpdf->snapshot); 
		$this->tcpdf->Output('somefile.pdf', 'I');
	}

	public function save(){
			$this->tcpdf->snapshot = $this->tcpdf; 
	}


	public function description_section(){

		$this->tcpdf->SetXY(0, 40);
		$this->tcpdf->SetFont('trebuchetmsi', '', 16, '', true);
		$this->tcpdf->SetTextColor(245,64,0);
		$this->tcpdf->writeHTMLCell(0, 0, '', '', '<div style="text-align:center">HELLO<img src="logo.jpg"></div>' , 0, 1, 0, true, '', true);
	}


	public function photo_section(){

		$X = 10; 
		$Y = intval( $this->tcpdf->getY() ) + 1; 
		$pages = $this->tcpdf->getNumPages(); 

		foreach ($this->imagesArray as $key => $value) {
			if (  $key % 2 ) {
				$X += 90;
				$this->draw_image($X, $Y, $value); 
				$Y += 65; 
			} else {

				$this->tcpdf->startTransaction();
				$this->draw_image($X, $Y, $value);

				if($pages != $this->tcpdf->getNumPages()){
					$this->tcpdf = $this->tcpdf->rollbackTransaction();
					$Y = 0;

					$this->tcpdf->AddPage(); 
					$pages = $this->tcpdf->getNumPages(); 

					$this->draw_image($X, $Y, $value); 
				} else {
					$this->tcpdf->commitTransaction();
				}

			}

			$X = 10; 
		}


	}

	private function draw_image($x, $y, $image){

	$this->tcpdf->SetXY($x, $y);
	$this->tcpdf->Image($image, '', '', 90, 65, '', '', 'T', false, 300, '', false, false, /* Border */ false, false, false, false);

	}

}

$doc = new Wrapper; 

$doc->imagesArray = array('house.jpg', 'house.jpg', 'house.jpg', 'house.jpg', 'house.jpg', 'house.jpg', 'house.jpg','house.jpg', 'house.jpg', 'house.jpg', 'house.jpg', 'house.jpg', 'house.jpg'); 

$doc->render(); 