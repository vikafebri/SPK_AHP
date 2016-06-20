<?php
session_start();
?>
<!-- bootstrap 3.0.2 -->
<link href="../../css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

<?php
include '../../config/koneksi.php';
include '../../lib/fungsi.php';

switch ($_GET['aksi'])
{
case "print_keputusan";
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
		<h2>
			<center>Pendukung Keputusan Perbaikan Akreditasi Sekolah '.$nama_sekolah.' Pada Tahun '.date('Y').'</center>
		</h2>
		<hr>
		<div class="clear"></div>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Urutan Prioritas Perbaikan Akreditasi</th>
						<th>Alternatif (Standar Akreditasi)</th>
						<th>Bobot Akhir</th>
					</tr>
				</thead>
				<tbody>';	
				for ($no=1; $no<=8; $no++) {
					echo '
					<tr>
						<td>'.$no.'</td>
						<td>'.$rangking[$no].'</td>
						<td>'.round($bobot[$no], 4, PHP_ROUND_HALF_UP).'</td>
					</tr>
					';
				}
				echo'
				</tbody>
			</table>
		<div class="callout callout-success" style="border-color: #00733e !important; background-color: #00a65a !important;"><p style="color: #fff !important;">Alternatif Terbaik Adalah <strong style="color: #fff !important;">'.$rangking[1].'</strong> dengan Nilai Terbesar = <strong style="color: #fff !important;">'.round($bobot[1], 4, PHP_ROUND_HALF_UP).'</strong></p></div>
	';
break;
}
?>
<script type='application/javascript'>window.onload=function(){window.print()}</script>