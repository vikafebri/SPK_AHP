<?php
$modul=isset($_GET['aksi']) ?$_GET['aksi'] : '';
include 'lib/kode_auto.php';
include 'lib/fungsi.php';

switch ($modul) {
	case "tampil":
	$sql_tampil = "Select * from kriteria order by id_kriteria";
	$run_sql = mysql_query($sql_tampil);

	echo '
		<h4 class="widgettitle">
			<a class="btn btn-success" href="index2.php?modul='.$_GET['modul'].'&aksi=tambah">Tambah '.ucwords(str_replace("_"," ", $_GET['modul'])).'</a>
		</h4>
		<div class="clear"></div>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nomor</th>
						<th>ID Kriteria</th>
						<th>Kriteria</th>
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
						<td>'.$data['id_kriteria'].'</td>
						<td>'.$data['kriteria'].'</td>
						<td><a class="logdrop1" role="menuitem" tabindex="-1" href="index2.php?modul='.$_GET['modul'].'&aksi=edit&id_kriteria='.$data['id_kriteria'].'"><img src="images/edit.png"></a></td> 
						<td><a class="logdrop1" role="menuitem" tabindex="-1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=hapus&id_kriteria='.$data['id_kriteria'].'""><img src="images/hapus.png"></a></td>
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
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-edit"></i> '.ucwords(str_replace("_"," ", $_GET['aksi'])).' '.ucwords(str_replace("_", " ", $_GET['modul'])).'</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table table-bordered table-striped">
						<tr>
						<div class="form-group">
							<td><label>ID Kriteria</label></td>
							<td><input type="text" class="form-control" name="id_kriteria" value="'.kdauto('kriteria','Kriteria-').'" required readonly/></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Kriteria</label></td>
							<td><input type="text" class="form-control" name="kriteria" required/></td>
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
	$sql = "Select * from kriteria where id_kriteria = '$_GET[id_kriteria]'";
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
							<td><label>ID Kriteria</label></td>
							<td><input type="text" class="form-control" name="id_kriteria" value="'.$data['id_kriteria'].'" required readonly/></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Kriteria</label></td>
							<td>
								<input type="hidden" class="form-control" name="kriteria_sebelumnya" value="'.$data['kriteria'].'" required readonly/>
								<input type="text" class="form-control" name="kriteria" value="'.$data['kriteria'].'" required/>
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
}
?>