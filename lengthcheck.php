<?php

    $fh_in = fopen('sample.csv','r');
    $dataarray = array();
    while($arr = fgetcsv($fh_in,1024)){
        $dataarray[] = $arr;
    }

    include_once('max_length.php');
    $maxlength = new Max_length($dataarray);
    $maxlength_array = $maxlength->get_max_length_data();
    print_r($maxlength_array);
    fclose($fh_in);
