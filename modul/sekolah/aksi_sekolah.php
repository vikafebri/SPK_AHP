<?php
include '../../config/koneksi.php';
include '../../lib/kode_auto.php';

$id_sekolah = $_POST['id_sekolah'];
$nama_sekolah = $_POST['nama_sekolah'];
$alamat_sekolah = $_POST['alamat_sekolah'];
$nomor_telepon_sekolah = $_POST['nomor_telepon_sekolah'];

switch ($_GET['aksi'])
{
case "tambah";
	
	$sql1 = "insert into sekolah (id_sekolah, nama_sekolah, alamat_sekolah, nomor_telepon_sekolah)
			values ('$id_sekolah', '$nama_sekolah', '$alamat_sekolah', '$nomor_telepon_sekolah')";
	$hasil1 = mysql_query($sql1);
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Sekolah Sudah ditambahkan');
				document.location.href = '../../index2.php?modul=sekolah&aksi=tampil'; </script>";
				
		} else {
			echo "<script>alert('Periksa Data Yang Anda Masukkan!');
				document.location.href = '../../index2.php?modul=sekolah&aksi=tampil'; </script>";
	}
break;

case "edit":
	$sql1 = "update sekolah set nama_sekolah = '$nama_sekolah', alamat_sekolah = '$alamat_sekolah', nomor_telepon_sekolah = '$nomor_telepon_sekolah'
			where id_sekolah = '$id_sekolah'";
			
	$hasil1 = mysql_query($sql1);
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Sekolah Sudah diedit');
				document.location.href = '../../index2.php?modul=sekolah&aksi=tampil'; </script>";
		} else {
			echo "<script>alert('Periksa Data Yang Anda Masukkan!');
				document.location.href = '../../index2.php?modul=sekolah&aksi=tampil'; </script>";
	}
break;

case "hapus":
	$sql1 = "delete from sekolah where id_sekolah = '$_GET[id_sekolah]'";
	$hasil1 = mysql_query($sql1);
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Sekolah Berhasil dihapus!');
				document.location.href = '../../index2.php?modul=sekolah&aksi=tampil'; </script>";
		} else {
			echo "<script>alert('Data gagal dihapus!');
				document.location.href = '../../index2.php?modul=sekolah&aksi=tampil'; </script>";
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