<pre>
<?php
// this file to work out how to write the splitter
// I'm sure there are bugs that are caused by working with ascii test data and not hex data like a raw file would have
// but ascii test data means the decoded can be read easyly,  maybe I should have use 0,1,2,3,4,5,6,7,8,9 but meh hind site

include 'functions.php';

$thebytes='that fox is  quick as'.  chr(4).chr(254);  // bytes to scramble, this will be the compress file.
echo $thebytes.'<br>';

echo '<br>Orgional file size '.strlen($thebytes).'<br>';

$tb=str_split($thebytes);         // convert input file into an array of bytes

//  need to add for loop to cycle through split key (1-254) or just one key as this is the test area before working with compressed files.
$scramkey=102;                       // scramble key set
$skey=dec2bin($scramkey);  // convert to binary
echo $skey[0].$skey[1].$skey[2].$skey[3].$skey[4].$skey[5].$skey[6].$skey[7].' scramble skey<br>';
$P0='';
$P1='';
foreach ($tb as $byte ) {           // loop through file byte by byte
    $bb= byte2bin($byte);           // make chars binary
//    $bb= dec2bin($byte);           // make byte  binary
                                                     // if key bit = 0 put bb bit in part 0 else put it into part 1
    for ($i=0; $i<=7; $i++){         // process the byte bit by bit
        if(($skey[$i]=='0')){
            $P0.=$bb[$i];
        } else {
            $P1.=$bb[$i];
        }
    }
}

echo $P0.' p0<br>';
echo $P1.' p1<br>';
$p0len= strlen($P0);                    // mid point used to unscramble the file.
echo $p0len.' lenght of part 0 in hex<br>';
$nf=$P0.$P1;                                // nf is the new file in binary format

// convert to hex like a raw zip file would be
//echo binTohex($nf);  // not needed really in the test file

//  joint the two files and convet it back to decimal and
//  add the 1st byte as the scramblekey followed by a long word 4 bytes (x00000000) of the size of part 0

$pa='';   // store decode file
$pac=0; // index into part a and b
$pbc=0;
$sizeofbin=strlen($nf);
for($ii=0;$ii<=($sizeofbin/8);$ii++){   // cyctle through the whole file doing a byte at a time.
     for ($i=0; $i<=7; $i++){                    // process it  the byte pulling it in bit by bit
        if(($skey[$i]=='0')){
            $pa.=$nf[$pba];                        // pull bit for part 0 and out in part a
            $pba++;
        } else {
            $pa.=$nf[$p0len+$pbc];
            $pbc++;
        }
     }
}

echo '<br>decoded<br>';
echo $pa.' pa<br>'; // decoded bit file

// decode bin to acsii again
echo binTochr($pa);

?>
</pre>