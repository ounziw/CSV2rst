<?php
require_once('makerst.php');
require_once('lime.php');
$t = new lime_test(null,new lime_output_color);

$text_array = array(
        array('abc d','あいう','あaい'),
        array('abc d','あい','あa')
    );
$maxlengthdata = array('5','6','5');
$rst = new Makerst($text_array,$maxlengthdata);

$t->diag('指定した長さで区切る');
$t->is($rst->_array_length_check(array('あい'),array(5)),0,"_array_length_check('あい',5)");
$t->is($rst->_array_length_check(array('あい'),array(4)),0,"_array_length_check('あい',4)");
$t->is($rst->_array_length_check(array('あい'),array(3)),1,"_array_length_check('あい',3)");
$arr = array(
    array('あ'),
    array('い')
);
$t->is($rst->_array_split(array('あい'),array(3)),$arr,"_array_split('あい',3)");
$arr2 = array(
    array('あ','aaaa'),
    array('い','')
);
$t->is($rst->_array_split(array('あい','aaaa'),array(3,6)),$arr2,"_array_split(array('あい','aaaa'),array(3,6))");

$t->diag('出力の長さを揃える');
$t->is($rst->_mb_str_pad('あい',5),'あい ',"_mb_str_pad('あい',5)");
$t->is($rst->_mb_str_pad('あa',5),'あa  ',"_mb_str_pad('あa',5)");
$t->is($rst->_mb_str_pad('あい',3),'あい',"_mb_str_pad('あい',3)");
$t->diag('罫線の長さ');
$lineout = $rst->lineout();
$t->is($lineout," ----- ------ ----- \n","maxlength array('5','6','5')");
$lineout2 = $rst->lineout('+');
$t->is($lineout2,"+-----+------+-----+\n","maxlength array('5','6','5')");
$t->diag('配列に適用する');
$t->is($rst->_out(array('abcd','あいう','あaい'))," abcd  あいう あaい ",'空白文字を追加して表示');
$t->is($rst->_out(array('abcd','あいう','あaい'),'|'),"|abcd |あいう|あaい|",'空白文字と区切り');
$rstout = $rst->outall();
$t->diag('空白、改行を入れて出力する');
$t->is($rstout," abc d あいう あaい \n abc d あい   あa   \n",'改行もいれる。改行コード\n');
