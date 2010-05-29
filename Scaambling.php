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
      <pre>
        <?php
//Open file to compress.
$scramble_this = 'test.zip ';
$filesize =filesize($scramble_this);
$fhandle = fopen($scramble_this,'rb');
$thebytes = fread($fhandle, $filesize);
fclose($fhandle);


echo '<br>Orgional file size '.strlen($thebytes).'<br>';

//$coString = gzcompress ( $thebytes , 9 );         // test if compressed can be recompressed
//echo 'Zombie recompression: '.strlen($coString).'<br>';

$orgional_bytes=$thebytes; // backup for each loop iteration
for ($scramble_sequence=0; $scramble_sequence < 16; $scramble_sequence++ ){ // 4 bit sequence as repetes
// conver scramble_sequence into an arror of 0's and 1's
$skey = decbin($scramble_sequence);
$skey= str_split(str_repeat('0',(4-strlen($skey))).$skey); // make it 4 bits long
//print_r($skey);
  $thebytes=$orgional_bytes;  // reset to orgional file bytes
  $x=0;
  for ($i = 0; $i < $filesize; $i++) {
    if ($skey[$x] = 0){ 
  //    put in $file0
      echo $skey[$x].' $skey[$x] should be a 0<br>';
    } else {//
    echo $skey[$x].' $skey[$x] should be a 1<br>';
   //   put in $file1
    }

    $x++;
    if ($x>3)$x=0;
      echo '<br>'.$x.'= x '.$skey[$x].'= skey<br>';
      //$thebytes[$i]
 }
  
 // $compressed_string = gzcompress ( $thebytes , 9 );
  echo '<br>Noted bytes and compressed size is '.strlen($compressed_string).'<br>';
}

//for ($i = 0; $i < strlen($compressed_string); $i++) {
//  echo strtoupper(dechex(ord($compressed_string[$i])));
//  if ($i!=0){
//    if ($i % 32){
//          echo ',';
//    } else {
//          echo '<br>';
//    }
//  } else {
//      echo ',';
//  }
//  if ($i % 2){ // not all the even bits
 //   $thebytes[$i]=(~$thebytes[$i]);
//  }}



//$compressed = gzcompress ( $compressed_string , 9 );
//echo '<br>e compressed size '.strlen($compressed).'<br>';

?>
</pre>
    </body>
</html>
