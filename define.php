<?php
define('domain','http://'.$_SERVER["SERVER_NAME"].'/trtcms5.3/');

//start
function insertWM($srcImg,$wm){
   $photo_to_paste=$wm;  //image 321 x 400
   $white_image=$srcImg; //873 x 622 
   $info_im = GetImageSize($white_image);
   if($info_im[2] == 1){
        $im = imagecreatefromgif($white_image);
    }
    elseif($info_im[2] == 2){
        $im = imagecreatefromjpeg($white_image);
    }
    elseif($info_im[2] == 3){
        $im = imagecreatefrompng($white_image);
    }
    $condicion = GetImageSize($photo_to_paste); // image format?
    if($condicion[2] == 1): //gif
    $im2 = imagecreatefromgif($photo_to_paste);
    elseif($condicion[2] == 2): //jpg
    $im2 = imagecreatefromjpeg($photo_to_paste);
    elseif($condicion[2] == 3): //png
    $im2 = imagecreatefrompng($photo_to_paste);
    endif;
    imagecopy($im, $im2, (imagesx($im)/2)-(imagesx($im2)/2), (imagesy($im)/2)-(imagesy($im2)/2), 0, 0, imagesx($im2), imagesy($im2));
    if($info_im[2] == 1){
        imagegif($im,$srcImg);

    }
    elseif($info_im[2] == 2){
        imagejpeg($im,$srcImg,90);
    }
    elseif($info_im[2] == 3){
        imagepng($im,$srcImg,9);
    }
    imagedestroy($im);
    imagedestroy($im2);
}

function csrf_field(){
  echo '<input type="hidden" name="_token" value="'.csrf_token().'">';
}

function online()
{
    $rip = $_SERVER['REMOTE_ADDR'];
    $sd = time();
    $count = 1;
    $maxu = 1;

    $file1 = "public/counter/online.log";
    $lines = file($file1);
    $line2 = "";

    foreach ($lines as $line_num => $line)
    {
        if($line_num == 0)
        {
            $maxu = $line;
        }
        else
        {
            $fp = strpos($line,'****');
            $nam = substr($line,0,$fp);
            $sp = strpos($line,'++++');
            $val = substr($line,$fp+4,$sp-($fp+4));
            $diff = $sd-$val;

            if($diff < 300 && $nam != $rip)
            {
                $count = $count+1;
                $line2 = $line2.$line;
            }
        }
    }

    $my = $rip."****".$sd."++++\n";
    if($count > $maxu)
        $maxu = $count;

    $open1 = fopen($file1, "w");
    fwrite($open1,"$maxu\n");
    fwrite($open1,"$line2");
    fwrite($open1,"$my");
    fclose($open1);
    $count=$count;
    $maxu=$maxu+200;

    return $count;
}

///////////////////////
$ip = $_SERVER['REMOTE_ADDR'];

$file_ip = fopen('public/counter/ip.txt', 'rb');
while (!feof($file_ip)) $line[]=fgets($file_ip,1024);
for ($i=0; $i<(count($line)); $i++) {
    list($ip_x) = explode("\n",$line[$i]);
    if ($ip == $ip_x) {$found = 1;}
}
fclose($file_ip);

if (!(@$found==1)) {
    $file_ip2 = fopen('public/counter/ip.txt', 'ab');
    $line = "$ip\n";
    fwrite($file_ip2, $line, strlen($line));
    $file_count = fopen('public/counter/count.txt', 'rb');
    $data = '';
    while (!feof($file_count)) $data .= fread($file_count, 4096);
    fclose($file_count);
    list($today, $yesterday, $total, $date, $days) = explode("%", $data);
    if ($date == date("Y m d")) $today++;
    else {
        $yesterday = $today;
        $today = 1;
        $days++;
        $date = date("Y m d");
    }
    $total++;
    $line = "$today%$yesterday%$total%$date%$days";

    $file_count2 = fopen('public/counter/count.txt', 'wb');
    fwrite($file_count2, $line, strlen($line));
    fclose($file_count2);
    fclose($file_ip2);
}


function today()
{
    $file_count = fopen('public/counter/count.txt', 'rb');
    $data = '';
    while (!feof($file_count)) $data .= fread($file_count, 4096);
    fclose($file_count);
    list($today, $yesterday, $total, $date, $days) = explode("%", $data);
    return $today;
}
function yesterday()
{
    $file_count = fopen('public/counter/count.txt', 'rb');
    $data = '';
    while (!feof($file_count)) $data .= fread($file_count, 4096);
    fclose($file_count);
    list($today, $yesterday, $total, $date, $days) = explode("%", $data);
    return $yesterday;
}
function total()
{
    $file_count = fopen('public/counter/count.txt', 'rb');
    $data = '';
    while (!feof($file_count)) $data .= fread($file_count, 4096);
    fclose($file_count);
    list($today, $yesterday, $total, $date, $days) = explode("%", $data);
    echo $total;
}
function avg()
{
    $file_count = fopen('public/counter/count.txt', 'rb');
    $data = '';
    while (!feof($file_count)) $data .= fread($file_count, 4096);
    fclose($file_count);
    list($today, $yesterday, $total, $date, $days) = explode("%", $data);
    echo ceil($total/$days);
}


 ?>


