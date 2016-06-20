<?php
include '../../config/koneksi.php';
include '../../lib/kode_auto.php';

$id_sekolah = $_POST['id_sekolah'];

switch ($_GET['aksi'])
{
case "tambah";
				
				$dir = "../../gambar/galeri_sekolah/".$id_sekolah."";
				mkdir($dir);
				$foto = $_POST['foto'];
				$jumlah = count($foto);
				for ($i=0; $i<$jumlah; $i++) {
					//mengelolah surat photo
						$folders = "../../gambar/galeri_sekolah/".$id_sekolah."";
						$folder_saves = "gambar/galeri_sekolah/".$id_sekolah."";
						$file_photo = $_FILES['file_photo'.$i]['tmp_name'];
						$data_file_photo = $_FILES['file_photo'.$i]['name'];
						$names = $folders."/".$_FILES["file_photo".$i]["name"];
						$name_saves = $folder_saves."/".$_FILES["file_photo".$i]["name"];
						$ss = explode(".",$data_file_photo);
						$ss[0]=$i;
						$string_new_names = implode(".",$ss);
						$new_names = $folder_saves."/".$string_new_names;
						$process=mysql_query("insert into galeri_sekolah (id_sekolah, foto)
											values ('$id_sekolah', '$new_names')");
						move_uploaded_file($file_photo, $names);
						rename("../../".$name_saves, "../../".$new_names);
				}
		if ($process) {
			if ($error > 0) {
				echo "ERROR";
			}
				echo "<script>alert('Data Galeri Sekolah Berhasil Disimpan!');
				document.location.href = '../../index2.php?modul=galeri_sekolah&aksi=tampil'; </script>";
		} else {
			echo "<script>alert('Periksa Data Yang Anda Masukkan!');
				document.location.href = '../../index2.php?modul=galeri_sekolah&aksi=tampil'; </script>";
		}
break;

case "edit":
	$jumlah_data = $_POST['jumlah_data'];
		for ($i=0; $i<=$jumlah_data; $i++) {
			$id_sekolahip = $_POST['id_sekolahip'.$i];
			$foto_sebelumnya = $_POST['foto_sebelumnya'.$i];
			
			//mengelolah Data Photo
			$folders = "../../gambar/galeri_sekolah/".$id_sekolah."";
			$folder_saves = "gambar/galeri_sekolah/".$id_sekolah."";
			$file_photo = $_FILES['file_photo'.$i]['tmp_name'];
			$data_file_photo = $_FILES['file_photo'.$i]['name'];
			$names = $folders."/".$_FILES["file_photo".$i]["name"];
			$name_saves = $folder_saves."/".$_FILES["file_photo".$i]["name"];
			$ss = explode(".",$data_file_photo);
			$ss[0]=$i;
			$string_new_names = implode(".",$ss);
			$new_names = $folder_saves."/".$string_new_names;
			
			if(empty($data_file_photo)){
			$sql1 = "update galeri_sekolah set foto = '$foto_sebelumnya' 
					where id_sekolah = '$id_sekolahip'
					and foto = '$foto_sebelumnya'";
			$hasil1 = mysql_query($sql1);
			}
			else if (!empty($data_file_photo)){
				$sql1 = "update galeri_sekolah set foto = '$new_names' 
						where id_sekolah = '$id_sekolahip'
						and foto = '$foto_sebelumnya'";
				$hasil1 = mysql_query($sql1);
				move_uploaded_file($file_photo, $names);
				rename("../../".$name_saves, "../../".$new_names);
			}
		}
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Galeri Sekolah Sudah diedit!');
				document.location.href = '../../index2.php?modul=galeri_sekolah&aksi=tampil'; </script>";
		} else {
			echo "<script>alert('Periksa Kembali Data Yang Anda Masukkan!');
				document.location.href = '../../index2.php?modul=galeri_sekolah&aksi=tampil'; </script>";
	}
break;

case "hapus":
	$rm_photo = mysql_query("select * from galeri_sekolah where id_sekolah='$_GET[id_sekolah]'");
	
	while ($data_photo = mysql_fetch_array($rm_photo)) {
		unlink("../../".$data_photo['foto']."");
	}
	
	$sql1 = "delete from galeri_sekolah where id_sekolah = '$_GET[id_sekolah]'";
	$hasil1 = mysql_query($sql1);
	
	if ($hasil1) {
		if ($error > 0) {
			echo "ERROR";
		}
			echo "<script>alert('Data Galeri Sekolah Berhasil dihapus!');
				document.location.href = '../../index2.php?modul=galeri_sekolah&aksi=tampil'; </script>";
				$dir1 = "../../gambar/galeri_sekolah/".$_GET["id_sekolah"]."";
				rmdir($dir1);
		} else {
			echo "<script>alert('Data Galeri Sekolah gagal dihapus!');
				document.location.href = '../../index2.php?modul=galeri_sekolah&aksi=tampil'; </script>";
	}
break;

case "hapusperitem":
	$id_sekolah = $_GET['id_sekolah'];
	$foto = $_GET['foto'];
	
	$sql2 = mysql_query("delete from galeri_sekolah where id_sekolah='".$id_sekolah."' and foto='".$foto."'");
	unlink("../../".$foto."");
	
	$cek = mysql_num_rows(mysql_query("select * from galeri_sekolah where id_sekolah='$id_sekolah'"));
	$jumlah_data = ceil($cek);
	
	if ($jumlah_data == '0') {
		$dir1 = "../../gambar/galeri_sekolah/".$id_sekolah."";
		rmdir($dir1);
		if ($sql2) {
			if ($error > 0) {
				echo "ERROR";
			}
				echo "<script>alert('Data Galeri Sekolah Berhasil dihapus!');
					document.location.href = '../../index2.php?modul=galeri_sekolah&aksi=tampil'; </script>";
			} else {
				echo "<script>alert('Data Galeri Sekolah Gagal Dihapus!');
					document.location.href = '../../index2.php?modul=galeri_sekolah&aksi=tampil'; </script>";
			}
	}else {
		if ($sql2) {
			if ($error > 0) {
				echo "ERROR";
			}
			echo "<script>alert('Data Galeri Sekolah Berhasil dihapus!');
			document.location.href = '../../index2.php?modul=galeri_sekolah&aksi=edit&id_sekolah=".$id_sekolah."'; </script>";
		} else {
			echo "<script>alert('Data Galeri Sekolah Gagal Dihapus!');
			document.location.href = '../../index2.php?modul=galeri_sekolah&aksi=edit&id_sekolah=".$id_sekolah."'; </script>";
		}
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