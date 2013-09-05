<?php 

class Template extends TCPDF {
	public function construct(){

		parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// Some configuration 
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

	}
}

class Data {

}

class Wrapper {
	
	public function __construct(Template $template){
		$this->tcpdf = $template;   
	}

	public function render(){
	
		$this->tcpdf->AddPage(); 
	
		$this->description_section(); 
		$this->photo_section(); 
	
		$this->tcpdf->Output('somefile.pdf', 'I');
	}

	private function description_section(){

		$this->tcpdf->SetXY(0, 40);
		$this->tcpdf->SetFont('trebuchetmsi', '', 16, '', true);
		$this->tcpdf->SetTextColor(245,64,0);
		$this->tcpdf->writeHTMLCell(0, 0, '', '', '<div style="text-align:center">HELLO<img src="logo.jpg"></div>' , 0, 1, 0, true, '', true);

	}


	private function photo_section(){

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

