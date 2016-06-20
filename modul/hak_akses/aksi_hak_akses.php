<?php
include '../../config/koneksi.php';
include '../../lib/kode_auto.php';

$nip = $_GET['nip'];
$hak_akses = $_GET['hak_akses'];

switch ($_GET['aksi'])
{
case "aktifkan":	
	$sql1 = "insert into hak_akses (username, password, hak_akses, id)
			values('$nip', '$nip', '$hak_akses', '$nip')";
	$hasil1 = mysql_query($sql1);
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Hak Akses Telah diaktifkan!');
				document.location.href = '../../index2.php?modul=hak_akses&aksi=tampil'; </script>";
		} else {
			echo "<script>alert('Hak Akses Gagal diaktifkan!');
				document.location.href = '../../index2.php?modul=hak_akses&aksi=tampil'; </script>";
	}
break;

case "nonaktifkan":
	$sql1 = "delete from hak_akses where id='$nip'";
	$hasil1 = mysql_query($sql1);
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Hak Akses Telah dinonaktifkan!');
				document.location.href = '../../index2.php?modul=hak_akses&aksi=tampil'; </script>";
		} else {
			echo "<script>alert('Hak Akses Gagal dinonaktifkan!');
				document.location.href = '../../index2.php?modul=hak_akses&aksi=tampil'; </script>";
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