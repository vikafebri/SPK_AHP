<?php
$modul=isset($_GET['aksi']) ?$_GET['aksi'] : '';
include 'lib/kode_auto.php';
include 'lib/fungsi.php';

switch ($modul) {
	case "tampil":
	$sql_tampil = "select * from kadis order by nip";
	$run_sql = mysql_query($sql_tampil);
	$hak_akses = 'Kadis';
	
	$sql_tampil1 = "select * from upa order by nip";
	$run_sql1 = mysql_query($sql_tampil1);
	$hak_akses1 = 'UPA';
	
	$sql_tampil2 = "select a.*, b.* from admin_sekolah a, sekolah b where a.id_sekolah = b.id_sekolah order by nip";
	$run_sql2 = mysql_query($sql_tampil2);
	$hak_akses2 = 'Admin Sekolah';
	
	echo '
		<div class="clear"></div>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>NIP</th>
						<th>Nama</th>
						<th>Hak Akses</th>
						<th>Nama Sekolah</th>
						<th>Status Hak Akses</th>
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
						<td>'.$hak_akses.'</td>
						<td>-</td>';
						$hak_akses_kadis = mysql_num_rows(mysql_query("select * from hak_akses where id ='".$data["nip"]."'"));
						echo'
						<td>
							<div class="btn-group ">';
								if (ceil($hak_akses_kadis) == '1') {
									echo'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Aktif</span></button>
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="margin-left: -15px;">
											   <li><a class="logdrop1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=aktifkan&nip='.$data['nip'].'&hak_akses='.$hak_akses.'">Aktif</li>
											   <li><a class="logdrop1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=nonaktifkan&nip='.$data['nip'].'&hak_akses='.$hak_akses.'">Non Aktif</li>
										</ul>';
								}
								else if (ceil($hak_akses_kadis) == '0') {
									echo'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Non Aktif</span></button>
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="margin-left: -15px;">
											   <li><a class="logdrop1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=aktifkan&nip='.$data['nip'].'&hak_akses='.$hak_akses.'">Aktif</li>
											   <li><a class="logdrop1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=nonaktifkan&nip='.$data['nip'].'&hak_akses='.$hak_akses.'">Non Aktif</li>
										</ul>';
								}
						echo'
						</td>
					</tr>';
					$no++;
					}
					while ($data1=mysql_fetch_array($run_sql1)) {
					echo '
					<tr>
						<td>'.$no.'</td>
						<td>'.$data1['nip'].'</td>
						<td>'.$data1['nama'].'</td>
						<td>'.$hak_akses1.'</td>
						<td>-</td>';
						$hak_akses_upa = mysql_num_rows(mysql_query("select * from hak_akses where id ='".$data1["nip"]."'"));
						echo'
						<td>
							<div class="btn-group ">';
								if (ceil($hak_akses_upa) == '1') {
									echo'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Aktif</span></button>
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="margin-left: -15px;">
											   <li><a class="logdrop1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=aktifkan&nip='.$data1['nip'].'&hak_akses='.$hak_akses1.'">Aktif</li>
											   <li><a class="logdrop1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=nonaktifkan&nip='.$data1['nip'].'&hak_akses='.$hak_akses1.'">Non Aktif</li>
										</ul>';
								}
								else if (ceil($hak_akses_upa) == '0') {
									echo'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Non Aktif</span></button>
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="margin-left: -15px;">
											   <li><a class="logdrop1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=aktifkan&nip='.$data1['nip'].'&hak_akses='.$hak_akses1.'">Aktif</li>
											   <li><a class="logdrop1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=nonaktifkan&nip='.$data1['nip'].'&hak_akses='.$hak_akses1.'">Non Aktif</li>
										</ul>';
								}
						echo'
						</td>
					</tr>';
					$no++;
					}
					while ($data2=mysql_fetch_array($run_sql2)) {
					echo '
					<tr>
						<td>'.$no.'</td>
						<td>'.$data2['nip'].'</td>
						<td>'.$data2['nama'].'</td>
						<td>'.$hak_akses2.'</td>
						<td>'.$data2['nama_sekolah'].'</td>';
						$hak_admin_sekolah = mysql_num_rows(mysql_query("select * from hak_akses where id ='".$data2["nip"]."'"));
						echo'
						<td>
							<div class="btn-group ">';
								if (ceil($hak_admin_sekolah) == '1') {
									echo'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Aktif</span></button>
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="margin-left: -15px;">
											   <li><a class="logdrop1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=aktifkan&nip='.$data2['nip'].'&hak_akses='.$hak_akses2.'">Aktif</li>
											   <li><a class="logdrop1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=nonaktifkan&nip='.$data2['nip'].'&hak_akses='.$hak_akses2.'">Non Aktif</li>
										</ul>';
								}
								else if (ceil($hak_admin_sekolah) == '0') {
									echo'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Non Aktif</span></button>
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="margin-left: -15px;">
											   <li><a class="logdrop1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=aktifkan&nip='.$data2['nip'].'&hak_akses='.$hak_akses2.'">Aktif</li>
											   <li><a class="logdrop1" href="modul/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=nonaktifkan&nip='.$data2['nip'].'&hak_akses='.$hak_akses2.'">Non Aktif</li>
										</ul>';
								}
						echo'
						</td>
					</tr>';
					$no++;
					}
				echo'
				</tbody>
			</table>
			';
	break;
}
?>