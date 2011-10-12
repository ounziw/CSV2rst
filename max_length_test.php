<?php
require_once('max_length.php');
require_once('lime.php');
$t = new lime_test(null,new lime_output_color);

$text = new Max_length();
$t->diag('array text 2 length');
$t->is($text->_get_lengths('abc'),3,'String length' );
$t->is($text->_get_lengths(array('abc','d')),array('3','1'),'Array length' );
$text_array = array(
        array('abcd','あいう','あaい'),
        array('abc d','あい','あa')
    );
$int_array = array(
        array(4,6,5),
        array(5,4,3)
    );
$t->is($text->_get_lengths($text_array),$int_array,'Multiple Array length' );

$t->diag('array max length');
$inverse_array = array(
        array(4,5),
        array(6,4),
        array(5,3)
    );
$t->is($text->_get_array_inverse($int_array),$inverse_array,'Inverse Array' );
$max_length_array = $text->_get_array_max_length($inverse_array);
$t->is($max_length_array,array('5','6','5'),'' );
$t->diag('input');
$t->is($text->_data_input($text_array),true,'Input' );
$t->is($text->_data_input('aaa'),false,'Input' );
$t->is($text->_data_input(),false,'Input' );

$rst = new Max_length($text_array);
$t->is($rst->get_max_length_data(),array('5','6','5'),'Full' );
