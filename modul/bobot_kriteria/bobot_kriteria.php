<?php
$modul=isset($_GET['aksi']) ?$_GET['aksi'] : '';
include 'lib/kode_auto.php';
include 'lib/fungsi.php';

switch ($modul) {
	case "tampil":
	$sql_tampil = "Select * from bobot_kriteria order by pakar";
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
						<th>Berdasarkan Pakar</th>';
						$array_kriteria = array();
						$kriteria = mysql_query("select * from kriteria order by id_kriteria");
						$jum_kriteria = mysql_num_rows($kriteria);
						$jumlah_kriteria = (ceil($jum_kriteria))-1;
						while ($data_kriteria = mysql_fetch_array($kriteria)) {
						echo'
						<th>'.$data_kriteria['kriteria'].'</th>';
						$array_kriteria[] = $data_kriteria['kriteria'];
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
						<td>'.$data['pakar'].'</td>';
						for ($i=0; $i<=$jumlah_kriteria; $i++) {
							$bobot_kriteria = mysql_fetch_assoc(mysql_query("select ".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($array_kriteria[$i]))))))." from bobot_kriteria where pakar = '".$data['pakar']."'"));
							echo'
							<td>'.round($bobot_kriteria[''.str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($array_kriteria[$i])))))).''], 4, PHP_ROUND_HALF_UP).'</td>
							';
						}
						echo'
						<td><a class="logdrop1" role="menuitem" tabindex="-1" href="index2.php?modul='.$_GET['modul'].'&aksi=edit&pakar='.$data['pakar'].'"><img src="images/edit.png"></a></td> 
						<td><a class="logdrop1" role="menuitem" tabindex="-1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=hapus&pakar='.$data['pakar'].'""><img src="images/hapus.png"></a></td>
					</tr>';
					$no++;
					}
				echo'
				</tbody>
			</table>
			<h4 class="widgettitle">
				Hasil Perhitungan Bobot Kriteria
			</h4>
			<div class="clear"></div>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Kriteria</th>';
						$array_pakar = array();
						$pakar = mysql_query("select pakar from bobot_kriteria order by pakar");
						$jum_pakar = mysql_num_rows($pakar);
						$jumlah_pakar = (ceil($jum_pakar))-1;
						while ($data_pakar = mysql_fetch_array($pakar)) {
						echo'
						<th>'.$data_pakar['pakar'].'</th>';
						$array_pakar[] = $data_pakar['pakar'];
						}
					echo'
						<th>Rata Rata Eigen</th>
					</tr>
				</thead>
				<tbody>';
				$kriteria2 = mysql_query("select * from kriteria order by id_kriteria");
				while ($data_kriteria2=mysql_fetch_array($kriteria2)) {
					echo'
						<tr>
							<td>'.$data_kriteria2['kriteria'].'</td>';
							for ($i=0; $i<=$jumlah_pakar; $i++) {
								$bobot_kriteria2 = mysql_fetch_assoc(mysql_query("select ".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($data_kriteria2['kriteria']))))))." from bobot_kriteria where pakar = '".$array_pakar[$i]."'"));
								echo'
								<td>'.round($bobot_kriteria2[''.str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($data_kriteria2['kriteria'])))))).''], 4, PHP_ROUND_HALF_UP).'</td>
								';
							}
						$jum_bobot = mysql_fetch_assoc(mysql_query("select sum(".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($data_kriteria2['kriteria'])))))).") as jumlah_bobot from bobot_kriteria"));
						$jumlah_bobot = $jum_bobot['jumlah_bobot'];
						$rata_rata_eigen = $jumlah_bobot/($jumlah_pakar+1);
						echo'
						<td><b>'.round($rata_rata_eigen, 4, PHP_ROUND_HALF_UP).'</b></td>
						</tr>
					';
				}
				echo'</tbody>
			</table>
			';
	break;
	
	case "tambah":
	$kriteria = array();
	$x = array();
	$querykriteria = mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria");
	$i=0;
	while ($datakriteria = mysql_fetch_array($querykriteria))
	{
		$kriteria[$i] = $datakriteria['kriteria'];
		$i++;
	}
	
	$juk = count($kriteria);
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
					<h3 class="box-title"><i class="fa fa-edit"></i> Pilih Nilai Kepentingan Kriteria</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Kriteria 1 </th>
							<th>Perbandingan</th>
							<th>Kriteria 2 </th>
						</tr>
					</thead>
					<tbody>';
						for ($i=0;$i<count($kriteria);$i++)
						{
							for ($j=0;$j<count($kriteria);$j++)
							{
								if ($i < $j)
								{
						echo'
						  <tr>
							<td>'.$kriteria[$i].'</td>
							<div class="form-group">
							<td>
							  <select name="P'.$i.'_'.$j.'" id="P'.$i.'_'.$j.'" class="form-control" required/>
								<option value=""></option>
								<option value="1">'.$kriteria[$i].' Sama Penting Dengan '.$kriteria[$j].' (Nilai=1)</option>
								<option value="3">'.$kriteria[$i].' Sedikit Lebih Penting Dari '.$kriteria[$j].' (Nilai=3)</option>
								<option value="5">'.$kriteria[$i].' Lebih Penting Dari '.$kriteria[$j].' (Nilai=5)</option>
								<option value="7">'.$kriteria[$i].' Lebih Mutlak Penting Dari '.$kriteria[$j].' (Nilai=7)</option>
								<option value="9">'.$kriteria[$i].' Mutlak Penting Dari '.$kriteria[$j].' (Nilai=9)</option>
								<option value="2">'.$kriteria[$i].' Nilai Berdekatan Dengan '.$kriteria[$j].' (Nilai=2)</option>
								<option value="0.333333333333333">'.$kriteria[$j].' Sedikit Lebih Penting Dari '.$kriteria[$i].' (Nilai=1/3)</option>
								<option value="0.2">'.$kriteria[$j].' Lebih Penting Dari '.$kriteria[$i].' (Nilai=1/5)</option>
								<option value="0.142857142857143">'.$kriteria[$j].' Lebih Mutlak Penting Dari '.$kriteria[$i].' (Nilai=1/7)</option>
								<option value="0.111111111111111">'.$kriteria[$j].' Mutlak Penting Dari '.$kriteria[$i].' (Nilai=1/9)</option>
								<option value="0.5">'.$kriteria[$j].' Nilai Berdekatan Dengan '.$kriteria[$i].' (Nilai=1/2)</option>
							  </select>
							</td>
							</div>
							<td>'.$kriteria[$j].'</td>
						  </tr>
						  ';
								}
							}
						} 
					echo'
					 <tr>
						<td colspan=3>
							<input type="submit" class="btn btn-success" name="button" id="button" onclick="document.getElementById(perhitungan")" value="Hitung Bobot Kriteria">
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
			for ($i=0;$i<count($kriteria);$i++)
			{
				for ($j=0;$j<count($kriteria);$j++)
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
			for ($i=0;$i<count($kriteria);$i++)
			{
				$jk[$i]=0;
				for ($j=0;$j<count($kriteria);$j++)
				{			
					$jk[$i] += $k[$j][$i];
				}
			}
			
			$nk = array();
			for ($i=0;$i<count($kriteria);$i++)
			{
				for ($j=0;$j<count($kriteria);$j++)
				{			
					$nk[$i][$j] = $k[$i][$j] / $jk[$j];
				}
			}

			$jnk = array();
			for ($i=0;$i<count($kriteria);$i++)
			{
				$jnk[$i] = 0;
				for ($j=0;$j<count($kriteria);$j++)
				{			
					$jnk[$i] += $nk[$i][$j]; 
				}
			}

			$w = array();
			for ($i=0;$i<count($kriteria);$i++)
			{
				$w[$i] = $jnk[$i] / count($kriteria); 
			}
			
			$kw = array();
			for ($i=0;$i<count($kriteria);$i++)
			{
				$kw[$i] = 0;
				for ($j=0;$j<count($kriteria);$j++)
				{			
					$kw[$i] += $k[$i][$j] * $w[$j]; 
				}
			}

			$t=0;
			for ($i=0;$i<count($kriteria);$i++)
			{
				$t += $kw[$i] / $w[$i]; 
			}
			$t = $t / count($kriteria);
			
			$ci = ($t - count($kriteria)) / (count($kriteria) - 1);
			
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
							include("lib/tabel_perhitungan_bobot_kriteria.php");
						}
						$kriteria = mysql_query("select * from kriteria order by id_kriteria");
						$jum_kriteria = mysql_num_rows($kriteria);
						$jumlah_kriteria = (ceil($jum_kriteria))-1;
						for($i=0; $i<=$jumlah_kriteria; $i++) {
						echo'
						<input type="hidden" name="bobot_kriteria'.$i.'" value="'.$w[$i].'">';
						}
						echo'
					</div>
				</div>
			</div>';
		if (!isset($_POST['button'])){
												
		}else {
		echo'
			 <hr>
				<button type="submit" class="btn btn-success" name="submit">Simpan Bobot Kriteria</button>
				<button type="button" class="btn btn-danger" onclick="self.history.back()" style="float:right;"><i class="fa fa-backward"></i> <span>Kembali</span></button>
			</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
		';}
	break;
	
	case "edit":
	$pakar = $_GET['pakar'];
	$kriteria = array();
	$x = array();
	$querykriteria = mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria");
	$i=0;
	while ($datakriteria = mysql_fetch_array($querykriteria))
	{
		$kriteria[$i] = $datakriteria['kriteria'];
		$i++;
	}
	
	$juk = count($kriteria);
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
					<h3 class="box-title"><i class="fa fa-edit"></i> Pilih Nilai Kepentingan Kriteria</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Kriteria 1 </th>
							<th>Perbandingan</th>
							<th>Kriteria 2 </th>
						</tr>
					</thead>
					<tbody>';
						for ($i=0;$i<count($kriteria);$i++)
						{
							for ($j=0;$j<count($kriteria);$j++)
							{
								if ($i < $j)
								{
						echo'
						  <tr>
							<td>'.$kriteria[$i].'</td>
							<div class="form-group">
							<td>
							  <select name="P'.$i.'_'.$j.'" id="P'.$i.'_'.$j.'" class="form-control" required/>
								<option value=""></option>
								<option value="1">'.$kriteria[$i].' Sama Penting Dengan '.$kriteria[$j].' (Nilai=1)</option>
								<option value="3">'.$kriteria[$i].' Sedikit Lebih Penting Dari '.$kriteria[$j].' (Nilai=3)</option>
								<option value="5">'.$kriteria[$i].' Lebih Penting Dari '.$kriteria[$j].' (Nilai=5)</option>
								<option value="7">'.$kriteria[$i].' Lebih Mutlak Penting Dari '.$kriteria[$j].' (Nilai=7)</option>
								<option value="9">'.$kriteria[$i].' Mutlak Penting Dari '.$kriteria[$j].' (Nilai=9)</option>
								<option value="2">'.$kriteria[$i].' Nilai Berdekatan Dengan '.$kriteria[$j].' (Nilai=2)</option>
								<option value="0.333333333333333">'.$kriteria[$j].' Sedikit Lebih Penting Dari '.$kriteria[$i].' (Nilai=1/3)</option>
								<option value="0.2">'.$kriteria[$j].' Lebih Penting Dari '.$kriteria[$i].' (Nilai=1/5)</option>
								<option value="0.142857142857143">'.$kriteria[$j].' Lebih Mutlak Penting Dari '.$kriteria[$i].' (Nilai=1/7)</option>
								<option value="0.111111111111111">'.$kriteria[$j].' Mutlak Penting Dari '.$kriteria[$i].' (Nilai=1/9)</option>
								<option value="0.5">'.$kriteria[$j].' Nilai Berdekatan Dengan '.$kriteria[$i].' (Nilai=1/2)</option>
							  </select>
							</td>
							</div>
							<td>'.$kriteria[$j].'</td>
						  </tr>
						  ';
								}
							}
						} 
					echo'
					 <tr>
						<td colspan=3>
							<input type="submit" class="btn btn-success" name="button" id="button" onclick="document.getElementById(perhitungan")" value="Hitung Bobot Kriteria">
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
			for ($i=0;$i<count($kriteria);$i++)
			{
				for ($j=0;$j<count($kriteria);$j++)
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
			for ($i=0;$i<count($kriteria);$i++)
			{
				$jk[$i]=0;
				for ($j=0;$j<count($kriteria);$j++)
				{			
					$jk[$i] += $k[$j][$i];
				}
			}
			
			$nk = array();
			for ($i=0;$i<count($kriteria);$i++)
			{
				for ($j=0;$j<count($kriteria);$j++)
				{			
					$nk[$i][$j] = $k[$i][$j] / $jk[$j];
				}
			}

			$jnk = array();
			for ($i=0;$i<count($kriteria);$i++)
			{
				$jnk[$i] = 0;
				for ($j=0;$j<count($kriteria);$j++)
				{			
					$jnk[$i] += $nk[$i][$j]; 
				}
			}

			$w = array();
			for ($i=0;$i<count($kriteria);$i++)
			{
				$w[$i] = $jnk[$i] / count($kriteria); 
			}
			
			$kw = array();
			for ($i=0;$i<count($kriteria);$i++)
			{
				$kw[$i] = 0;
				for ($j=0;$j<count($kriteria);$j++)
				{			
					$kw[$i] += $k[$i][$j] * $w[$j]; 
				}
			}

			$t=0;
			for ($i=0;$i<count($kriteria);$i++)
			{
				$t += $kw[$i] / $w[$i]; 
			}
			$t = $t / count($kriteria);
			
			$ci = ($t - count($kriteria)) / (count($kriteria) - 1);
			
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
					<input type="hidden" class="form-control" name="pakar" value="'.$pakar.'">';
						if (!isset($_POST['button'])){
												
						}else {
							include("lib/tabel_perhitungan_bobot_kriteria.php");
						}
						$kriteria = mysql_query("select * from kriteria order by id_kriteria");
						$jum_kriteria = mysql_num_rows($kriteria);
						$jumlah_kriteria = (ceil($jum_kriteria))-1;
						for($i=0; $i<=$jumlah_kriteria; $i++) {
						echo'
						<input type="hidden" class="form-control" name="bobot_kriteria'.$i.'" value="'.$w[$i].'">';
						}
						echo'
					</div>
				</div>
			</div>';
		if (!isset($_POST['button'])){
												
		}else {
		echo'
			 <hr>
				<button type="submit" class="btn btn-success" name="submit">Edit Bobot Kriteria</button>
				<button type="button" class="btn btn-danger" onclick="self.history.back()" style="float:right;"><i class="fa fa-backward"></i> <span>Kembali</span></button>
			</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
		';}
break;
}
?>