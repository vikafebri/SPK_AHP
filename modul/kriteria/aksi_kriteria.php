<?php
include '../../config/koneksi.php';
include '../../lib/kode_auto.php';

$id_kriteria = $_POST['id_kriteria'];
$kriteria = $_POST['kriteria'];

switch ($_GET['aksi'])
{
case "tambah";
	
	$sql1 = "insert into kriteria (id_kriteria, kriteria, 'costbenefit')
			values ('$id_kriteria', '$kriteria', 'benefit')";
	$hasil1 = mysql_query($sql1);
	
	$field = "ALTER TABLE  `bobot_kriteria` ADD  `".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($kriteria))))))."` DOUBLE NOT NULL";
	$buat_field = mysql_query($field);
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Kriteria Sudah ditambahkan');
				document.location.href = '../../index2.php?modul=kriteria&aksi=tampil'; </script>";
				
		} else {
			echo "<script>alert('Periksa Data Kriteria Yang Anda Masukkan!');
				document.location.href = '../../index2.php?modul=kriteria&aksi=tampil'; </script>";
	}
break;

case "edit":
	$kriteria_sebelumnya = $_POST['kriteria_sebelumnya'];
	$sql1 = "update kriteria set id_kriteria = '$id_kriteria', kriteria = '$kriteria'
			where id_kriteria = '$id_kriteria'";
			
	$hasil1 = mysql_query($sql1);
	
	$field = "ALTER TABLE  `bobot_kriteria` CHANGE  `".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($kriteria_sebelumnya))))))."`  `".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($kriteria))))))."` DOUBLE NOT NULL";
	$edit_field = mysql_query($field);
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Kriteria Sudah diedit');
				document.location.href = '../../index2.php?modul=kriteria&aksi=tampil'; </script>";
		} else {
			echo "<script>alert('Periksa Data Yang Anda Masukkan!');
				document.location.href = '../../index2.php?modul=kriteria&aksi=tampil'; </script>";
	}
break;

case "hapus":
	
	$sql_kriteria = mysql_fetch_assoc(mysql_query("select kriteria from kriteria where id_kriteria= '$_GET[id_kriteria]'"));
	$kriteria = $sql_kriteria['kriteria'];
	
	$field= "ALTER TABLE  `bobot_kriteria` DROP  `".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($kriteria))))))."`";
	$hapus_field = mysql_query($field);
	
	$sql1 = "delete from kriteria where id_kriteria = '$_GET[id_kriteria]'";
	$hasil1 = mysql_query($sql1);
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Kriteria Berhasil dihapus!');
				document.location.href = '../../index2.php?modul=kriteria&aksi=tampil'; </script>";
		} else {
			echo "<script>alert('Data Kriteria gagal dihapus!');
				document.location.href = '../../index2.php?modul=kriteria&aksi=tampil'; </script>";
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