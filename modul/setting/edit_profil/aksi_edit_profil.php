<?php
session_start();
?>
<!-- bootstrap 3.0.2 -->
<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />


<style>
#loading {
  width: 100%;
  height: 100%;
  top: 0px;
  left: 0px;
  position: fixed;
  display: block;
  opacity: 0.7;
  background-color: #fff;
  z-index: 99;
  text-align: center;
}

#loading-image {
  position: absolute;
 top: 200px;
 left: 630px;
  z-index: 100;
}

</style>
<?php
include '../../../config/koneksi.php';

$id = $_POST['id'];
$username = $_POST['username_lama'];
$konfirm_password_baru = $_POST['konfirm_password_baru'];
$nama = $_POST['nama'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$agama = $_POST['agama'];
$gambar_edit = $_POST['gambar_edit'];
//mengelolah data gambar
if ($_SESSION['status_login']=='Administrator') {
	$folder = "../../../gambar/Admin";
	$folder_save = "gambar/Admin";
	$tabel='admin';
}
if ($_SESSION['status_login']=='Kadis') {
	$folder = "../../../gambar/Kadis";
	$folder_save = "gambar/Kadis";
	$tabel='kadis';
}
if ($_SESSION['status_login']=='UPA') {
	$folder = "../../../gambar/UPA";
	$folder_save = "gambar/UPA";
	$tabel='upa';
}
if ($_SESSION['status_login']=='Admin Sekolah') {
	$folder = "../../../gambar/Admin_Sekolah";
	$folder_save = "gambar/Admin_Sekolah";
	$tabel='admin_sekolah';
}
	$gambar = $_FILES['gambar']['tmp_name'];
	$data_gambar = $_FILES['gambar']['name'];
	$name = $folder."/".$_FILES["gambar"]["name"];
	$name_save = $folder_save."/".$_FILES["gambar"]["name"];
	$s = explode(".",$data_gambar);
	$s[0]=$id;
	$string_new_name = implode(".",$s);
	$new_name = $folder_save."/".$string_new_name;

switch ($_GET['aksi'])
{
case "edit";
	$sql1 = "update hak_akses set username = '$username', password = '$konfirm_password_baru' where id='$id'";
	$hasil1=mysql_query($sql1);
	if ($_SESSION['status_login']=='Administrator') {
		if(empty($gambar)){
		$sql = "update ".$tabel." set nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', alamat = '$alamat', nomor_telepon = '$no_telp', jenis_kelamin = '$jenis_kelamin', agama = '$agama', photo = '$gambar_edit' where id = '$id'";
		$hasil = mysql_query($sql);
		}
		else if (!empty($gambar)){
			$sql = "update ".$tabel." set nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', alamat = '$alamat', nomor_telepon = '$no_telp', jenis_kelamin = '$jenis_kelamin', agama = '$agama', photo = '$new_name' where id = '$id'";
			$hasil = mysql_query($sql);
			move_uploaded_file($gambar, $name);
			rename("../../../".$name_save, "../../../".$new_name);
		}
	}
	if ($_SESSION['status_login']=='Kadis') {
		if(empty($gambar)){
		$sql = "update ".$tabel." set nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', alamat = '$alamat', nomor_telepon = '$no_telp', jenis_kelamin = '$jenis_kelamin', agama = '$agama', photo = '$gambar_edit' where nip = '$id'";
		$hasil = mysql_query($sql);
		}
		else if (!empty($gambar)){
			$sql = "update ".$tabel." set nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', alamat = '$alamat', nomor_telepon = '$no_telp', jenis_kelamin = '$jenis_kelamin', agama = '$agama', photo = '$new_name' where nip = '$id'";
			$hasil = mysql_query($sql);
			move_uploaded_file($gambar, $name);
			rename("../../../".$name_save, "../../../".$new_name);
		}
	}
	if ($_SESSION['status_login']=='UPA') {
		if(empty($gambar)){
		$sql = "update ".$tabel." set nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', alamat = '$alamat', nomor_telepon = '$no_telp', jenis_kelamin = '$jenis_kelamin', agama = '$agama', photo = '$gambar_edit' where nip = '$id'";
		$hasil = mysql_query($sql);
		}
		else if (!empty($gambar)){
			$sql = "update ".$tabel." set nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', alamat = '$alamat', nomor_telepon = '$no_telp', jenis_kelamin = '$jenis_kelamin', agama = '$agama', photo = '$new_name' where nip = '$id'";
			$hasil = mysql_query($sql);
			move_uploaded_file($gambar, $name);
			rename("../../../".$name_save, "../../../".$new_name);
		}
	}
	if ($_SESSION['status_login']=='Admin Sekolah') {
		if(empty($gambar)){
		$sql = "update ".$tabel." set nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', alamat = '$alamat', nomor_telepon = '$no_telp', jenis_kelamin = '$jenis_kelamin', agama = '$agama', photo = '$gambar_edit' where nip = '$id'";
		$hasil = mysql_query($sql);
		}
		else if (!empty($gambar)){
			$sql = "update ".$tabel." set nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', alamat = '$alamat', nomor_telepon = '$no_telp', jenis_kelamin = '$jenis_kelamin', agama = '$agama', photo = '$new_name' where nip = '$id'";
			$hasil = mysql_query($sql);
			move_uploaded_file($gambar, $name);
			rename("../../../".$name_save, "../../../".$new_name);
		}
	}
	
	if ($hasil1&&$hasil) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Profil Berhasil diedit, Silahkan login kembali dengan account baru anda!');
				document.location.href = '../../../logout.php'; </script>";
		} else {
			echo "<script>alert('Profil Gagal diedit!');
				document.location.href = '../../../logout.php'; </script>";
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