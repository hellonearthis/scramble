<!DOCTYPE HTML >
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>scramble</title>
        <style>
            body {background: #gold;}
        </style>
    </head>
    <body>
<?php
 set_time_limit ( 1020 );
  include 'functions.php';

$scramble_this = 'test.zip ';                       //Open file to compress.
//$scramble_this = 'test.raw ';                       //Open file to compress.
$filesize =filesize($scramble_this);
$fhandle = fopen($scramble_this,'rb');
$thebytes = fread($fhandle, $filesize);
fclose($fhandle);

echo 'Orgional file size '.strlen($thebytes).' of test file<br>';
$coString = gzcompress ( $thebytes , 9 );                                      // test if compressed can be recompressed
echo '<b>Zombie compressioned size: '.strlen($coString).'</b><br>';

//  need to add for loop to cycle through split key (1-254) or just one key as this is the test area before working with compressed files.
for($scramkey=1;$scramkey<255;$scramkey++){
 //        $scramkey=102;                       // scramble key set
        echo $scramkey.' scramble key ';
        $skey=dec2bin($scramkey);  // convert to binary
        echo $skey[0].$skey[1].$skey[2].$skey[3].$skey[4].$skey[5].$skey[6].$skey[7].'<br>';
        $P0='';
        $P1='';
        echo 'bytes to compress are ';
        for($c=0;$c<$filesize;$c++){          // cyctle through the whole file doing a byte at a time.
            $byte=$thebytes[$c];                     // get byte to process
            echo ord($byte).',';
            $bb= byte2bin($byte);                   // get binary represintation todo: need a function to make into binary string
                                                                     // if key bit = 0 put bb bit in part 0 else put it into part 1
            for ($i=0; $i<=7; $i++){                 // process the byte bit by bit
                if(($skey[$i]=='0')){
                    $P0.=$bb[$i];                        // might get file size issues ?
                } else {
                    $P1.=(~$bb[$i]);
                    //    $thebytes[$i]=(~$thebytes[$i]); 
                }
            }
        }
//        echo '<br><br>Scramble bits<br>'.$P0.' part a scrambled<br>'.$P1.' part b scrambled<br>';

//        $plen= strlen($P0);                       // mid point used to unscramble the file.
//        echo $plen.' part 0 size, this is the binary decoding index offset<br>';
        $nf=$P0.$P1;                                // nf is the new file in binary format
//        echo 'scambled bits<br>'.$nf.'<br>';
//        echo (strlen($nf)/8).' size of bin /8<br>';
        // convert to hex like a raw zip file would be.....
        $it= binTohex($nf);

//        echo strlen($it).' scrambled size<br>';

        $coString = gzcompress ( $it , 9 );          // test if compressed can be recompressed
        echo '<b>compressioned scrambled size: '.strlen($coString).'</b><br>';
}  // loop through scramble keys looking for best compression


// next joint the two files and convet it back to decimal as well as
//  add the 1st byte as the scramblekey followed by a long word 4 bytes (x00000000) of the size of part 0

$nf = gzuncompress($coString); // uncompress
echo 'uncompressioned scrambled size: '.strlen($nf).'<br>';

// convert it back to binary
for($c=0;$c<$filesize;$c++){           // cyctle through the whole file doing a byte at a time.
    $byte=$nf[$c];                                  // get byte to process
    $nbb.= byte2bin($byte);                    // get binary represintation
}
echo '<br>bits to unscramble<br>'.$nbb.'<br>';
// decode file

$pa='';   // store decode file bin version
$pb='';  // string version
$pac=0; // index into part a and b
$pbc=0;
$sizeofbin=strlen($nbb);
for($ii=0;$ii<($sizeofbin/8);$ii++){    // cyctle through the whole file doing a byte at a time.
     for ($i=0; $i<=7; $i++){                   // process it  the byte pulling it in bit by bit
        if(($skey[$i]=='0')){
            $pa.=$nbb[$pba];                        // pull bit for part 0 and out in part a
            $pba++;
        } else {
            $pa.=(~$nbb[$plen+$pbc]);
            $pbc++;
        }

     }
}

// display unscrambled  bytes , should be same as orgional
echo '<br>Decode bytes ';
$sizeofbin=strlen($pa);
$zc=0;
for($z=0;$z<($sizeofbin/8);$z++){    // cyctle through the whole file doing a byte at a time.
   echo ord(pack ('C', bindec($pa[$zc+0].$pa[$zc+1].$pa[$zc+2].$pa[$zc+3].$pa[$zc+4].$pa[$zc+5].$pa[$zc+6].$pa[$zc+7])));
   $zc=$zc+8;
}


?>
 </body>
</html>