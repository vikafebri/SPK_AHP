<?php
$modul=isset($_GET['aksi']) ?$_GET['aksi'] : '';
include 'lib/kode_auto.php';
include 'lib/fungsi.php';

switch ($modul) {
	case "tampil":
	$sql_tampil = "select * from upa";
	$run_sql = mysql_query($sql_tampil);

	echo '
		<h4 class="widgettitle">
			<a class="btn btn-success" href="index2.php?modul='.$_GET['modul'].'&aksi=tambah">Tambah '.ucwords(str_replace("_"," ", $_GET['modul'])).'</a>
		</h4>
		<div class="clear"></div>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>NIP</th>
						<th>Nama</th>
						<th>Tempat/ Tgl Lahir</th>
						<th>Alamat</th>
						<th>Nomor Telp</th>
						<th>Jenis Kelamin</th>
						<th>Agama</th>
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
						<td>'.$data['nip'].'</td>
						<td>'.$data['nama'].'</td>
						<td>'.$data['tempat_lahir'].'/ '.tanggalindo($data['tanggal_lahir']).'</td>
						<td>'.$data['alamat'].'</td>
						<td>'.$data['nomor_telepon'].'</td>
						<td>'.$data['jenis_kelamin'].'</td>
						<td>'.$data['agama'].'</td>
						<td><a class="logdrop1" role="menuitem" tabindex="-1" href="index2.php?modul='.$_GET['modul'].'&aksi=edit&nip='.$data['nip'].'"><img src="images/edit.png"></a></td> 
						<td><a class="logdrop1" role="menuitem" tabindex="-1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=hapus&nip='.$data['nip'].'&photo='.$data['photo'].'"><img src="images/hapus.png"></a></td>
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
							<td><label>NIP</label></td>
							<td><input type="text" class="form-control" name="nip" required/></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Nama</label></td>
							<td><input type="text" class="form-control" name="nama" required/></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Tempat Lahir</label></td>
							<td><input type="text" class="form-control progress horizontal" name="tempat_lahir" required/></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Tanggal Lahir</label></td>
							<td><input type="date" class="form-control progress horizontal" name="tanggal_lahir" required/></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Alamat</label></td>
							<td><input type="text" class="form-control" name="alamat"></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Nomor Telepon</label></td>
							<td><input type="text" class="form-control" name="nomor_telepon" maxlength="12"></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Jenis Kelamin</label></td>
							<td>
								<input type="radio" class="form-control" name="jenis_kelamin" value="Laki-Laki"> Laki-Laki
								<input type="radio" class="form-control" name="jenis_kelamin" value="Perempuan"> Perempuan
							</td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Agama</label></td>';
							$agama = array('Islam', 'Kristen', 'Hindu', 'Budha', 'Konghuchu');
							echo'
							<td>
								<select name="agama" class="form-control" required/>
								<option selected value="">-- Silahkan Pilih --</option>';
									for ($i=0; $i<=4; $i++) {
										echo'
											<option value="'.$agama[$i].'">'.$agama[$i].'</option>
										';
									}
								echo'
								</select>
							</td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Photo</label></td>
							<td><input type="file" class="form-control" name="photo"></td>
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
	$sql_cek = "select * from upa where nip = '$_GET[nip]'";
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
							<td><label>NIP</label></td>
							<td>
								<input type="hidden" class="form-control" name="nip_awal" value="'.$data['nip'].'" required readonly/>
								<input type="text" class="form-control" name="nip" value="'.$data['nip'].'" required/>
							</td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Nama</label></td>
							<td><input type="text" class="form-control" name="nama" value="'.$data['nama'].'" required/></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Tempat Lahir</label></td>
							<td><input type="text" class="form-control progress horizontal" name="tempat_lahir" value="'.$data['tempat_lahir'].'" required/></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Tanggal Lahir</label></td>
							<td><input type="date" class="form-control progress horizontal" name="tanggal_lahir" value="'.$data['tanggal_lahir'].'" required/></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Alamat</label></td>
							<td><input type="text" class="form-control" name="alamat" value="'.$data['alamat'].'"></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Nomor Telepon</label></td>
							<td><input type="text" class="form-control" name="nomor_telepon" value="'.$data['nomor_telepon'].'" maxlength="12"></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Jenis Kelamin</label></td>
							<td>
								<input type="radio" class="form-control" name="jenis_kelamin" value="Laki-Laki"'; if ($data['jenis_kelamin']=='Laki-Laki') {echo'checked';}echo'> Laki-Laki
								<input type="radio" class="form-control" name="jenis_kelamin" value="Perempuan"'; if ($data['jenis_kelamin']=='Perempuan') {echo'checked';}echo'> Perempuan
							</td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Agama</label></td>';
							$agama = array('Islam', 'Kristen', 'Hindu', 'Budha', 'Konghuchu');
							echo'
							<td>
								<select name="agama" class="form-control" required/>
								<option selected value="'.$data['agama'].'">'.$data['agama'].'</option>';
									for ($i=0; $i<=4; $i++) {
										echo'
											<option value="'.$agama[$i].'">'.$agama[$i].'</option>
										';
									}
								echo'
								</select>
							</td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Photo</label></td>
							<td>
								<input type="hidden" class="form-control" name="foto" value="'.$data['photo'].'">
								<input type="file" class="form-control" name="photo">
							</td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td></td>
							<td><img src="'.$data['photo'].'" height="150" width="100"></td>
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