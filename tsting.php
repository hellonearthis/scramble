<pre>
<?php
// this file to work out how to write the splitter

function byte2bin($input)  // convert  BYTE  into an 8 binary repesentation
{
  if (!is_string($input)) return null; // Sanity check
  // Unpack as a hexadecimal string

    $bb= decbin(ord($input));
    $bb= str_repeat('0',(8-strlen($bb))).$bb; // make it 4 bits long
     return $bb;
}

$thebytes='that fox is  quick as'.  chr(4).chr(254);  // bytes to scramble, this will be the compress file.

// convert to binary

echo $thebytes.'<br>';

//$numbytes=strlen($thebytes);  // number of bytes in the input file
$tb=str_split($thebytes);

//  need to add for loop to cycle through split key (1-254) or just one key as this is the test area before working with compressed files.

foreach ($tb as $byte ) {   // loop through file byte by byte
    echo $byte.':';
    $bb= byte2bin($byte);   // make it binary
    echo $bb[0].$bb[1].$bb[2].$bb[3].$bb[4].$bb[5].$bb[6].$bb[7].'<br>'; // faster access to each bit, skips splitting binary string into an array

    // if key bit = 0 put bb bit in part 0
    // if key bit = 1 put bb bit in part 1


}


//  $sk=str_split($skey).$skey;
//  print_r($sk);                                 // the split key
//$thebytes=$orgional_bytes;  // reset to orgional file bytes
//$x=0;
//  for ($i = 0; $i < 8; $i++) {  // filesize
//   // echo implode('',$sk);
// //   echo '<br>$i='.$i.'<br>';
//    if ($sk[$x] == 0){  //    put in $file0
//      echo $sk[$x].' $sk[$x] should be a 0<br>';
//    } else {  //   put in $file1
//      echo $sk[$x].' $sk[$x] should be a 1<br>';
//    }
//
//    $x++;
//    if ($x>3)$x=0;
//    echo '<br>'.$x.'= x '.$sk[$x].'= sk<br>';
//  }
//}
?>
</pre>