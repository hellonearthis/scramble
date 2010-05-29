<pre>
<?php
$thebytes='fgyewdskjafhajcyust9845n73q5c77-a8cj4w6c3fgyewdskjafhajcyust9845n73q5c77-a8cj4w6c3fgyewdskjafhajcyust9845n73q5c77-a8cj4w6c3fgyewdskjafhajcyust9845n73q5c77-a8cj4w6c3fgyewdskjafhajcyust9845n73q5c77-a8cj4w6c3';
$tbytes=strlen($thebytes);
$orgional_bytes=$thebytes;

echo 'file size '.$tbytes.'<br>';
for ($scramble_sequence=0; $scramble_sequence < 16; $scramble_sequence++ ){ // 4 bit sequence as repetes
// conver scramble_sequence into an arror of 0's and 1's
  $skey = decbin($scramble_sequence);
  $skey= str_repeat('0',(4-strlen($skey))); // make it 4 bits long
  unset($sk);
  $sk=str_split($skey).$skey;
  print_r($sk);
  echo ' $sk of sequence iteration '.$scramble_sequence.'<br>';
$thebytes=$orgional_bytes;  // reset to orgional file bytes
$x=0;
  for ($i = 0; $i < 8; $i++) {  // filesize
   // echo implode('',$sk);
 //   echo '<br>$i='.$i.'<br>';
    if ($sk[$x] == 0){  //    put in $file0
      echo $sk[$x].' $sk[$x] should be a 0<br>';
    } else {  //   put in $file1
      echo $sk[$x].' $sk[$x] should be a 1<br>';
    }

    $x++;
    if ($x>3)$x=0;
    echo '<br>'.$x.'= x '.$sk[$x].'= sk<br>';
  }
}
?>
</pre>