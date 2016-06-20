<?php
include '../../config/koneksi.php';
include '../../lib/kode_auto.php';

switch ($_GET['aksi'])
{
case "tambah";
	$id_kriteria = $_POST['id_kriteria'];
	$tambah = mysql_query("insert into bobot_alternatif (id_kriteria) values('$id_kriteria')");
	
	$array_alternatif = array();
	$alternatif = mysql_query("select * from alternatif order by id_alternatif");
	$jum_alternatif = mysql_num_rows($alternatif);
	$jumlah_alternatif = (ceil($jum_alternatif))-1;
	while ($data_alternatif = mysql_fetch_array($alternatif)) {
	$array_alternatif[] = $data_alternatif['alternatif'];
	}
	for ($i=0; $i<=$jumlah_alternatif; $i++) {
		$bobot_alternatif = $_POST['bobot_alternatif'.$i];
		$sql1 = "update bobot_alternatif set ".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($array_alternatif[$i]))))))." = '".$bobot_alternatif."' where id_kriteria='".$id_kriteria."'";
		$hasil1 = mysql_query($sql1); 
	}
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Bobot alternatif Sudah ditambahkan');
				document.location.href = '../../index2.php?modul=bobot_alternatif&aksi=tampil'; </script>";
				
		} else {
			echo "<script>alert('Periksa Data Bobot alternatif Yang Anda Masukkan!');
				document.location.href = '../../index2.php?modul=bobot_alternatif&aksi=tampil'; </script>";
	}
break;

case "edit":
	$id_kriteria = $_POST['id_kriteria'];
	$array_alternatif = array();
	$alternatif = mysql_query("select * from alternatif order by id_alternatif");
	$jum_alternatif = mysql_num_rows($alternatif);
	$jumlah_alternatif = (ceil($jum_alternatif))-1;
	while ($data_alternatif = mysql_fetch_array($alternatif)) {
	$array_alternatif[] = $data_alternatif['alternatif'];
	}
	for ($i=0; $i<=$jumlah_alternatif; $i++) {
		$bobot_alternatif = $_POST['bobot_alternatif'.$i];
		$sql1 = "update bobot_alternatif set ".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($array_alternatif[$i]))))))." = '".$bobot_alternatif."' where id_kriteria = '".$id_kriteria."'";
		$hasil1 = mysql_query($sql1); 
	}
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Bobot alternatif Sudah diedit');
				document.location.href = '../../index2.php?modul=bobot_alternatif&aksi=tampil'; </script>";
				
		} else {
			echo "<script>alert('Periksa Data Bobot alternatif Yang Anda Masukkan!');
				document.location.href = '../../index2.php?modul=bobot_alternatif&aksi=tampil'; </script>";
	}
break;

case "hapus":
	
	$sql1 = "delete from bobot_alternatif where id_kriteria = '$_GET[id_kriteria]'";
	$hasil1 = mysql_query($sql1);
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Bobot alternatif Berhasil dihapus!');
				document.location.href = '../../index2.php?modul=bobot_alternatif&aksi=tampil'; </script>";
		} else {
			echo "<script>alert('Data Bobot alternatif gagal dihapus!');
				document.location.href = '../../index2.php?modul=bobot_alternatif&aksi=tampil'; </script>";
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