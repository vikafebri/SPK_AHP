<!-- bootstrap 3.0.2 -->
<link href="../../../css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link href="../../../js/plugins/morris/prettify.min.css" rel="stylesheet" type="text/css" />
<link href="../../../js/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<script src="../../../js/jquery.min.js" type="text/javascript"></script>
<script src="../../../js/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="../../../js/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="../../../js/plugins/morris/morris.js" type="text/javascript"></script>
<script src="../../../js/plugins/morris/prettify.min.js" type="text/javascript"></script>
<script src="../../../js/plugins/morris/lib/example.js" type="text/javascript"></script>

<?php
include '../../../config/koneksi.php';
include '../../../lib/fungsi.php';

$tentang = $_POST['isi'];

switch ($_GET['aksi'])
{
case "cetak_laporan_perbaikan_akreditasi";
	$pilih_tahun = $_POST['pilih_tahun'];
	$alternatif = mysql_query("select * from alternatif order by id_alternatif");
	$alternatif1 = mysql_query("select * from alternatif order by id_alternatif");
	$alternatif2 = mysql_query("select * from alternatif order by id_alternatif");
	$alternatif3 = mysql_query("select * from alternatif order by id_alternatif");
	
	$laporan_sekolah = mysql_query("select a.*, b.nama_sekolah from laporan a, sekolah b where a.id_sekolah = b.id_sekolah and tahun = '".$pilih_tahun."'");
	
	echo ' 
					<div class="box-body">
					<table>
						<tr><td width=1200 align="center"><h4>LAPORAN PERBAIKAN AKREDITASI SEKOLAH</h4></td></tr>
						<tr><td width=1200 align="center"><h4>PADA TAHUN '.$pilih_tahun.'</h4></td></tr>
					</table>
					<div id="graph"></div>
					<div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-white">
                        <div class="box-headers">
                            <h4 class="box-title">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed"></a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;">
                            <div class="box-body">
								<pre id="code" class="prettyprint linenums">
								// Use Morris.Bar
								Morris.Bar({
									element: "graph",
										data: [
											{x: "Grafik Perbaikan Akreditasi Sekolah Berdasarkan Alternatif Pada Tahun '.$pilih_tahun.'",';
											while($data_alternatif = mysql_fetch_array($alternatif)) {
												$data_laporan = mysql_fetch_assoc(mysql_query("select count(rangking1) as jumlah_data from laporan where rangking1='".$data_alternatif["alternatif"]."' and tahun='".$pilih_tahun."'"));
											echo'
											'.str_replace(' ','_',strtolower($data_alternatif['alternatif'])).': '.$data_laporan['jumlah_data'].',&nbsp
											';
											}
											echo'
											}
										],
										xkey: "x",
										ykeys: [';
										while($data_alternatif1 = mysql_fetch_array($alternatif1)) {
											echo'
												"'.str_replace(' ','_',strtolower($data_alternatif1['alternatif'])).'",&nbsp
											';
										}
										echo'
										],
										labels: [';
										while($data_alternatif2 = mysql_fetch_array($alternatif2)) {
											echo'
												"'.$data_alternatif2['alternatif'].'",&nbsp
											';
										}
										echo'
										]
								}).on("click", function(i, row){
								console.log(i, row);
								});
								</pre>
							</div>
                        </div>
					</div>
					</div>
					<div class="row">
					<div class="col-lg-6 col-xs-6">
						<small><strong>Tabel 1.</strong> Jumlah Perbaikan Akreditasi Berdasarkan Alternatif Pada Tahun '.$pilih_tahun.'</small>
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Alternatif Perbaikan</th>
									<th>Banyak Sekolah</th>
								</tr>
							</thead>
							<tbody>';
								while($data_alternatif3 = mysql_fetch_array($alternatif3)) {
								$data_laporan2 = mysql_fetch_assoc(mysql_query("select count(rangking1) as jumlah_data from laporan where rangking1='".$data_alternatif3["alternatif"]."' and tahun='".$pilih_tahun."'"));
									echo'
										<tr>
											<td>'.$data_alternatif3['alternatif'].'</td>
											<td>'.$data_laporan2['jumlah_data'].'</td>
										</tr>
									';
								}
							echo'
							</tbody>
						</table>
					</div>
					<div class="col-lg-6 col-xs-6">
						<small><strong>Tabel 2.</strong> Daftar Sekolah Yang Melakukan Perbaikan Akreditasi Pada Tahun '.$pilih_tahun.'</small>
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nama Sekolah</th>
									<th>Alternatif Terbaik</th>
								</tr>
							</thead>
							<tbody>';
								while($data_laporan_sekolah = mysql_fetch_array($laporan_sekolah)) {
									echo'
										<tr>
											<td>'.$data_laporan_sekolah['nama_sekolah'].'</td>
											<td>'.$data_laporan_sekolah['rangking1'].'</td>
										</tr>
									';
								}
							echo'
							</tbody>
						</table>
					</div>
					</div>
				</div><!-- /.box-body -->
				';
break;
}
?>
<script type='application/javascript'>window.onload=function(){window.print()}</script>