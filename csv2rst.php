<?php

    $fh_in = fopen('sample.csv','r');
    $fh_out = fopen('sample.rst','w');
    $dataarray = array();
    while($arr = fgetcsv($fh_in,1024)){
        $dataarray[] = $arr;
    }

    include_once('makerst.php');
    $makerst = new Makerst($dataarray,$maxlength_array);

    /*
     * テーブルの長さを指定する
     * lengthcheck.php を実行した結果を目安にしてください
     */
    $maxlength_array = array(14,18,28,50);
    /*
     * 折り返し無(一番長いものに合わせる)はこちら
     */
    /*
    include_once('max_length.php');
    $maxlength = new Max_length($dataarray);
    $maxlength_array = $maxlength->get_max_length_data();
     */

    
    $out = "";
    $out .= $makerst->lineout();
    $out .= $makerst->outall();
    $out .= $makerst->lineout();
    /*
     * 区切りを空白でないものにする場合はこちら
     */
    /*
    $out .= $makerst->lineout('+');
    $out .= $makerst->outall('|');
    $out .= $makerst->lineout('+');
     */

    fwrite($fh_out,$out);
    fclose($fh_in);
    fclose($fh_out);
