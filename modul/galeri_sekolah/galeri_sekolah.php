<?php
$modul=isset($_GET['aksi']) ?$_GET['aksi'] : '';
include 'lib/kode_auto.php';
include 'lib/fungsi.php';

switch ($modul) {
	case "tampil":
	$sql_tampil = "Select a.*, b.* from sekolah a, galeri_sekolah b where a.id_sekolah = b.id_sekolah and a.id_sekolah='".$_SESSION["id_sekolah"]."' group by a.id_sekolah";
	$run_sql = mysql_query($sql_tampil);
	
	$cek_jum = mysql_num_rows(mysql_query("select * from galeri_sekolah where id_sekolah = '".$_SESSION['id_sekolah']."'"));
	$jumlah_galeri_sekolah = ceil($cek_jum);
	
	if ($jumlah_galeri_sekolah==0) {
		echo '
		<h4 class="widgettitle">
			<a class="btn btn-success" href="index2.php?modul='.$_GET['modul'].'&aksi=tambah">Tambah '.ucwords(str_replace("_"," ", $_GET['modul'])).'</a>
		</h4>';
	}else{
		echo '
		<h4 class="widgettitle">
			Kelolah Galeri Sekolah '.$data['nama_sekolah'].'
		</h4>
		';
	}
	echo'
		<div class="clear"></div>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nomor</th>
						<th>Sekolah</th>
						<th>Edit</th>
						<th>Hapus</th>
					</tr>
				</thead>
				<tbody>';
				$no=1;	
					while ($data=mysql_fetch_array($run_sql)) {
					echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$data['nama_sekolah'].'</td>
							<td><a class="logdrop1" role="menuitem" tabindex="-1" href="index2.php?modul='.$_GET['modul'].'&aksi=edit&id_sekolah='.$data['id_sekolah'].'"><img src="images/edit.png"></a></td>
							<td><a class="logdrop1" role="menuitem" tabindex="-1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=hapus&id_sekolah='.$data['id_sekolah'].'"><img src="images/hapus.png"></a></td>
						</tr>
					';
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
							<td><label>Photo</label></td>
							<td>
								<input type="hidden" class="form-control" name="id_sekolah" value="'.$_SESSION['id_sekolah'].'" readonly required/>
								<input type="hidden" class="form-control progress horizontal file" name="foto[]"/>
								<input type="file" class="form-control progress horizontal file" name="file_photo0"/>
								<a style="display:inline; float:right;" class="btn btn-success" href="javascript:action();" title="Tambah Photo">Tambah</a>
								<br><br>
								<div id="input0">
							</td>
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
	$sql_cek = "Select * from galeri_sekolah where id_sekolah = '$_GET[id_sekolah]'";
	$run_sql_cek = mysql_query($sql_cek);
	$data = mysql_fetch_array($run_sql_cek);
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
							<td><label>Nomor Registrasi</label></td>
							<td><input type="text" class="form-control progress horizontal" name="id_sekolah" value="'.$data['id_sekolah'].'" required readonly/></td>
						</div>
						</tr>
						<tr>
							<td colspan=2>
								<div class="box-group" id="accordion">
								<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
								<div class="panel box box-primary">
									<div class="box-header">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="">
											<small style="color:white">Photo</small>
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse in" style="height: auto;">
										<div class="box-body">
											<table class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>Photo</th>
														<th>Edit Photo</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>';
													$no=1;
													$photo = mysql_query("select a.* from galeri_sekolah a, sekolah b where a.id_sekolah = b.id_sekolah and b.id_sekolah = '$_GET[id_sekolah]'");
													while ($data_photo=mysql_fetch_array($photo)) {
													echo '
													<tr>
														<td>
															<input type="hidden" class="form-control" name="id_sekolahip'.($no-1).'" value="'.$data_photo['id_sekolah'].'" readonly/>
															<img src="'.$data_photo['foto'].'" width="150" height="100">
														</td>
														<td>
															<input type="hidden" class="form-control" name="foto_sebelumnya'.($no-1).'" value="'.$data_photo['foto'].'" readonly/>
															<input type="file" class="form-control" name="file_photo'.($no-1).'">
														</td>
														<td><a class="logdrop1" role="menuitem" tabindex="-1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=hapusperitem&id_sekolah='.$data_photo['id_sekolah'].'&foto='.$data_photo['foto'].'"><img src="images/hapus.png"></a></td>
													</tr>';
													$no++;
													}
												echo'
												</tbody>
											</table>';
											$x = $no-2;
											echo'
											<input type="hidden" name="jumlah_data" value="'.$x.'">
										</div>
									</div>
								</div> 
							</td>
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