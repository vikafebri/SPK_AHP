<?php
$modul=isset($_GET['aksi']) ?$_GET['aksi'] : '';
include 'lib/kode_auto.php';
include 'lib/fungsi.php';

switch ($modul) {
	case "tampil":
	if ($_SESSION['status_login']=='Admin Sekolah') {
		$sql_tampil = "Select * from sekolah where id_sekolah = '".$_SESSION["id_sekolah"]."'";
		$run_sql = mysql_query($sql_tampil);
	}
	else {
		$sql_tampil = "Select * from sekolah";
		$run_sql = mysql_query($sql_tampil);
	}
	echo'
		<h4 class="widgettitle">
	';
	if ($_SESSION['status_login']=='Administrator') {
		echo'
			<a class="btn btn-success" href="index2.php?modul='.$_GET['modul'].'&aksi=tambah">Tambah '.ucwords(str_replace("_"," ", $_GET['modul'])).'</a>
		';				
	}
	else {
		echo'Profil Sekolah';
	}
		echo'
		</h4>
		<div class="clear"></div>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nomor</th>
						<th>ID Sekolah</th>
						<th>Sekolah</th>
						<th>Alamat Sekolah</th>
						<th>Nomor Telepon Sekolah</th>';
						if ($_SESSION['status_login']=='Kadis') {
							
						}
						else if ($_SESSION['status_login']=='Administrator') {
							echo'
							<th>Edit</th>
							<th>Hapus</th>
							';
						}
						else if ($_SESSION['status_login']=='Admin Sekolah') {
							echo'
							<th>Edit</th>
							';
						}
					echo'
					</tr>
				</thead>
				<tbody>';
				$no=1;	
					while ($data=mysql_fetch_array($run_sql)) {
					echo '
					<tr>
						<td>'.$no.'</td>
						<td>'.$data['id_sekolah'].'</td>
						<td>'.$data['nama_sekolah'].'</td>
						<td>'.$data['alamat_sekolah'].'</td>
						<td>'.$data['nomor_telepon_sekolah'].'</td>';
						if ($_SESSION['status_login']=='Kadis') {
							
						}
						else if ($_SESSION['status_login']=='Administrator') {
							echo'
							<td><a class="logdrop1" role="menuitem" tabindex="-1" href="index2.php?modul='.$_GET['modul'].'&aksi=edit&id_sekolah='.$data['id_sekolah'].'"><img src="images/edit.png"></a></td> 
							<td><a class="logdrop1" role="menuitem" tabindex="-1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=hapus&id_sekolah='.$data['id_sekolah'].'""><img src="images/hapus.png"></a></td>
							';
						}
						else if ($_SESSION['status_login']=='Admin Sekolah') {
							echo'
							<td><a class="logdrop1" role="menuitem" tabindex="-1" href="index2.php?modul='.$_GET['modul'].'&aksi=edit&id_sekolah='.$data['id_sekolah'].'"><img src="images/edit.png"></a></td> 
							';
						}
					echo'
					</tr>';
					$no++;
					}
				echo'
				</tbody>
			</table>
			';
	break;
	
	case "tambah":
	echo ' 
		
		<div class="col-md-12">
			<form role="form" enctype="multipart/form-data" action="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=tambah" method="post">
			<!-- general form elements disabled -->
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-edit"></i> '.ucwords(str_replace("_"," ", $_GET['aksi'])).' '.ucwords(str_replace("_", " ", $_GET['modul'])).'</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table table-bordered table-striped">
						<tr>
						<div class="form-group">
							<td><label>Id Sekolah</label></td>
							<td><input type="text" class="form-control" name="id_sekolah" value="'.kdauto('sekolah','Sekolah-').'" required readonly/></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Nama Sekolah</label></td>
							<td><input type="text" class="form-control" name="nama_sekolah" required/></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Alamat Sekolah</label></td>
							<td><input type="text" class="form-control" name="alamat_sekolah" required/></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Nomor Telepon Sekolah</label></td>
							<td><input type="text" class="form-control" name="nomor_telepon_sekolah" maxlength="12" required/></td>
						</div>
						</tr>
					</table>
					  <hr>
							<button type="submit" class="btn btn-success">Simpan</button>
							<button type="reset" class="btn btn-warning">Reset</button>
							<button type="button" class="btn btn-danger" onclick="self.history.back()" style="float:right;"><i class="fa fa-backward"></i> <span>Kembali</span></button>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	';
	break;
	
	case "edit":
	$sql = "Select * from sekolah where id_sekolah = '$_GET[id_sekolah]'";
	$run_sql = mysql_query($sql);
	$data = mysql_fetch_array($run_sql);
	echo ' 
		<div class="col-md-12">
			<form role="form" enctype="multipart/form-data" action="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=edit" method="post">
			<!-- general form elements disabled -->
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-edit"></i> '.ucwords(str_replace("_"," ", $_GET['aksi'])).' '.ucwords(str_replace("_", " ", $_GET['modul'])).'</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table table-bordered table-striped">
						<tr>
						<div class="form-group">
							<td><label>Kode Sekolah</label></td>
							<td><input type="text" class="form-control" name="id_sekolah" value="'.$data['id_sekolah'].'" required readonly/></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Nama Sekolah</label></td>
							<td><input type="text" class="form-control" name="nama_sekolah" value="'.$data['nama_sekolah'].'" required/></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Alamat Sekolah</label></td>
							<td><input type="text" class="form-control" name="alamat_sekolah" value="'.$data['alamat_sekolah'].'" required/></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Nomor Telepon Sekolah</label></td>
							<td><input type="text" class="form-control" name="nomor_telepon_sekolah" value="'.$data['nomor_telepon_sekolah'].'" maxlength="12" required/></td>
						</div>
						</tr>
					</table>
					  <hr>
							<button type="submit" class="btn btn-success">Simpan</button>
							<button type="reset" class="btn btn-warning">Reset</button>
							<button type="button" class="btn btn-danger" onclick="self.history.back()" style="float:right;"><i class="fa fa-backward"></i> <span>Kembali</span></button>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	';
break;
}
?>