<?php
include '../../config/koneksi.php';
include '../../lib/kode_auto.php';

$id_alternatif = $_POST['id_alternatif'];
$alternatif = $_POST['alternatif'];

switch ($_GET['aksi'])
{
case "tambah";
	
	$sql1 = "insert into alternatif (id_alternatif, alternatif)
			values ('$id_alternatif', '$alternatif')";
	$hasil1 = mysql_query($sql1);
	
	$field = "ALTER TABLE  `bobot_alternatif` ADD  `".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($alternatif))))))."` DOUBLE NOT NULL";
	$buat_field = mysql_query($field);
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Alternatif Sudah ditambahkan');
				document.location.href = '../../index2.php?modul=alternatif&aksi=tampil'; </script>";
				
		} else {
			echo "<script>alert('Periksa Data Alternatif Yang Anda Masukkan!');
				document.location.href = '../../index2.php?modul=alternatif&aksi=tampil'; </script>";
	}
break;

case "edit":
	$alternatif_sebelumnya = $_POST['alternatif_sebelumnya'];
	$sql1 = "update alternatif set id_alternatif = '$id_alternatif', alternatif = '$alternatif'
			where id_alternatif = '$id_alternatif'";
			
	$hasil1 = mysql_query($sql1);
	
	$field = "ALTER TABLE  `bobot_alternatif` CHANGE  `".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($alternatif_sebelumnya))))))."`  `".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($alternatif))))))."` DOUBLE NOT NULL";
	$edit_field = mysql_query($field);
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Alternatif Sudah diedit');
				document.location.href = '../../index2.php?modul=alternatif&aksi=tampil'; </script>";
		} else {
			echo "<script>alert('Periksa Data Alternatif Yang Anda Masukkan!');
				document.location.href = '../../index2.php?modul=alternatif&aksi=tampil'; </script>";
	}
break;

case "hapus":
	$sql_alternatif = mysql_fetch_assoc(mysql_query("select alternatif from alternatif where id_alternatif= '$_GET[id_alternatif]'"));
	$alternatif = $sql_alternatif['alternatif'];
	
	$field= "ALTER TABLE  `bobot_alternatif` DROP  `".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($alternatif))))))."`";
	$hapus_field = mysql_query($field);
	
	$sql1 = "delete from alternatif where id_alternatif = '$_GET[id_alternatif]'";
	$hasil1 = mysql_query($sql1);
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Alternatif Berhasil dihapus!');
				document.location.href = '../../index2.php?modul=alternatif&aksi=tampil'; </script>";
		} else {
			echo "<script>alert('Data Alternatif gagal dihapus!');
				document.location.href = '../../index2.php?modul=alternatif&aksi=tampil'; </script>";
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