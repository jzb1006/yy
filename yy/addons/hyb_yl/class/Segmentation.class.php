<?php

class Segmentation {

function spStr($str) 
{ 
    $cstr = array(); 
   
    $search = array(",", "/", "\\", ".", ";", ":", "\"", "!", "~", "`", "^", "(", ")", "?", "-", "\t", "\n", "'", "<", ">", "\r", "\r\n", "{1}quot;", "&", "%", "#", "@", "+", "=", "{", "}", "[", "]", "：", "）", "（", "．", "。", "，", "！", "；", "“", "”", "‘", "’", "［", "］", "、", "—", "　", "《", "》", "－", "…", "【", "】",); 
    $str = str_replace($search, " ", $str); 
    preg_match_all("/[a-zA-Z]+/", $str, $estr); 
    preg_match_all("/[0-9]+/", $str, $nstr); 
   
    $str = preg_replace("/[0-9a-zA-Z]+/", " ", $str); 
    $str = preg_replace("/\s{2,}/", " ", $str); 
   
    $str = explode(" ", trim($str)); 
   
    foreach ($str as $s) { 
        $l = strlen($s); 
   
        $bf = null; 
        for ($i= 0; $i< $l; $i=$i+3) { 
            $ns1 = $s{$i}.$s{$i+1}.$s{$i+2}; 
            if (isset($s{$i+3})) { 
                $ns2 = $s{$i+3}.$s{$i+4}.$s{$i+5}; 
                if (preg_match("/[\x80-\xff]{3}/",$ns2)) $cstr[] = $ns1.$ns2; 
            } else if ($i == 0) { 
                $cstr[] = $ns1; 
            } 
        } 
    } 
   
    $estr = isset($estr[0])?$estr[0]:array(); 
    $nstr = isset($nstr[0])?$nstr[0]:array(); 
   
    return array_merge($nstr,$estr,$cstr); 
  }
}
?>

