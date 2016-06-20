<?php
$modul=isset($_GET['aksi']) ?$_GET['aksi'] : '';
include 'lib/kode_auto.php';
include 'lib/fungsi.php';

switch ($modul) {
	case "tampil":
		
	$sql_tampil = "Select a.*, b.kriteria from bobot_alternatif a, kriteria b where a.id_kriteria = b.id_kriteria order by a.id_kriteria";
	$run_sql = mysql_query($sql_tampil);
	
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
	echo '
		<h4 class="widgettitle">
			<a class="btn btn-success" href="index2.php?modul='.$_GET['modul'].'&aksi=tambah">Tambah '.ucwords(str_replace("_"," ", $_GET['modul'])).'</a>
		</h4>
		<div class="clear"></div>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nomor</th>
						<th>Berdasarkan Kriteria</th>';
						$array_alternatif = array();
						$alternatif = mysql_query("select * from alternatif order by id_alternatif");
						$jum_alternatif = mysql_num_rows($alternatif);
						$jumlah_alternatif = (ceil($jum_alternatif))-1;
						while ($data_alternatif = mysql_fetch_array($alternatif)) {
						echo'
						<th>'.$data_alternatif['alternatif'].'</th>';
						$array_alternatif[] = $data_alternatif['alternatif'];
						}
						echo'
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
						<td>'.$data['kriteria'].'</td>';
						for ($i=0; $i<=$jumlah_alternatif; $i++) {
							$bobot_alternatif = mysql_fetch_assoc(mysql_query("select ".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($array_alternatif[$i]))))))." from bobot_alternatif where id_kriteria = '".$data['id_kriteria']."'"));
							echo'
							<td>'.round($bobot_alternatif[''.str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($array_alternatif[$i])))))).''], 4, PHP_ROUND_HALF_UP).'</td>
							';
						}
						echo'
						<td><a class="logdrop1" role="menuitem" tabindex="-1" href="index2.php?modul='.$_GET['modul'].'&aksi=edit&id_kriteria='.$data['id_kriteria'].'"><img src="images/edit.png"></a></td> 
						<td><a class="logdrop1" role="menuitem" tabindex="-1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=hapus&id_kriteria='.$data['id_kriteria'].'""><img src="images/hapus.png"></a></td>
					</tr>';
					$no++;
					}
				echo'
				</tbody>
			</table>
			<h4 class="widgettitle">
				Hasil Perhitungan Bobot alternatif
			</h4>
			<div class="clear"></div>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>alternatif</th>';
						$array_id_kriteria = array();
						$id_kriteria = mysql_query("select a.id_kriteria, b.kriteria from bobot_alternatif a, kriteria b where a.id_kriteria = b.id_kriteria order by id_kriteria");
						$jum_id_kriteria = mysql_num_rows($id_kriteria);
						$jumlah_id_kriteria = (ceil($jum_id_kriteria))-1;
						while ($data_id_kriteria = mysql_fetch_array($id_kriteria)) {
						echo'
						<th>'.$data_id_kriteria['kriteria'].'</th>';
						$array_id_kriteria[] = $data_id_kriteria['id_kriteria'];
						}
					echo'
						<th>Proses</th>
						<th>Nilai Eigen Kriteria</th>
					</tr>
					</tr>
				</thead>
				<tbody>';
				$alternatif2 = mysql_query("select * from alternatif order by id_alternatif");
				$q=1;
				while ($data_alternatif2=mysql_fetch_array($alternatif2)) {
					echo'
						<tr>
							<td>'.$data_alternatif2['alternatif'].'</td>';
							for ($i=0; $i<=$jumlah_id_kriteria; $i++) {
								$bobot_alternatif2 = mysql_fetch_assoc(mysql_query("select ".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($data_alternatif2['alternatif']))))))." from bobot_alternatif where id_kriteria = '".$array_id_kriteria[$i]."'"));
								echo'
								<td>'.round($bobot_alternatif2[''.str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($data_alternatif2['alternatif'])))))).''], 4, PHP_ROUND_HALF_UP).'</td>
								';
							}
						if ($q==1) {
						echo'
							<td rowspan="'.($jumlah_alternatif+1).'" style="text-align:center;"><b>x</b></td>';
						}
						echo'
						<td><b>';if (round($eigen_kriteria[$q-1], 4, PHP_ROUND_HALF_UP)==0) {echo'';}else{echo''.round($eigen_kriteria[$q-1], 4, PHP_ROUND_HALF_UP).'';}echo'</b></td>
						</tr>
					';
				$q++;
				}
				echo'</tbody>
			</table>
			';
			
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
			
			echo'
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>BOBOT GLOBAL</th>
					</tr>
				</thead>
				<tbody>';
					$bg = array();
					for ($l=0;$l<count($array_alternatif);$l++){
						$bg[$l] = 0;
						for ($o=0;$o<count($array_alternatif);$o++){			
							$bg[$l] += $n[$l][$o] * $eigen_kriteria[$o];
						}
						echo'
						<tr><td>'.round($bg[$l], 4, PHP_ROUND_HALF_UP).'</td></tr>
						';
					}
				echo'
				</tbody>
			</table>
				';
	break;
	
	case "tambah":
	$alternatif = array();
	$x = array();
	$queryalternatif = mysql_query("SELECT * FROM alternatif ORDER BY id_alternatif");
	$i=0;
	while ($dataalternatif = mysql_fetch_array($queryalternatif))
	{
		$alternatif[$i] = $dataalternatif['alternatif'];
		$i++;
	}
	
	$juk = count($alternatif);
	if ($juk==1) {
		$ri = 0.00;
	}
	if ($juk==2) {
		$ri = 0.00;
	}
	if ($juk==3) {
		$ri = 0.58;
	}
	if ($juk==4) {
		$ri = 0.90;
	}
	if ($juk==5) {
		$ri = 1.12;
	}
	if ($juk==6) {
		$ri = 1.24;
	}
	if ($juk==7) {
		$ri = 1.32;
	}
	if ($juk==8) {
		$ri = 1.41;
	}
	if ($juk==9) {
		$ri = 1.45;
	}
	if ($juk==10) {
		$ri = 1.49;
	}
	if ($juk==11) {
		$ri = 1.51;
	}
	if ($juk==12) {
		$ri = 1.48;
	}
	if ($juk==13) {
		$ri = 1.56;
	}
	if ($juk==14) {
		$ri = 1.57;
	}
	if ($juk==15) {
		$ri = 1.59;
	}
	
	echo ' 
		
		<div class="col-md-12">
			<form role="form" id="form1" name="form1" method="post" action="">
			<!-- general form elements disabled -->
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-edit"></i> Pilih Nilai Kepentingan alternatif</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Pilih Kriteria</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<div class="form-group">
								<td>
									<select name="id_kriteria" class="form-control" required/>
										<option selected value="">-- Silahkan Pilih --</option>';
										$query_kriteria = mysql_query("select * from kriteria order by id_kriteria");
										while ($data_kriteria = mysql_fetch_array($query_kriteria)) {
											echo'
												<option value="'.$data_kriteria['id_kriteria'].'">'.$data_kriteria['kriteria'].'</option>
											';
										}
									echo'
									</select>
								</td>
							</div>
						</tr>
					</tbody>
				</table>
					<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>alternatif 1 </th>
							<th>Perbandingan</th>
							<th>alternatif 2 </th>
						</tr>
					</thead>
					<tbody>';
						for ($i=0;$i<count($alternatif);$i++)
						{
							for ($j=0;$j<count($alternatif);$j++)
							{
								if ($i < $j)
								{
						echo'
						  <tr>
							<td>'.$alternatif[$i].'</td>
							<div class="form-group">
							<td>
							  <select name="P'.$i.'_'.$j.'" id="P'.$i.'_'.$j.'" class="form-control" required/>
								<option value=""></option>
								<option value="1">'.$alternatif[$i].' Sama Penting Dengan '.$alternatif[$j].' (Nilai=1)</option>
								<option value="3">'.$alternatif[$i].' Sedikit Lebih Penting Dari '.$alternatif[$j].' (Nilai=3)</option>
								<option value="5">'.$alternatif[$i].' Lebih Penting Dari '.$alternatif[$j].' (Nilai=5)</option>
								<option value="7">'.$alternatif[$i].' Lebih Mutlak Penting Dari '.$alternatif[$j].' (Nilai=7)</option>
								<option value="9">'.$alternatif[$i].' Mutlak Penting Dari '.$alternatif[$j].' (Nilai=9)</option>
								<option value="2">'.$alternatif[$i].' Nilai Berdekatan Dengan '.$alternatif[$j].' (Nilai=2)</option>
								<option value="0.333333333333333">'.$alternatif[$j].' Sedikit Lebih Penting Dari '.$alternatif[$i].' (Nilai=1/3)</option>
								<option value="0.2">'.$alternatif[$j].' Lebih Penting Dari '.$alternatif[$i].' (Nilai=1/5)</option>
								<option value="0.142857142857143">'.$alternatif[$j].' Lebih Mutlak Penting Dari '.$alternatif[$i].' (Nilai=1/7)</option>
								<option value="0.111111111111111">'.$alternatif[$j].' Mutlak Penting Dari '.$alternatif[$i].' (Nilai=1/9)</option>
								<option value="0.5">'.$alternatif[$j].' Nilai Berdekatan Dengan '.$alternatif[$i].' (Nilai=1/2)</option>
							  </select>
							</td>
							</div>
							<td>'.$alternatif[$j].'</td>
						  </tr>
						  ';
								}
							}
						} 
					echo'
					 <tr>
						<td colspan=3>
							<input type="submit" class="btn btn-success" name="button" id="button" onclick="document.getElementById(perhitungan")" value="Hitung Bobot alternatif">
							<button type="reset" class="btn btn-warning">Reset</button>
						</td>
					</tr>
					</tbody>
					</table>
					</form>';
		if (!isset($_POST['button']))
		{
		
		}else {
			$i=0;
	
			$k = array();
			for ($i=0;$i<count($alternatif);$i++)
			{
				for ($j=0;$j<count($alternatif);$j++)
				{
					if ($i < $j)
					{ 
						$k[$i][$j] = $_POST['P'.$i.'_'.$j];
					}
					else if ($i == $j)
					{
						$k[$i][$j] = 1;
					}
					else
					{
						$k[$i][$j] = 1 / ($_POST['P'.$j.'_'.$i]);
					}
				}
			}
				
			$jk = array();
			for ($i=0;$i<count($alternatif);$i++)
			{
				$jk[$i]=0;
				for ($j=0;$j<count($alternatif);$j++)
				{			
					$jk[$i] += $k[$j][$i];
				}
			}
			
			$nk = array();
			for ($i=0;$i<count($alternatif);$i++)
			{
				for ($j=0;$j<count($alternatif);$j++)
				{			
					$nk[$i][$j] = $k[$i][$j] / $jk[$j];
				}
			}

			$jnk = array();
			for ($i=0;$i<count($alternatif);$i++)
			{
				$jnk[$i] = 0;
				for ($j=0;$j<count($alternatif);$j++)
				{			
					$jnk[$i] += $nk[$i][$j]; 
				}
			}

			$w = array();
			for ($i=0;$i<count($alternatif);$i++)
			{
				$w[$i] = $jnk[$i] / count($alternatif); 
			}
			
			$kw = array();
			for ($i=0;$i<count($alternatif);$i++)
			{
				$kw[$i] = 0;
				for ($j=0;$j<count($alternatif);$j++)
				{			
					$kw[$i] += $k[$i][$j] * $w[$j]; 
				}
			}

			$t=0;
			for ($i=0;$i<count($alternatif);$i++)
			{
				$t += $kw[$i] / $w[$i]; 
			}
			$t = $t / count($alternatif);
			
			$ci = ($t - count($alternatif)) / (count($alternatif) - 1);
			
			$cr = $ci / $ri;
			}
			echo'
			<form role="form" enctype="multipart/form-data" action="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=tambah" method="post">
			<div class="box-group" id="accordion">
			<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
				<div class="panel box box-success">
					<div class="box-header">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="">
							<small style="color:white">Hasil Perhitungan</small>
						</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse in" style="height: auto;">
					<div class="box-body" id="perhitungan">';
						if (!isset($_POST['button'])){
												
						}else {
							$id_kriteria = $_POST['id_kriteria'];
							echo'<input type="hidden" name="id_kriteria" class="form-control" value="'.$id_kriteria.'">';
							include("lib/tabel_perhitungan_bobot_alternatif.php");
						}
						$alternatif = mysql_query("select * from alternatif order by id_alternatif");
						$jum_alternatif = mysql_num_rows($alternatif);
						$jumlah_alternatif = (ceil($jum_alternatif))-1;
						for($i=0; $i<=$jumlah_alternatif; $i++) {
						echo'
						<input type="hidden" name="bobot_alternatif'.$i.'" value="'.$w[$i].'">';
						}
						echo'
					</div>
				</div>
			</div>';
		if (!isset($_POST['button'])){
												
		}else {
		echo'
			 <hr>
				<button type="submit" class="btn btn-success" name="submit">Simpan Bobot alternatif</button>
				<button type="button" class="btn btn-danger" onclick="self.history.back()" style="float:right;"><i class="fa fa-backward"></i> <span>Kembali</span></button>
			</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
		';}
	break;
	
	case "edit":
	$id_kriteria = $_GET['id_kriteria'];
	$alternatif = array();
	$x = array();
	$queryalternatif = mysql_query("SELECT * FROM alternatif ORDER BY id_alternatif");
	$i=0;
	while ($dataalternatif = mysql_fetch_array($queryalternatif))
	{
		$alternatif[$i] = $dataalternatif['alternatif'];
		$i++;
	}
	
	$juk = count($alternatif);
	if ($juk==1) {
		$ri = 0.00;
	}
	if ($juk==2) {
		$ri = 0.00;
	}
	if ($juk==3) {
		$ri = 0.58;
	}
	if ($juk==4) {
		$ri = 0.90;
	}
	if ($juk==5) {
		$ri = 1.12;
	}
	if ($juk==6) {
		$ri = 1.24;
	}
	if ($juk==7) {
		$ri = 1.32;
	}
	if ($juk==8) {
		$ri = 1.41;
	}
	if ($juk==9) {
		$ri = 1.45;
	}
	if ($juk==10) {
		$ri = 1.49;
	}
	if ($juk==11) {
		$ri = 1.51;
	}
	if ($juk==12) {
		$ri = 1.48;
	}
	if ($juk==13) {
		$ri = 1.56;
	}
	if ($juk==14) {
		$ri = 1.57;
	}
	if ($juk==15) {
		$ri = 1.59;
	}
	
	echo ' 
		
		<div class="col-md-12">
			<form role="form" id="form1" name="form1" method="post" action="">
			<!-- general form elements disabled -->
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-edit"></i> Pilih Nilai Kepentingan alternatif</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>alternatif 1 </th>
							<th>Perbandingan</th>
							<th>alternatif 2 </th>
						</tr>
					</thead>
					<tbody>';
						for ($i=0;$i<count($alternatif);$i++)
						{
							for ($j=0;$j<count($alternatif);$j++)
							{
								if ($i < $j)
								{
						echo'
						  <tr>
							<td>'.$alternatif[$i].'</td>
							<div class="form-group">
							<td>
							  <select name="P'.$i.'_'.$j.'" id="P'.$i.'_'.$j.'" class="form-control" required/>
								<option value=""></option>
								<option value="1">'.$alternatif[$i].' Sama Penting Dengan '.$alternatif[$j].' (Nilai=1)</option>
								<option value="3">'.$alternatif[$i].' Sedikit Lebih Penting Dari '.$alternatif[$j].' (Nilai=3)</option>
								<option value="5">'.$alternatif[$i].' Lebih Penting Dari '.$alternatif[$j].' (Nilai=5)</option>
								<option value="7">'.$alternatif[$i].' Lebih Mutlak Penting Dari '.$alternatif[$j].' (Nilai=7)</option>
								<option value="9">'.$alternatif[$i].' Mutlak Penting Dari '.$alternatif[$j].' (Nilai=9)</option>
								<option value="2">'.$alternatif[$i].' Nilai Berdekatan Dengan '.$alternatif[$j].' (Nilai=2)</option>
								<option value="0.333333333333333">'.$alternatif[$j].' Sedikit Lebih Penting Dari '.$alternatif[$i].' (Nilai=1/3)</option>
								<option value="0.2">'.$alternatif[$j].' Lebih Penting Dari '.$alternatif[$i].' (Nilai=1/5)</option>
								<option value="0.142857142857143">'.$alternatif[$j].' Lebih Mutlak Penting Dari '.$alternatif[$i].' (Nilai=1/7)</option>
								<option value="0.111111111111111">'.$alternatif[$j].' Mutlak Penting Dari '.$alternatif[$i].' (Nilai=1/9)</option>
								<option value="0.5">'.$alternatif[$j].' Nilai Berdekatan Dengan '.$alternatif[$i].' (Nilai=1/2)</option>
							  </select>
							</td>
							</div>
							<td>'.$alternatif[$j].'</td>
						  </tr>
						  ';
								}
							}
						} 
					echo'
					 <tr>
						<td colspan=3>
							<input type="submit" class="btn btn-success" name="button" id="button" onclick="document.getElementById(perhitungan")" value="Hitung Bobot alternatif">
							<button type="reset" class="btn btn-warning">Reset</button>
						</td>
					</tr>
					</tbody>
					</table>
					</form>';
		if (!isset($_POST['button']))
		{
		
		}else {
			$i=0;
	
			$k = array();
			for ($i=0;$i<count($alternatif);$i++)
			{
				for ($j=0;$j<count($alternatif);$j++)
				{
					if ($i < $j)
					{ 
						$k[$i][$j] = $_POST['P'.$i.'_'.$j];
					}
					else if ($i == $j)
					{
						$k[$i][$j] = 1;
					}
					else
					{
						$k[$i][$j] = 1 / ($_POST['P'.$j.'_'.$i]);
					}
				}
			}
				
			$jk = array();
			for ($i=0;$i<count($alternatif);$i++)
			{
				$jk[$i]=0;
				for ($j=0;$j<count($alternatif);$j++)
				{			
					$jk[$i] += $k[$j][$i];
				}
			}
			
			$nk = array();
			for ($i=0;$i<count($alternatif);$i++)
			{
				for ($j=0;$j<count($alternatif);$j++)
				{			
					$nk[$i][$j] = $k[$i][$j] / $jk[$j];
				}
			}

			$jnk = array();
			for ($i=0;$i<count($alternatif);$i++)
			{
				$jnk[$i] = 0;
				for ($j=0;$j<count($alternatif);$j++)
				{			
					$jnk[$i] += $nk[$i][$j]; 
				}
			}

			$w = array();
			for ($i=0;$i<count($alternatif);$i++)
			{
				$w[$i] = $jnk[$i] / count($alternatif); 
			}
			
			$kw = array();
			for ($i=0;$i<count($alternatif);$i++)
			{
				$kw[$i] = 0;
				for ($j=0;$j<count($alternatif);$j++)
				{			
					$kw[$i] += $k[$i][$j] * $w[$j]; 
				}
			}

			$t=0;
			for ($i=0;$i<count($alternatif);$i++)
			{
				$t += $kw[$i] / $w[$i]; 
			}
			$t = $t / count($alternatif);
			
			$ci = ($t - count($alternatif)) / (count($alternatif) - 1);
			
			$cr = $ci / $ri;
			}
			echo'
			<form role="form" enctype="multipart/form-data" action="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=edit" method="post">
			<div class="box-group" id="accordion">
			<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
				<div class="panel box box-success">
					<div class="box-header">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="">
							<small style="color:white">Hasil Perhitungan</small>
						</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse in" style="height: auto;">
					<div class="box-body" id="perhitungan">
					<input type="hidden" class="form-control" name="id_kriteria" value="'.$id_kriteria.'">';
						if (!isset($_POST['button'])){
												
						}else {
							include("lib/tabel_perhitungan_bobot_alternatif.php");
						}
						$alternatif = mysql_query("select * from alternatif order by id_alternatif");
						$jum_alternatif = mysql_num_rows($alternatif);
						$jumlah_alternatif = (ceil($jum_alternatif))-1;
						for($i=0; $i<=$jumlah_alternatif; $i++) {
						echo'
						<input type="hidden" class="form-control" name="bobot_alternatif'.$i.'" value="'.$w[$i].'">';
						}
						echo'
					</div>
				</div>
			</div>';
		if (!isset($_POST['button'])){
												
		}else {
		echo'
			 <hr>
				<button type="submit" class="btn btn-success" name="submit">Edit Bobot alternatif</button>
				<button type="button" class="btn btn-danger" onclick="self.history.back()" style="float:right;"><i class="fa fa-backward"></i> <span>Kembali</span></button>
			</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
		';}
break;
}
?>