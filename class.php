<?php
//error_reporting(false); 
require_once('lib/tcpdf.php');

class Wrapper extends TCPDF {

	public $imagesArray = array(); 

	public function __construct(){
		
		parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$this->SetCreator(PDF_CREATOR);
		$this->SetAuthor('1ADW');
		$this->SetTitle('NWST');
		$this->SetSubject('TEST');
		$this->SetKeywords('KEYWORDS');
		$this->setPrintHeader(false);
		$this->setPrintFooter(false);
		$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$this->SetMargins(/*PDF_MARGIN_LEFT*/ 1, /*PDF_MARGIN_TOP*/ 1, /*PDF_MARGIN_RIGHT*/ 1);
		$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$this->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$this->SetFont('trebuchetmsi', 'BI', 20);
		$this->AddPage();

	}

	public function __destruct(){
		echo "GC"; 
	}
	public function render(){
		
		$this->description_section(); 
		//$this->photo_section(); 
		$this->save(); 
		$this->__destruct(); 
		//print_r($this->snapshot); 
		//$this->Output('somefile.pdf', 'I');
	}

	public function save(){
			$this->snapshot = $this; 
	}


	public function description_section(){

		$this->SetXY(0, 40);
		$this->SetFont('trebuchetmsi', '', 16, '', true);
		$this->SetTextColor(245,64,0);
		$this->writeHTMLCell(0, 0, '', '', '<div style="text-align:center">HELLO<img src="logo.jpg"></div>' , 0, 1, 0, true, '', true);
	}


	public function photo_section(){

		$X = 10; 
		$Y = intval( $this->getY() ) + 1; 
		$pages = $this->getNumPages(); 

		foreach ($this->imagesArray as $key => $value) {
			if (  $key % 2 ) {
				$X += 90;
				$this->draw_image($X, $Y, $value); 
				$Y += 65; 
			} else {

				$this->startTransaction();
				$this->draw_image($X, $Y, $value);

				if($pages != $this->getNumPages()){
					//$this->rollbackTransaction();
					$Y = 0;

					$this->AddPage(); 
					$pages = $this->getNumPages(); 

					$this->draw_image($X, $Y, $value); 
				} else {
					$this->commitTransaction();
				}

			}

			$X = 10; 
		}


	}

	private function draw_image($x, $y, $image){

	$this->SetXY($x, $y);
	$this->Image($image, '', '', 90, 65, '', '', 'T', false, 300, '', false, false, /* Border */ false, false, false, false);

	}

}

$doc = new Wrapper; 

$doc->imagesArray = array('house.jpg', 'house.jpg', 'house.jpg', 'house.jpg', 'house.jpg', 'house.jpg', 'house.jpg','house.jpg', 'house.jpg', 'house.jpg', 'house.jpg', 'house.jpg', 'house.jpg'); 

$doc->render(); 