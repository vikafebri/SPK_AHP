<?php
include '../../config/koneksi.php';
include '../../lib/kode_auto.php';

$nip = $_POST['nip'];
$nama = $_POST['nama'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$alamat = $_POST['alamat'];
$nomor_telepon = $_POST['nomor_telepon'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$agama = $_POST['agama'];

//mengelolah data photo
$folder = "../../gambar/Kadis";
$folder_save = "gambar/Kadis";
$photo = $_FILES['photo']['tmp_name'];
$data_photo = $_FILES['photo']['name'];
$name = $folder."/".$_FILES["photo"]["name"];
$name_save = $folder_save."/".$_FILES["photo"]["name"];
$s = explode(".",$data_photo);
$s[0]=$nip;
$string_new_name = implode(".",$s);
$new_name = $folder_save."/".$string_new_name;

switch ($_GET['aksi'])
{
case "tambah";
	
	$sql1 = "insert into kadis (nip, nama, tempat_lahir, tanggal_lahir, alamat, nomor_telepon, jenis_kelamin, agama, photo)
			values ('$nip', '$nama', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$nomor_telepon', '$jenis_kelamin', '$agama', '$new_name')";
	$hasil1 = mysql_query($sql1);
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Kadis Sudah ditambahkan');
				document.location.href = '../../index2.php?modul=kadis&aksi=tampil'; </script>";
				move_uploaded_file($photo, $name);
				rename("../../".$name_save, "../../".$new_name);
		} else {
			echo "<script>alert('Periksa Data Yang Anda Masukkan!');
				document.location.href = '../../index2.php?modul=kadis&aksi=tampil'; </script>";
	}
break;

case "edit":
	$nip_awal = $_POST['nip_awal'];
	$foto = $_POST['foto'];
	$name_saved = $foto;$nip_awal = $_POST['nip_awal'];
	$foto = $_POST['foto'];
	$gambar = explode('/',$foto);
	$gambars = $gambar[2];
	$nama_gambar = explode('.',$gambars);
	$nama_gambar[0] = $nip;
	$nama_gambar_baru = implode(".",$nama_gambar);
	$nama_foto_baru = ''.$gambar[0].'/'.$gambar[1].'/'.$nama_gambar_baru.'';
	$name_saved = $foto;
	
	if(empty($data_photo)){
		$sql = "update kadis set nip = '$nip', nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir',
				alamat = '$alamat', nomor_telepon = '$nomor_telepon', jenis_kelamin = '$jenis_kelamin', agama = '$agama', 
				photo = '$nama_foto_baru' where nip = '$nip_awal'";
		$hasil = mysql_query($sql);
		if ($nip<>$nip_awal) {
			rename("../../".$foto, "../../".$nama_foto_baru);
		}
	}
	else if (!empty($data_photo)){
		$sql = "update kadis set nip = '$nip', nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir',
				alamat = '$alamat', nomor_telepon = '$nomor_telepon', jenis_kelamin = '$jenis_kelamin', agama = '$agama', 
				photo = '$new_name' where nip = '$nip_awal'";
		$hasil = mysql_query($sql);
		move_uploaded_file($photo, $name);
		if ($nip==$nip_awal) {
			rename("../../".$name_save, "../../".$name_saved);
		}else{
			rename("../../".$name_save, "../../".$new_name);
			unlink("../../".$name_saved);
		}
	}
	if ($hasil) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Kadis Sudah diedit');
				document.location.href = '../../index2.php?modul=kadis&aksi=tampil'; </script>";
		} else {
			echo "<script>alert('Periksa Kembali Data Yang Anda Masukkan!');
				document.location.href = '../../index2.php?modul=kadis&aksi=tampil'; </script>";
	}
break;

case "hapus":
	$sql1 = "delete from kadis where nip = '$_GET[nip]'";
	$hasil1 = mysql_query($sql1);
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Kadis Berhasil dihapus!');
				document.location.href = '../../index2.php?modul=kadis&aksi=tampil'; </script>";
				unlink("../../$_GET[photo]");
		} else {
			echo "<script>alert('Data gagal dihapus!');
				document.location.href = '../../index2.php?modul=kadis&aksi=tampil'; </script>";
	}
break;

}


?>

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="../../js/jquery.min.js" type="text/javascript"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="../../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
 
		<script language="javascript" type="text/javascript">
		  $(window).load(function() {
			$('#loading').hide();
		  });
		</script>