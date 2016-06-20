<?php
$modul=isset($_GET['aksi']) ?$_GET['aksi'] : '';
include 'lib/kode_auto.php';
include 'lib/fungsi.php';

switch ($modul) {
	case "tampil":
	$sekolah = mysql_fetch_assoc(mysql_query("select * from sekolah where id_sekolah = '".$_SESSION['id_sekolah']."'"));
	$nama_sekolah = $sekolah['nama_sekolah'];
	
	$sql_tampil = "Select * from laporan where id_sekolah='".$_SESSION['id_sekolah']."' and tahun='".date('Y')."'";
	$run_sql = mysql_query($sql_tampil);
	$data=mysql_fetch_array($run_sql);
	for ($i=1; $i<=8; $i++) {
		$rangking[$i] = $data['rangking'.$i];
		$bobot[$i] = $data['bobot'.$i];
	}
	
	echo '
		<h4 class="widgettitle">
			Pendukung Keputusan Perbaikan Akreditasi Sekolah '.$nama_sekolah.' Pada Tahun '.date('Y').'
		</h4>
		<div class="clear"></div>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Urutan Prioritas Perbaikan Akreditasi</th>
						<th>Alternatif (Standar Akreditasi)</th>
						<th>Bobot Akhir</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>';	
				for ($no=1; $no<=8; $no++) {
					echo '
					<tr>
						<td>'.$no.'</td>
						<td>'.$rangking[$no].'</td>
						<td>'.round($bobot[$no], 4, PHP_ROUND_HALF_UP).'</td>';
						if ($no==1) {
						echo'
							<td rowspan="8"><a class="logdrop1" role="menuitem" tabindex="-1" href="index2.php?modul=penilaian_dan_lihat_keputusan&aksi=tambah"><img src="images/edit.png"></a></td>
					</tr>
						';
						}
					echo'
					';
				}
				echo'
				</tbody>
			</table>
			<div class="callout callout-success"><p>Alternatif Terbaik Adalah <strong>'.$rangking[1].'</strong> dengan Nilai Terbesar = <strong>'.round($bobot[1], 4, PHP_ROUND_HALF_UP).'</strong></p></div>
			<hr>
			<a class="btn btn-success" href="modul/penilaian_dan_lihat_keputusan/print_keputusan.php?modul='.$_GET['modul'].'&aksi=print_keputusan" target="new_window()"><i class="fa fa-print"></i>Print</a>
			';
	break;
	
	case "hitung":
		error_reporting(0);
		$sql_kriteria = mysql_query("select * from kriteria order by id_kriteria");
		$juml_kriteria = mysql_num_rows($sql_kriteria);
		$jumlah_kriteria = ceil($juml_kriteria);
		
		$sql_alternatif = mysql_query("select * from alternatif order by id_alternatif");
		$juml_alternatif = mysql_num_rows($sql_alternatif);
		$jumlah_alternatif = ceil($juml_alternatif);
		
		$jumlah_perulangan = $jumlah_kriteria*$jumlah_alternatif;
		
		$id_sekolah = $_SESSION['id_sekolah'];
		$tahun = date('Y');
		
		$sql_cek_jum_alkrit = mysql_query("select * from alternatif_kriteria where id_sekolah = '$id_sekolah' and tahun = '$tahun'");
		$juml_alkrit = mysql_num_rows($sql_cek_jum_alkrit);
		$jumlah_alternatif_kriteria = ceil($juml_alkrit);
		
		if ($jumlah_alternatif_kriteria == 0) {
			for($i=1; $i<=$jumlah_perulangan; $i++) {
				$id_alternatif = $_POST['id_alternatif'.$i];
				$id_kriteria = $_POST['id_kriteria'.$i];
				$nilai = $_POST['nilai'.$i];
				$sql_alternatif_kriteria = mysql_query("insert into alternatif_kriteria (id_sekolah, id_alternatif, id_kriteria, tahun, nilai) values ('$id_sekolah', '$id_alternatif', '$id_kriteria', '$tahun', '$nilai')");
			}
		}
		if ($jumlah_alternatif_kriteria <> 0) {
			for($i=1; $i<=$jumlah_perulangan; $i++) {
				$id_alternatif = $_POST['id_alternatif'.$i];
				$id_kriteria = $_POST['id_kriteria'.$i];
				$nilai = $_POST['nilai'.$i];
				$sql_alternatif_kriteria = mysql_query("update alternatif_kriteria set nilai = '$nilai' where id_sekolah = '$id_sekolah' and id_alternatif = '$id_alternatif' and id_kriteria = '$id_kriteria' and tahun = '$tahun'");
			}
		}
		
		
		
		function tampiltabel($arr)
		{
			echo '<table width="500" border="0" cellspacing="1" cellpadding="3" bgcolor="#000099">';
			  for ($i=0;$i<count($arr);$i++)
			  {
			  echo '<tr>';
				  for ($j=0;$j<count($arr[$i]);$j++)
				  {
					echo '<td bgcolor="#FFFFFF">'.$arr[$i][$j].'</td>';
				  }
			  echo '</tr>';
			  }
			echo '</table>';
		}

		function tampilbaris($arr)
		{
			echo '<table width="500" border="0" cellspacing="1" cellpadding="3" bgcolor="#000099">';
			echo '<tr>';
				  for ($i=0;$i<count($arr);$i++)
				  {
					echo '<td bgcolor="#FFFFFF">'.$arr[$i].'</td>';
				  }
			echo "</tr>";
			echo '</table>';
		}

		function tampilkolom($arr)
		{
			echo '<table width="500" border="0" cellspacing="1" cellpadding="3" bgcolor="#000099">';
		  for ($i=0;$i<count($arr);$i++)
		  {
				echo '<tr>';
					echo '<td bgcolor="#FFFFFF">'.$arr[$i].'</td>';
				echo "</tr>";
		   }
			echo '</table>';
		}
		
		$queryalternatif = mysql_query("SELECT * FROM alternatif ORDER BY id_alternatif");
		$i=0;
		while ($dataalternatif = mysql_fetch_array($queryalternatif))
		{
			$alternatif[$i] = $dataalternatif['alternatif'];
			$i++;
		}
		
		$kriteria = array();

		$x = array();
		
		$costbenefit = array();
		
		$querykriteria = mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria");
		$i=0;
		while ($datakriteria = mysql_fetch_array($querykriteria))
		{
			$kriteria[$i] = $datakriteria['kriteria'];
			$costbenefit[$i] = $datakriteria['costbenefit'];
			$i++;
		}
		
		$queryalternatif = mysql_query("SELECT * FROM alternatif ORDER BY id_alternatif");
		$i=0;
		while ($dataalternatif = mysql_fetch_array($queryalternatif))
		{
			$querykriteria = mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria");
			$j=0;
			while ($datakriteria = mysql_fetch_array($querykriteria))
			{
				$queryalternatifkriteria = mysql_query("SELECT * FROM alternatif_kriteria WHERE id_alternatif = '$dataalternatif[id_alternatif]' AND id_kriteria = '$datakriteria[id_kriteria]' AND id_sekolah = '".$id_sekolah."' AND tahun='".$tahun."'");
				$dataalternatifkriteria = mysql_fetch_array($queryalternatifkriteria);
				
				$x[$i][$j] = $dataalternatifkriteria['nilai'];
				$j++;
			}
			$i++;
		}
		
		$w = array();
		$pakar = mysql_query("select pakar from bobot_kriteria order by pakar");
		$jum_pakar = mysql_num_rows($pakar);
		$jumlah_pakar = (ceil($jum_pakar))-1;
		$kriteria2 = mysql_query("select * from kriteria order by id_kriteria");
		while ($data_kriteria2=mysql_fetch_array($kriteria2)) {
			$jum_bobot = mysql_fetch_assoc(mysql_query("select sum(".str_replace(')','_',str_replace('(','_',str_replace('/','_',str_replace('-','_',str_replace(' ', '_', strtolower($data_kriteria2['kriteria'])))))).") as jumlah_bobot from bobot_kriteria"));
			$jumlah_bobot = $jum_bobot['jumlah_bobot'];
			$rata_rata_eigen = $jumlah_bobot/($jumlah_pakar+1);
			$w[] = $rata_rata_eigen;
		}
		
		for ($i=0;$i<count($kriteria);$i++)
		{
			$nilaimin[$i] = 1000000;
			
			if ($costbenefit[$i] == "cost")
			{
				for ($j=0;$j<count($alternatif);$j++)
				{	
					if ($nilaimin[$i] > $x[$j][$i])
					{
						$nilaimin[$i] = $x[$j][$i];
					}		
				}
			}
			else
			{
				$nilaimin[$i] = -1000000;
			
				for ($j=0;$j<count($alternatif);$j++)
				{	
					if ($nilaimin[$i] < $x[$j][$i])
					{
						$nilaimin[$i] = $x[$j][$i];
					}
				}
			}
		}
		
		$minkar = array();
		for ($i=0;$i<count($alternatif);$i++)
		{
			for ($j=0;$j<count($kriteria);$j++)
			{			
				//if ($j == 0)
				if ($costbenefit[$j] == "cost")
				{
					$minkar[$i][$j] = $nilaimin[$j] / $x[$i][$j]; 
				}
				else
				{
					$minkar[$i][$j] = $x[$i][$j] / $nilaimin[$j]; 
				}
			}
		}
		
		$jmlmin = array();
		for ($i=0;$i<count($kriteria);$i++)
		{
			$jmlmin[$i] = 0;
			for ($j=0;$j<count($alternatif);$j++)
			{			
				$jmlmin[$i] = $jmlmin[$i] + $minkar[$j][$i];
			}
		}
		
		$normmin = array();
		for ($i=0;$i<count($alternatif);$i++)
		{
			for ($j=0;$j<count($kriteria);$j++)
			{			
					$normmin[$i][$j] = $minkar[$i][$j] / $jmlmin[$j]; 
			}
		}
		
		$hsl = array();
		for ($i=0;$i<count($alternatif);$i++)
		{
			$hsl[$i] = 0;
			for ($j=0;$j<count($kriteria);$j++)
			{			
				$hsl[$i] += $normmin[$i][$j] * $w[$j]; 
			}
		}
		
		$alternatifrangking = array();
		$hasilrangking = array();
		
		for ($i=0;$i<count($alternatif);$i++)
		{
			$hasilrangking[$i] = $hsl[$i];
			$alternatifrangking[$i] = $alternatif[$i];
		}
		
		for ($i=0;$i<count($alternatif);$i++)
		{
			for ($j=$i;$j<count($alternatif);$j++)
			{
				if ($hasilrangking[$j] > $hasilrangking[$i])
				{
					$tmphasil = $hasilrangking[$i];
					$tmpalternatif = $alternatifrangking[$i];
					$hasilrangking[$i] = $hasilrangking[$j];
					$alternatifrangking[$i] = $alternatifrangking[$j];
					$hasilrangking[$j] = $tmphasil;
					$alternatifrangking[$j] = $tmpalternatif;
				}
			}
		}
		
		echo'
		<div class="col-md-12">
			<form role="form" id="form1" name="form1" method="post" action="">
			<!-- general form elements disabled -->
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-hammer"></i>Keputusan Perbaikan Akreditasi Sebagai Berikut</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table table-bordered table-striped">
					<tr>
						<thead>
							<th>Ranking</th>
							<th>Alternatif</th>
							<th>Nilai</th>
						</thead>
					</tr>';
					$cek_laporan=mysql_num_rows(mysql_query("select * from laporan where id_sekolah = '".$id_sekolah."' and tahun='".$tahun."'"));
					$jumlah_data_laporan = ceil($cek_laporan);
					if ($jumlah_data_laporan==0) {
						$simpan=mysql_query("insert into laporan(id_sekolah, tahun) values('$id_sekolah', '$tahun')");
					}
					for ($i=0;$i<count($hasilrangking);$i++)
					{
					echo'
					<tbody>
						<tr>
							<td>'.($i+1).'</td>
							<td>'.$alternatifrangking[$i].'</td>
							<td>'.round($hasilrangking[$i], 4, PHP_ROUND_HALF_UP).'</td>
						</tr>
					</tbody>
					';
					$input_data = mysql_query("update laporan set rangking".($i+1)." = '".$alternatifrangking[$i]."', bobot".($i+1)." = '".$hasilrangking[$i]."' where id_sekolah='".$id_sekolah."' and tahun='".$tahun."'");
					}
				echo'
				</table>
				<div class="callout callout-success"><p>Alternatif Terbaik Adalah <strong>'.$alternatifrangking[0].'</strong> dengan Nilai Terbesar = <strong>'.round($hasilrangking[0], 4, PHP_ROUND_HALF_UP).'</strong></p></div>
				<hr>
					<a class="btn btn-success" href="modul/penilaian_dan_lihat_keputusan/print_keputusan.php?modul='.$_GET['modul'].'&aksi=print_keputusan" target="new_window()"><i class="fa fa-print"></i>Print</a>
					<button type="button" class="btn btn-danger" onclick="self.history.back()" style="float:right;"><i class="fa fa-backward"></i> <span>Kembali</span></button>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>';
	break;
	
	case "tambah":
	error_reporting(0);
	echo '
		<div class="col-md-12">
			<form role="form" enctype="multipart/form-data" action="index2.php?modul='.$_GET['modul'].'&aksi=hitung" method="post">
			<!-- general form elements disabled -->
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-edit"></i> Isilah Data Penilaian Berikut Sesuai Kondisi Sekolah Anda Saat Ini</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table table-bordered table-striped">
					';
					$id_kriteria = array();
					$kriteria = array();
					$querykriteria = mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria");
					while ($datakriteria = mysql_fetch_array($querykriteria)) {
						$idkriteria = $datakriteria['id_kriteria'];
						$namakriteria = $datakriteria['kriteria'];
						$id_kriteria[] = $idkriteria;
						$kriteria[] = $namakriteria;
					}
					$jum_kriteria	= mysql_num_rows($querykriteria);
					$jumlah_kriteria = ceil($jum_kriteria);
					
					$no_nama=1;
					for($i=1; $i<=$jumlah_kriteria; $i++) {
						$pertanyaan[$i] = array();
						echo'	
						<thead>
							<tr>
								<th>Nomor</th>
								<th>Alternatif</th>
								<th>Perkiraan Alokasi '.$kriteria[$i-1].' Untuk Tiap Standar</th>
							</tr>
						</thead>';
						$queryalternatif[$i] = mysql_query("SELECT * FROM alternatif ORDER BY id_alternatif");
						
						$no=1;
						while ($dataalternatif[$i] = mysql_fetch_array($queryalternatif[$i]))
						{
							if ($kriteria[$i-1] <> 'Bobot BAN-S/M') {
							$sql_pertanyaan = "SELECT a . * , b.kriteria
												FROM pertanyaan_kuisioner a, kriteria b
												WHERE a.id_kriteria = b.id_kriteria
												AND a.id_kriteria =  '".$id_kriteria[$i-1]."' order by a.id_pertanyaan";
							$pertanyaan = mysql_query($sql_pertanyaan);
							$jum_pertanyaan = mysql_num_rows($pertanyaan);
							$jumlah_pertanyaan = ceil($jum_pertanyaan);
							}
							if ($kriteria[$i-1] == 'Bobot BAN-S/M') {
								$sql_pertanyaan = "SELECT a . * , b.kriteria
												FROM pertanyaan_kuisioner a, kriteria b
												WHERE a.id_kriteria = b.id_kriteria
												AND a.id_kriteria =  '".$id_kriteria[$i-1]."' order by a.id_pertanyaan";
								$pertanyaan = mysql_query($sql_pertanyaan);
								$jum_pertanyaan = mysql_num_rows($pertanyaan);
								$jumlah_pertanyaan = ceil($jum_pertanyaan);
							}
							echo'
						<tbody>
							<tr>
								<td rowspan="'.($jumlah_pertanyaan+1).'" style="background-color:#ffffff;">
									<input type="hidden" name="id_alternatif'.$no_nama.'" class="form-control" value="'.$dataalternatif[$i]['id_alternatif'].'" readonly/>'.$no.'
								</td>
								<td rowspan="'.($jumlah_pertanyaan+1).'" style="background-color:#ffffff;">
									<input type="hidden" name="id_kriteria'.$no_nama.'" class="form-control" value="'.$id_kriteria[$i-1].'" readonly/>'.$dataalternatif[$i]['alternatif'].'
								</td>';
								if ($kriteria[$i-1] <> 'Bobot BAN-S/M') {
									while ($data_pertanyaan = mysql_fetch_array($pertanyaan)) {
										echo'
										<tr>
											<td style="background-color:#ffffff;">
												<input type="radio" name="nilai'.$no_nama.'" class="form-control" value="'.$data_pertanyaan['nilai'].'"> '.$data_pertanyaan['pertanyaan'].'
											</td>
										</tr>';
									}
								}
								if ($kriteria[$i-1] == 'Bobot BAN-S/M') {
									$data_pertanyaan_perstandar = array();
									$data_nilai_perstandar = array();
									while ($data_pertanyaan = mysql_fetch_array($pertanyaan)) {
										$sql_pertanyaan1 = "SELECT a . * , b.kriteria
															FROM pertanyaan_kuisioner a, kriteria b
															WHERE a.id_kriteria = b.id_kriteria
															AND a.id_kriteria =  '".$id_kriteria[$i-1]."' and a.pertanyaan = '".$data_pertanyaan['pertanyaan']."' order by a.id_pertanyaan";
										$pertanyaan1 = mysql_query($sql_pertanyaan1);
										$data_pertanyaan1 = mysql_fetch_array($pertanyaan1);
										$data_pertanyaan_perstandar[] = $data_pertanyaan1['pertanyaan'];
										$data_nilai_perstandar[] = $data_pertanyaan1['nilai'];
									}
									$w=$no-1;
									for ($z=$w; $z<=count($data_pertanyaan_perstandar)-1;) {
										echo'
										<tr>
											<td style="background-color:#ffffff;">
												<input type="radio" name="nilai'.$no_nama.'" class="form-control" value="'.$data_nilai_perstandar[$z].'"'; if ($data_nilai_perstandar[$z]==$data_nilai_perstandar[$z]) {echo'checked';}echo'> '.$data_pertanyaan_perstandar[$z].'
											</td>
										</tr>';
										break;
									}
								}
								echo'
							</tr>
						</tbody>
							';
						$no++;
						$no_nama++;
						}
					}
					echo'
					</table>
				 <hr>
					<input type="submit" class="btn btn-success" name="button">
					<button type="reset" class="btn btn-warning">Reset</button>
					<button type="button" class="btn btn-danger" onclick="self.history.back()" style="float:right;"><i class="fa fa-backward"></i> <span>Kembali</span></button>
			</form>
					</div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>';
break;
}
?>