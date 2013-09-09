<?php 
	
class xml2Array {
// http://www.php.net/manual/en/function.xml-parse.php    
    var $arrOutput = array();
    var $resParser;
    var $strXmlData;
    
    function parse($strInputXML) {
    
            $this->resParser = xml_parser_create ();
            xml_set_object($this->resParser,$this);
            xml_set_element_handler($this->resParser, "tagOpen", "tagClosed");
            
            xml_set_character_data_handler($this->resParser, "tagData");
        
            $this->strXmlData = xml_parse($this->resParser,$strInputXML );
            if(!$this->strXmlData) {
               die(sprintf("XML error: %s at line %d",
            xml_error_string(xml_get_error_code($this->resParser)),
            xml_get_current_line_number($this->resParser)));
            }
                            
            xml_parser_free($this->resParser);
            
            return $this->arrOutput;
    }
    function tagOpen($parser, $name, $attrs) {
       $tag=array("name"=>$name,"attrs"=>$attrs); 
       array_push($this->arrOutput,$tag);
    }
    
    function tagData($parser, $tagData) {
       if(trim($tagData)) {
            if(isset($this->arrOutput[count($this->arrOutput)-1]['tagData'])) {
                $this->arrOutput[count($this->arrOutput)-1]['tagData'] .= $tagData;
            } 
            else {
                $this->arrOutput[count($this->arrOutput)-1]['tagData'] = $tagData;
            }
       }
    }
    
    function tagClosed($parser, $name) {
       $this->arrOutput[count($this->arrOutput)-2]['children'][] = $this->arrOutput[count($this->arrOutput)-1];
       array_pop($this->arrOutput);
    }
} 


$xml = file_get_contents('http://partner.market.yandex.ru/pages/help/YML.xml'); 



$parser = new xml2Array; 
$res = $parser->parse($xml); 

print_r($res); 