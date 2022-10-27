<?php
class Searching {
  var $options = array('lowercase' => TRUE, 
  'segment_english' => FALSE);
  var $dict_name = 'Unknown';
  var $dict_words = array();
  function setLowercase($value) {
    if ($value) {
      $this->options['lowercase'] = TRUE;
    } else {
      $this->options['lowercase'] = FALSE;
    }
    return TRUE;
  }
  function setSegmentEnglish($value) {
    if ($value) {
      $this->options['segment_english'] = TRUE;
    } else {
      $this->options['segment_english'] = FALSE;
    }
    return TRUE;
  }
  function load($dict_file) {
    if (!file_exists($dict_file)) {
      return FALSE;
    }
    $fp = fopen($dict_file, 'r');
    $temp = fgets($fp, 1024);
    if ($temp === FALSE) {
      return FALSE;
    } else {
      if (strpos($temp, "\t") !== FALSE) {
        list ($dict_type, $dict_name) = explode("\t", trim($temp));
      } else {
        $dict_type = trim($temp);
        $dict_name = 'Unknown';
      }
      $this->dict_name = $dict_name;
      if ($dict_type !== 'DICT_WORD_W') {
        return FALSE;
      }
    }
    while (!feof($fp)) {
      $this->dict_words[rtrim(fgets($fp, 32))] = 1;
    }
    fclose($fp);
    return TRUE;
  }
  function getDictName() {
    return $this->dict_name;
  }
  function segmentString($str) {
    if (count($this->dict_words) === 0) {
      return FALSE;
    }
    $lines = explode("\n", $str);
    return $this->_segmentLines($lines);
  }
  function segmentFile($filename) {
    if (count($this->dict_words) === 0) {
      return FALSE;
    }
    $lines = file($filename);
    return $this->_segmentLines($lines);
  }
  function _segmentLines($lines) {
    $contents_segmented = '';
    foreach ($lines as $line) {
      $contents_segmented .= $this->_segmentLine(rtrim($line)) . " \n";
    }
    do {
      $contents_segmented = str_replace(' ', ' ', $contents_segmented);
    }
    while (strpos($contents_segmented, ' ') !== FALSE);
    return $contents_segmented;
  }
  function _segmentLine($str) {
    $str_final = '';
    $str_array = array();
    $str_length = strlen($str);
    if ($str_length > 0) {
      if (ord($str{$str_length-1}) >= 129) {
        $str .= ' ';
      }
    }
    for ($i=0; $i<$str_length; $i++) {
      if (ord($str{$i}) >= 129) {
        $str_array[] = $str{$i} . $str{$i+1};
        $i++;
      } else {
        $str_tmp = $str{$i};
        for ($j=$i+1; $j<$str_length; $j++) {
          if (ord($str{$j}) < 129) {
            $str_tmp .= $str{$j};
          } else {
            break;
          }
        }
        $str_array[] = array($str_tmp);
        $i = $j - 1;
      }
    }
    $pos = count($str_array);
    while ($pos > 0) {
      $char = $str_array[$pos-1];
      if (is_array($char)) {
        $str_final_tmp = $char[0];
        if ($this->options['segment_english']) {
          $str_final_tmp = preg_replace("/([\!\"\#\$\%\&\'\(\)\*\+\,\-\.\/\:\;\<\=\>\?\@\[\\\\\]\^\_\`\{\|\}\~\t\f]+)/", " $1 ", $str_final_tmp); 
$str_final_tmp = preg_replace("/([\!\"\#\$\%\&\'\(\)\*\+\,\-\.\/\:\;\<\=\>\?\@\[\\\\\]\^\_\`\{\|\}\~\t\f])([\!\"\#\$\%\&\'\(\)\*\+\,\-\.\/\:\;\<\=\>\?\@\[\\\\\]\^\_\`\{\|\}\~\t\f])/", " $1 $2 ", $str_final_tmp);
        }
        if ($this->options['lowercase']) {
          $str_final_tmp = strtolower($str_final_tmp);
        }
        $str_final = " $str_final_tmp$str_final";
        $pos--;
      } else {
        $word_found = 0;
        $word_array = array(0 => '');
        if ($pos < 4) {
          $word_temp = $pos + 1;
        } else {
          $word_temp = 5;
        }
        for ($i=1; $i<$word_temp; $i++) {
          $word_array[$i] = $str_array[$pos-$i] . $word_array[$i-1];
        }
        for ($i=($word_temp-1); $i>1; $i--) {
          if (array_key_exists($word_array[$i], $this->dict_words)) {
            $word_found = $i;
            break;
          }
        }
        if ($word_found) {
          $str_final = " $word_array[$word_found]$str_final";
          $pos = $pos - $word_found;
        } else {
          $str_final = " $char$str_final";
          $pos--;
        }
      }
    }
    return $str_final;
  }
}
?>
