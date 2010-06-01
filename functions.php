<?php
/* 
 * custom routines to turn a byte/character into an 8 bit binary number
 */

function byte2bin($input)  // convert  BYTE  into an 8 binary repesentation (character)
{    $bb= decbin(ord($input));          // make the byte into binary
    $bb= str_repeat('0',(8-strlen($bb))).$bb; // make it 8 bits long as decbinstrips high bits
     return $bb;
}

function dec2bin($input)// convert  BYTE  into an 8 binary repesentation (intiger)
{   $bb= decbin($input);          // make the byte into binary
    $bb= str_repeat('0',(8-strlen($bb))).$bb; // make it 8 bits long as decbinstrips high bits
     return $bb;
}


// convert to hex like a raw zip file would be


function binTohex($input)
{
    $sizeofbin=strlen($input);
    $ix=0;  // index into binary file
    $coded='';
    for($i=0; $i<($sizeofbin/8); $i++) {    // get 8 bit and encode
       $abyte = $input[$ix].$input[$ix+1].$input[$ix+2].$input[$ix+3].$input[$ix+4].$input[$ix+5].$input[$ix+6].$input[$ix+7];
       $ix=$ix+8; // next byte
        $ibyte= pack ('C', bindec($abyte));  // convert byte into string
       $coded=$coded.$ibyte;                     // join string bytes together
    //   echo $i.':'.  ord($ibyte).' ';
    }
   // echo strlen($coded).' coded<br>';
return $coded;
}

function binTochr($input)
{
    $sizeofbin=strlen($input);
    $ix=0;  // index into binary file
    $coded='';
    for($i=0; $i<=($sizeofbin/8); $i++) {
        // get 8 bit and encode
       $abyte = $input[$ix].$input[$ix+1].$input[$ix+2].$input[$ix+3].$input[$ix+4].$input[$ix+5].$input[$ix+6].$input[$ix+7];
       // echo $abyte.'<br>';
       $ix=$ix+8; // next byte
       $ibyte= base_convert($abyte, 2, 10) ;  // bin to dec
       $coded.= chr($ibyte); // print that character
    }
    return $coded;
}
?>
