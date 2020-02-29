<?php

//This function gif2jpeg take three parameter as argument. two argument are optional
//first will take the gif file name. second for file name to save the converted file. third argument is an color array

//EXAMPLE:
$gifName = $_GET['gif_name']; //ABSOLUTE PATH OF THE IMAGE (according to its location)
$c['red']=255;
$c['green']=0;
$c['blue']=0;
echo gif2jpeg($gifName, '', $c);


function gif2jpeg($p_fl, $p_new_fl='', $bgcolor=false)
{
    list($wd, $ht, $tp, $at)=getimagesize($p_fl);
    $img_src=imagecreatefromgif($p_fl);
    $img_dst=imagecreatetruecolor($wd, $ht);
    $clr['red']=255;
    $clr['green']=255;
    $clr['blue']=255;
    if (is_array($bgcolor)) {
        $clr=$bgcolor;
    }
    $kek=imagecolorallocate(
      $img_dst,
                  $clr['red'],
      $clr['green'],
      $clr['blue']
  );
    imagefill($img_dst, 0, 0, $kek);
    imagecopyresampled(
      $img_dst,
      $img_src,
      0,
      0,
                  0,
      0,
      $wd,
      $ht,
      $wd,
      $ht
  );
    $draw=true;
    if (strlen($p_new_fl)>0) {
        if ($hnd=fopen($p_new_fl, 'w')) {
            $draw=false;
            fclose($hnd);
        }
    }
    if (true==$draw) {
        header("Content-type: image/jpeg");
        imagejpeg($img_dst);
    } else {
        imagejpeg($img_dst, $p_new_fl);
    }
    imagedestroy($img_dst);
    imagedestroy($img_src);
}
