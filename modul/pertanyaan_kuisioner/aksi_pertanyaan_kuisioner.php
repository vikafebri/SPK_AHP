<?php
include '../../config/koneksi.php';
include '../../lib/kode_auto.php';

$id_kriteria = $_POST['id_kriteria'];
$id_pertanyaan = $_POST['id_pertanyaan'];
$pertanyaan = $_POST['pertanyaan'];
$nilai = $_POST['nilai'];

$kriteria = mysql_fetch_assoc(mysql_query("select * from kriteria where id_kriteria = '$id_kriteria'"));
$nama_kriteria = $kriteria['kriteria'];;

switch ($_GET['aksi'])
{
case "tambah";
	$alternatif = mysql_query("select * from alternatif order by id_alternatif");
	$jum_al = mysql_num_rows($alternatif);
	$jumlah_alternatif = ceil($jum_al);
	
	if ($nama_kriteria == 'Bobot BAN-S/M') {
		for ($g=1;$g<=$jumlah_alternatif;$g++) {
			$id_pertanyaann = kdauto('pertanyaan_kuisioner','Pertanyaan-');
			$pertanyaann = $_POST['pertanyaan'.$g];
			$nilaii = $_POST['nilai'.$g];
			
			$sql1 = "insert into pertanyaan_kuisioner (id_pertanyaan, id_kriteria, pertanyaan, nilai)
				values ('$id_pertanyaann', '$id_kriteria', '$pertanyaann', '$nilaii')";
			$hasil1 = mysql_query($sql1);
		}	
	}
	else {
		$sql1 = "insert into pertanyaan_kuisioner (id_pertanyaan, id_kriteria, pertanyaan, nilai)
			values ('$id_pertanyaan', '$id_kriteria', '$pertanyaan', '$nilai')";
		$hasil1 = mysql_query($sql1);
	}
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Pertanyaan Kuisioner Sudah ditambahkan');
				document.location.href = '../../index2.php?modul=pertanyaan_kuisioner&aksi=tampil'; </script>";
				
		} else {
			echo "<script>alert('Periksa Data Yang Anda Masukkan!');
				document.location.href = '../../index2.php?modul=pertanyaan_kuisioner&aksi=tampil'; </script>";
		}
break;

case "edit":
	$jumlah = $_POST['jumlah'];
	for ($i=1; $i<=$jumlah; $i++) {
		$id_pertanyaan = $_POST['id_pertanyaan'.$i];
		$pertanyaan = $_POST['pertanyaan'.$i];
		$nilai = $_POST['nilai'.$i];
		$sql1 = "update pertanyaan_kuisioner set pertanyaan = '$pertanyaan', nilai = '$nilai'
				where id_pertanyaan = '$id_pertanyaan'";
		$hasil1 = mysql_query($sql1);
	}
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Pertanyaan Kuisioner Berhasil diedit!');
				document.location.href = '../../index2.php?modul=pertanyaan_kuisioner&aksi=tampil'; </script>";
		} else {
			echo "<script>alert('Data Pertanyaan Kuisioner gagal diedit!');
				document.location.href = '../../index2.php?modul=pertanyaan_kuisioner&aksi=tampil'; </script>";
	}
break;

case "hapus_satu_pertanyaan":
	$sql1 = "delete from pertanyaan_kuisioner where id_pertanyaan = '$_GET[id_pertanyaan]'";
	$hasil1 = mysql_query($sql1);
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Pertanyaan Kuisioner Berhasil dihapus!');
				document.location.href = '../../index2.php?modul=pertanyaan_kuisioner&aksi=edit&id_kriteria=".$_GET['id_kriteria']."'; </script>";
		} else {
			echo "<script>alert('Data Pertanyaan Kuisioner gagal dihapus!');
				document.location.href = '../../index2.php?modul=pertanyaan_kuisioner&aksi=edit&id_kriteria=".$_GET['id_kriteria']."'; </script>";
	}
break;

case "hapus":
	$sql1 = "delete from pertanyaan_kuisioner where id_kriteria = '$_GET[id_kriteria]'";
	$hasil1 = mysql_query($sql1);
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Pertanyaan Kuisioner Berhasil dihapus!');
				document.location.href = '../../index2.php?modul=pertanyaan_kuisioner&aksi=tampil'; </script>";
		} else {
			echo "<script>alert('Data Pertanyaan Kuisioner gagal dihapus!');
				document.location.href = '../../index2.php?modul=pertanyaan_kuisioner&aksi=tampil'; </script>";
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