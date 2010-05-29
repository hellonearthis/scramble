<pre>
<?php
// this file to work out how to write the splitter

function byte2bin($input)  // convert  BYTE  into an 8 binary repesentation
{    $bb= decbin(ord($input));          // make the byte into binary
    $bb= str_repeat('0',(8-strlen($bb))).$bb; // make it 8 bits long as decbinstrips high bits
     return $bb;
}

function dec2bin($input)
{   $bb= decbin($input);          // make the byte into binary
    $bb= str_repeat('0',(8-strlen($bb))).$bb; // make it 8 bits long as decbinstrips high bits
     return $bb;
}

$thebytes='that fox is  quick as'.  chr(4).chr(254);  // bytes to scramble, this will be the compress file.

echo $thebytes.'<br>';

$tb=str_split($thebytes); // convert input file into an array of bytes

//  need to add for loop to cycle through split key (1-254) or just one key as this is the test area before working with compressed files.
$scramkey=42;        // scramble key set
$skey=dec2bin($scramkey);  // convert to binary
echo $skey[0].$skey[1].$skey[2].$skey[3].$skey[4].$skey[5].$skey[6].$skey[7].' skey<br>';
$P0='';
$P1='';
foreach ($tb as $byte ) {   // loop through file byte by byte
    echo $byte.':';
    $bb= byte2bin($byte);   // make it binary
    echo $bb[0].$bb[1].$bb[2].$bb[3].$bb[4].$bb[5].$bb[6].$bb[7].'<br>'; // faster access to each bit, skips splitting binary string into an array

    // if key bit = 0 put bb bit in part 0 else put it into part 1
   
    for ($i=0; $i<=7; $i++){
        if(($skey[$i]=='0')){
            $P0.=$bb[$i];
        } else {
            $P1.=$bb[$i];
        }
    }
}

echo $P0.' p0<br>';
echo $P1.' p1<br>';
$p0len= strlen($P0);    // mid point used to unscramble the file.
echo $p0len.' lenght of part o';
// now to reverse it...

?>
</pre>