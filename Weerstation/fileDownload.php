<?php session_start();
    if(isset($_POST['filename']))  {
        $file = $_POST['filename'];
        if(file_exists("data/".$file)) {


            $strJsonFileContents = file_get_contents("data/" . $file);
            $arrayJson = json_decode($strJsonFileContents, true);

            header('Content-type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file . '.xml"');

            echo assocArrayToXML("root", $arrayJson);
            exit();
        }
    }
    function assocArrayToXML($root_element_name,$ar)
    {
        $xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><{$root_element_name}></{$root_element_name}>");
        $f = function($f,$c,$array) {
            foreach($array as $key=>$value) {
                if(is_array($value)) {
                    $ch=$c->addChild("weatherdata");
                    $f($f,$ch,$value);
                } else {
                    $c->addChild($key, $value);
                }
            }
        };
        $f($f,$xml,$ar);
        return $xml->asXML();
    }

