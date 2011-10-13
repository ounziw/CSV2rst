<?php

class Makerst {
    var $_textdata;
    var $_padded_textdata;
    var $_maxlengthdata;
    function __construct($textdata,$maxlengthdata="") {
        if (is_array($textdata)) {
            $this->_textdata = $textdata;
        }
        if (is_array($maxlengthdata) && count($maxlengthdata) == count($textdata[0])) {
            $this->_maxlengthdata = $maxlengthdata;
        } else {
            $this->_maxlengthdata = array_map('mb_strwidth',$textdata[0]);
        }
    }
    function _array_split($input,$length) {
        while( $this->_array_length_check($input,$length)) {
        $len = count($input);
        for($i=0;$i<$len;$i++) {
            $array[$i] = mb_strimwidth($input[$i],0,$length[$i],'',"UTF-8");
            $input[$i] = mb_substr($input[$i],mb_strlen($array[$i]),mb_strlen($input[$i]),"UTF-8");
        }
        $arr[] = $array;
        }
        $arr[] = $input;
        return $arr;
    }
    function _array_length_check($input,$length) {
        $len = count($input);
        $longer = 0;
        for($i=0;$i<$len;$i++) {
            if (mb_strwidth($input[$i]) > $length[$i]) {
                $longer++;
            }
        }
        return $longer;
    }

    function _mb_str_pad($input,$length,$filltext=" ") {
        if (1 != strlen($filltext)) {
            $filltext = " ";
        }

        $filllen = $length - mb_strwidth($input);
        if ($filllen > 0) {
            for($j=0;$j<$filllen;$j++) {
                $input .= " ";
            }
        }
        return $input;
    }
    function lineout($separator=" ",$line="-") {
        $lineout = $separator ;
        foreach($this->_maxlengthdata as $val) {
            for($i=0;$i<$val;$i++) {
                $lineout .= $line;
            }
            $lineout .= $separator;
        }
        $lineout .= "\n";
        return $lineout;
    }
    function _out($array,$separator=" ") {
        if (is_array($array)) {
            $len = count($this->_maxlengthdata);
            $outdata = $separator;
            for($i=0;$i<$len;$i++) {
                $outdata .= $this->_mb_str_pad($array[$i],$this->_maxlengthdata[$i]);
                $outdata .= $separator;
            }
            return $outdata;
        } else {
            return false;
        }
    }
    function outall($separator=" ") {
        foreach ($this->_textdata as $arr){
            $splitted_array = $this->_array_split($arr,$this->_maxlengthdata);
            foreach ($splitted_array as $array) {
            $this->_padded_textdata .= $this->_out($array,$separator);
            $this->_padded_textdata .= "\n";
            }
        }
        return $this->_padded_textdata;
    }
}
