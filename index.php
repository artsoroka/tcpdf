<?php 

require 'lib/tcpdf.php'; 

// Load config 
if ( ! file_exists('config.ini') ) throw new Exception("No config file", 1);

$config 			= parse_ini_file('config.ini', true); 
$saved_files_path 	= isset($config['application']['saved_files_directory']) ? $config['application']['saved_files_directory'] : '.'; 

// Folder exists 
if ( ! is_dir($saved_files_path) || ! file_exists($saved_files_path) ) throw new Exception("Folder do not exist", 1);
// Write permitions 
if ( ! is_writable($saved_files_path) ) throw new Exception("Permitions not granted", 1);


class Wrapper extends TCPDF{
	public function __construct($params = false){

		$this->product_title = $params['title']; 
			
		parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);	
		
			// set document information
		$this->SetCreator('PDF_CREATOR');
		$this->SetAuthor('Nicola Asuni');
		$this->SetTitle($this->product_title);
		$this->SetSubject('TCPDF Tutorial');
		$this->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		$this->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', 'PDF_HEADER_STRING', array(0,64,255), array(0,64,128));
		$this->setFooterData(array(0,64,0), array(0,64,128));

		// set header and footer fonts
		$this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 10));
		$this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$this->SetHeaderMargin(PDF_MARGIN_HEADER);
		$this->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$this->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set default font subsetting mode
		$this->setFontSubsetting(true);

		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		$this->SetFont('dejavusans', '', 14, '', true);


		// Add a page
		// This method has several options, check the source code documentation for more information.
		$this->AddPage();

	}

	private function template(){
		$html = '<!DOCTYPE html>
				<html>
				 <head>
				  <meta charset="utf-8">
				  <style>
				  </style>
				 </head> 
				 <body>' . $this->product_title . '				 	
				 </body>
				</html>'; 

		return $html; 
	}

	public function render(){
		$this->writeHTMLCell(0, 0, '', '', $this->template(), 0, 1, 0, true, '', true);

		$this->Output('example_001.pdf', 'I');  

	}
}

$wrapper = new Wrapper(array('title' => 'sometitle'));
$wrapper->render(); 
