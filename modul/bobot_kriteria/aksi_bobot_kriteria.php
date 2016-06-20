<?php
include '../../config/koneksi.php';
include '../../lib/kode_auto.php';

switch ($_GET['aksi'])
{
case "tambah";
	$pakar = kdauto('bobot_kriteria','Pakar-');
	$tambah = mysql_query("insert into bobot_kriteria (pakar) values('$pakar')");
	
	$array_kriteria = array();
	$kriteria = mysql_query("select * from kriteria order by id_kriteria");
	$jum_kriteria = mysql_num_rows($kriteria);
	$jumlah_kriteria = (ceil($jum_kriteria))-1;
	while ($data_kriteria = mysql_fetch_array($kriteria)) {
	$array_kriteria[] = $data_kriteria['kriteria'];
	}
	for ($i=0; $i<=$jumlah_kriteria; $i++) {
		$bobot_kriteria = $_POST['bobot_kriteria'.$i];
		$sql1 = "update bobot_kriteria set ".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($array_kriteria[$i]))))))." = '".$bobot_kriteria."' where pakar='".$pakar."'";
		$hasil1 = mysql_query($sql1); 
	}
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Bobot Kriteria Sudah ditambahkan');
				document.location.href = '../../index2.php?modul=bobot_kriteria&aksi=tampil'; </script>";
				
		} else {
			echo "<script>alert('Periksa Data Bobot Kriteria Yang Anda Masukkan!');
				document.location.href = '../../index2.php?modul=bobot_kriteria&aksi=tampil'; </script>";
	}
break;

case "edit":
	$pakar = $_POST['pakar'];
	$array_kriteria = array();
	$kriteria = mysql_query("select * from kriteria order by id_kriteria");
	$jum_kriteria = mysql_num_rows($kriteria);
	$jumlah_kriteria = (ceil($jum_kriteria))-1;
	while ($data_kriteria = mysql_fetch_array($kriteria)) {
	$array_kriteria[] = $data_kriteria['kriteria'];
	}
	for ($i=0; $i<=$jumlah_kriteria; $i++) {
		$bobot_kriteria = $_POST['bobot_kriteria'.$i];
		$sql1 = "update bobot_kriteria set ".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($array_kriteria[$i]))))))." = '".$bobot_kriteria."' where pakar = '".$pakar."'";
		$hasil1 = mysql_query($sql1); 
	}
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Bobot Kriteria Sudah diedit');
				document.location.href = '../../index2.php?modul=bobot_kriteria&aksi=tampil'; </script>";
				
		} else {
			echo "<script>alert('Periksa Data Bobot Kriteria Yang Anda Masukkan!');
				document.location.href = '../../index2.php?modul=bobot_kriteria&aksi=tampil'; </script>";
	}
break;

case "hapus":
	
	$sql1 = "delete from bobot_kriteria where pakar = '$_GET[pakar]'";
	$hasil1 = mysql_query($sql1);
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Bobot Kriteria Berhasil dihapus!');
				document.location.href = '../../index2.php?modul=bobot_kriteria&aksi=tampil'; </script>";
		} else {
			echo "<script>alert('Data Bobot Kriteria gagal dihapus!');
				document.location.href = '../../index2.php?modul=bobot_kriteria&aksi=tampil'; </script>";
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