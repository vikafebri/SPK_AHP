<?php
$modul=isset($_GET['aksi']) ?$_GET['aksi'] : '';
include 'lib/kode_auto.php';
include 'lib/fungsi.php';

switch ($modul) {
	case "tampil":
	$sql_tampil = "Select a.id_pertanyaan, a.id_kriteria, group_concat(a.pertanyaan order by a.id_pertanyaan ASC) as pertanyaan, group_concat(a.nilai order by a.id_pertanyaan ASC) as nilai, b.kriteria from pertanyaan_kuisioner a, kriteria b where a.id_kriteria=b.id_kriteria group by a.id_kriteria";
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
						<th>Kriteria</th>
						<th>Pertanyaan Kuisioner</th>
						<th>Nilai</th>
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
						<td>'.$data['kriteria'].'</td>
						<td><li>'.str_replace(",","<li>",$data['pertanyaan']).'</td>
						<td><li>'.str_replace(",","<li>",$data['nilai']).'</td>
						<td>';
							if ($data['kriteria'] == 'Bobot BAN-S/M') {
								echo'
								-
								';
							}else {
								echo'
								<a class="logdrop1" role="menuitem" tabindex="-1" href="index2.php?modul='.$_GET['modul'].'&aksi=edit&id_kriteria='.$data['id_kriteria'].'"><img src="images/edit.png"></a>
								';
							}
						echo'
						</td> 
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
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-edit"></i> '.ucwords(str_replace("_"," ", $_GET['aksi'])).' '.ucwords(str_replace("_", " ", $_GET['modul'])).'</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table table-bordered table-striped">
						<tr>
						<div class="form-group">
							<td><label>ID Pertanyaan</label></td>
							<td colspan="3"><input type="text" class="form-control" name="id_pertanyaan" value="'.kdauto('pertanyaan_kuisioner','Pertanyaan-').'" required readonly/></td>
						</div>
						</tr>
						<tr>
						<div class="form-group">
							<td><label>Kriteria</label></td>
							<td colspan="3">
							<select class="form-control" name="id_kriteria" id="id_kriteria" required/>
								<option selected value="">--Silahkan Pilih--</option>
							';
								$cek_pertanyaan_bobot = mysql_fetch_assoc(mysql_query("select count(id_kriteria) as jumlah_pertanyaan_bobot from pertanyaan_kuisioner where id_kriteria = 'Kriteria-04'"));
								$jumlah_pertanyaan_bobot = $cek_pertanyaan_bobot['jumlah_pertanyaan_bobot'];
								if ($jumlah_pertanyaan_bobot==0) {
									$tampil_bagian = mysql_query("select * from kriteria order by id_kriteria");
								}else {
									$tampil_bagian = mysql_query("select * from kriteria where id_kriteria<>'Kriteria-04' order by id_kriteria");
								}
								while($data_bagian = mysql_fetch_array($tampil_bagian)) {
									echo'<option value="'.$data_bagian['id_kriteria'].'">'.$data_bagian['kriteria'].'</option>
									';
								}
								echo'
							</select>
							</td>
						</div>
						</tr>';
						$array_alternatif = array();
						$alternatif = mysql_query("select * from alternatif order by id_alternatif");
						while ($data_alternatif = mysql_fetch_array($alternatif)) {
									$array_alternatif[] = $data_alternatif['alternatif'];
						}
						$n = array();
						for ($l=0;$l<count($array_alternatif);$l++)
						{
							$o = 0;
							$ba[$l] = mysql_query("select ".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($array_alternatif[$l]))))))." from bobot_alternatif");
							while($dba[$l] = mysql_fetch_array($ba[$l])) {
								$ddba[$l][$o] = $dba[$l][''.str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($array_alternatif[$l])))))).''];
								$n[$l][$o] = $ddba[$l][$o];
							$o++;
							}
						}
						$pakar = mysql_query("select pakar from bobot_kriteria order by pakar");
						$jum_pakar = mysql_num_rows($pakar);
						$jumlah_pakar = (ceil($jum_pakar))-1;
						$kriteria2 = mysql_query("select * from kriteria order by id_kriteria");
						$eigen_kriteria = array();
						while ($data_kriteria2=mysql_fetch_array($kriteria2)) {
							$jum_bobot = mysql_fetch_assoc(mysql_query("select sum(".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($data_kriteria2['kriteria'])))))).") as jumlah_bobot from bobot_kriteria"));
							$jumlah_bobot = $jum_bobot['jumlah_bobot'];
							$rata_rata_eigen = $jumlah_bobot/($jumlah_pakar+1);
							$eigen_kriteria[] = $rata_rata_eigen;
						}
						echo'
						<tr>
						<div class="form-group">
							<td height="50px"><label>Pertanyaan Kuisioner</label></td>
							<td>
								<input type="text" class="form-control progress vertical panjang" name="pertanyaan" id="pertanyaan" required/>';
								for ($g=0;$g<count($array_alternatif);$g++){
									echo'
									<div class="form-group">
										<input type="hidden" class="form-control progress vertical panjang" name="pertanyaan'.($g+1).'" id="pertanyaan'.$g.'" value="Standar '.($g+1).'" required readonly/>
									</div>
									';
								}
							echo'							
							</td>
							<td><label>Nilai</label></td>
							<td>
								<input type="text" class="form-control" name="nilai" id="nilai" required/>';
								$bg = array();
								for ($l=0;$l<count($array_alternatif);$l++){
									$bg[$l] = 0;
									for ($o=0;$o<count($array_alternatif);$o++){			
										$bg[$l] += $n[$l][$o] * $eigen_kriteria[$o];
									}
									echo'
									<div class="form-group">
										<input type="hidden" class="form-control" name="nilai'.($l+1).'" id="nilai'.$l.'" value="'.$bg[$l].'" required readonly/>
									</div>
									';
								}
							echo'
								<small>* untuk , dibilangan decimal diganti dengan .</small>
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
	$sql1 = "select * from kriteria where id_kriteria = '$_GET[id_kriteria]'";
	$sql2 = "Select * from pertanyaan_kuisioner where id_kriteria = '$_GET[id_kriteria]' order by id_pertanyaan";
	$run_sql1 = mysql_query($sql1);
	$run_sql2 = mysql_query($sql2);
	$data_kriteria = mysql_fetch_array($run_sql1);
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
							<td><label>Kriteria</label></td>
							<td colspan="4">
							<input type="text" class="form-control" name="kriteria" value="'.$data_kriteria['kriteria'].'" required readonly/>
							</td>
						</div>
						</tr>';
								$no = 1;
									while ($data_pertanyaan = mysql_fetch_array($run_sql2)) {
										echo'
										<tr>
											<div class="form-group">
												<td><label>Pertanyaan</label></td>
												<td>
													<input type="hidden" class="form-control progress vertical panjang" name="id_pertanyaan'.$no.'" value="'.$data_pertanyaan['id_pertanyaan'].'"> <input type="text" class="form-control" name="pertanyaan'.$no.'" value="'.$data_pertanyaan['pertanyaan'].'">
												</td>
											</div>
											<div class="form-group">
												<td><label>Nilai</label></td>
												<td>
													<input type="text" class="form-control" name="nilai'.$no.'" value="'.$data_pertanyaan['nilai'].'">
												</td>
											</div>
											<td>
												<a class="logdrop1" role="menuitem" tabindex="-1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=hapus_satu_pertanyaan&id_kriteria='.$data_pertanyaan['id_kriteria'].'&id_pertanyaan='.$data_pertanyaan['id_pertanyaan'].'">Hapus</a>
											</td>
										</tr>
										';
										$no++;
										$y = 1;
										$z = $no - $y;
									}
								echo'
							<input type="hidden" class="form-control progress horizontal" name="jumlah" value="'.$z.'">
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