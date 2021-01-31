<?php session_start();
    if(isset($_POST['filename']))  {
        $file = $_POST['filename'];
        if(file_exists("data/".$file)) {


            $strJsonFileContents = file_get_contents("data/" . $file);
            $arrayJson = json_decode($strJsonFileContents, true);

            header('Content-type: text/xml');
            header('Content-Disposition: attachment; filename="' . $file . '.xml"');

            echo assocArrayToXML("weather_data", $arrayJson);
            exit();
        }
    }
    function assocArrayToXML($root_element_name,$ar)
    {
        $xml = new SimpleXMLElement("<?xml ?><{$root_element_name}></{$root_element_name}>");
        $f = function($f,$c,$array) {
            foreach($array as $key=>$value) {
                if(is_array($value)) {
                    $ch=$c->addChild($key);
                    $f($f,$ch,$value);
                } else {
                    $c->addChild($key,$value);
                }
            }
        };
        $f($f,$xml,$ar);
        return $xml->asXML();
    }

