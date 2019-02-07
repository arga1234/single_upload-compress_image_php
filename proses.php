<?php
if(isset($_POST['upload'])){
 $new_name=time().'.jpg';
 $file='foto'; //name pada inputan type file
 $dir='image/';
 $width=400;//satuan dalam pixel / px
 UploadImageResize($new_name,$file,$dir,$width);
}

function UploadImageResize($new_name,$file,$dir,$width){
   //direktori gambar
   $vdir_upload = $dir;
   $vfile_upload = $vdir_upload . $_FILES[''.$file.'']["name"];

   //Simpan gambar dalam ukuran sebenarnya
   move_uploaded_file($_FILES[''.$file.'']["tmp_name"], $dir.$_FILES[''.$file.'']["name"]);

   //identitas file asli
   $im_src = imagecreatefromjpeg($vfile_upload);
   $src_width = imageSX($im_src);
   $src_height = imageSY($im_src);

   //Set ukuran gambar hasil perubahan
   $dst_width = $width;
   $dst_height = ($dst_width/$src_width)*$src_height;

   //proses perubahan ukuran
   $im = imagecreatetruecolor($dst_width,$dst_height);
   imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

   //Simpan gambar
   imagejpeg($im,$vdir_upload . $new_name,100);

   //Hapus gambar di memori komputer
   imagedestroy($im_src);
   imagedestroy($im);
   $remove_small = unlink("$vfile_upload");
 }
?>

<html>
<p>Upload and Compress Success, Check Your Folder File</p>
<html>
