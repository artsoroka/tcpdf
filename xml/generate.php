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



//Создает XML-строку и XML-документ при помощи DOM 
$dom = new DomDocument('1.0'); 

//добавление корня - <books> 
$books = $dom->appendChild($dom->createElement('books')); 

//добавление элемента <book> в <books> 
$book = $books->appendChild($dom->createElement('book')); 

// добавление элемента <title> в <book> 
$title = $book->appendChild($dom->createElement('title')); 

// добавление элемента текстового узла <title> в <title> 
$title->appendChild( 
                $dom->createTextNode('Great American Novel')); 

//генерация xml 
$dom->formatOutput = true; // установка атрибута formatOutput
                           // domDocument в значение true 
// save XML as string or file 
$test1 = $dom->saveXML(); // передача строки в test1 

//$dom->save('test1.xml'); // сохранение файла  

echo $test1; 


$parser = new xml2Array; 
$res = $parser->parse($test1); 

print_r($res);

