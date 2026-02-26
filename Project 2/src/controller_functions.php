<?php function create_watermark($picture, $mime_type){
    if ($mime_type === 'image/jpeg'){
        $image= imagecreatefromjpeg($_SERVER["DOCUMENT_ROOT"].'/images/1/'.$picture['fileName']);
    }
    else{
        $image= imagecreatefrompng($_SERVER["DOCUMENT_ROOT"].'/images/1/'.$picture['fileName']);
    }

    $text_color = imagecolorallocate($image, 212, 30, 30);
    $font = $_SERVER["DOCUMENT_ROOT"].'/static/07558_CenturyGothic.ttf';
    $font_size = 28;
    $text = $picture['watermark'];
    imagettftext ($image, $font_size, 0, 40, 40, $text_color, $font, $text);

    if ($mime_type === 'image/jpeg'){
        imagejpeg($image, $_SERVER["DOCUMENT_ROOT"].'/images/2/'.$picture['fileName']);
    }
    else{
        imagepng($image, $_SERVER["DOCUMENT_ROOT"].'/images/2/'.$picture['fileName']);
    }
    
    imagedestroy($image);
}

function create_mini($picture, $mime_type){
    if ($mime_type === 'image/jpeg'){
        $image = imagecreatefromjpeg($_SERVER["DOCUMENT_ROOT"].'/images/1/'.$picture['fileName']);
    } else {
        $image = imagecreatefrompng($_SERVER["DOCUMENT_ROOT"].'/images/1/'.$picture['fileName']);
    }

    $thumbnail_width = 200;
    $thumbnail_height = 125;
    
    $thumbnail = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
    imagecopyresampled($thumbnail, $image, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, imagesx($image), imagesy($image));

    if ($mime_type === 'image/jpeg'){
        imagejpeg($thumbnail, $_SERVER["DOCUMENT_ROOT"].'/images/3/'.$picture['fileName']);
    } else {
        imagepng($thumbnail, $_SERVER["DOCUMENT_ROOT"].'/images/3/'.$picture['fileName']);
    }

    imagedestroy($image);
    imagedestroy($thumbnail);
}

?>