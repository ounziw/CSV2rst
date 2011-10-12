<?php
require_once('makerst.php');
require_once('lime.php');
$t = new lime_test(null,new lime_output_color);

$text_array = array(
        array('abcd','あいう','あaい'),
        array('abc d','あい','あa')
    );
$maxlengthdata = array('5','6','5');
$rst = new Makerst($text_array,$maxlengthdata);

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
$t->is($rst->_out(array('abcd','あいう','あaい'))," abcd  あいう あaい ",'output length equal to maxlength');
$t->is($rst->_out(array('abcd','あいう','あaい'),'|'),"|abcd |あいう|あaい|",'output length equal to maxlength');
$rstout = $rst->outall();
$t->diag('空白、改行を入れて出力する');
$t->is($rstout," abcd  あいう あaい \n abc d あい   あa   \n",'output length equal to maxlength');
