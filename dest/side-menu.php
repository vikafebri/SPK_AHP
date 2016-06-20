                <!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
                    <!-- Sidebar user panel -->
					<div class="user-panel bg-header">
                        <div class="pull-left image">
							<img src="<?php if ($_SESSION['status_login'] == 'Administrator') {echo''.$_SESSION['photo'].'';}else{echo''.$_SESSION['photo'].'';}?>" class="img-circle" alt="User Image" />
                        </div>
						<div class="pull-left info">
							<p><?php if ($_SESSION['status_login'] == 'Administrator') {echo 'Admin-Super';}else{echo''.$_SESSION['nama'].'';}?></p>

							<a href="index2.php?modul=edit_profil&aksi=edit_profil"><i class="fa fa-edit"></i> Edit Profil</a>
                        </div>
                    </div>
                    <!-- search form -->
                   
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    
					<ul class="sidebar-menu">
						<?php
						if ($_SESSION['status_login']=='Administrator'){
						?>
						<li class="bg-menu">
							<a href="index2.php?modul=default&aksi=beranda"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
						</li>
						<li class="treeview bg-menu">
									<a href="#">
										<i class="fa fa-cloud"></i> <span>Data Master</span>
										<i class="fa fa-angle-left pull-right"></i>
									</a>
									<ul class="treeview-menu">
										<li><a href="index2.php?modul=sekolah&aksi=tampil"><i class="fa fa-angle-double-right"></i>Sekolah</a></li>
										<li><a href="index2.php?modul=admin_sekolah&aksi=tampil"><i class="fa fa-angle-double-right"></i>Admin Sekolah</a></li>
										<li><a href="index2.php?modul=kadis&aksi=tampil"><i class="fa fa-angle-double-right"></i>Kadis</a></li>
										<li><a href="index2.php?modul=upa&aksi=tampil"><i class="fa fa-angle-double-right"></i>UPA</a></li>
									</ul>
						</li>
						<li class="bg-menu">
								<a href="index2.php?modul=hak_akses&aksi=tampil"><i class="fa fa-user"></i> <span>Hak Akses</span></a>
						</li>
						<li class="treeview bg-menu">
									<a href="#">
										<i class="fa fa-table"></i> <span>Data Kriteria</span>
										<i class="fa fa-angle-left pull-right"></i>
									</a>
									<ul class="treeview-menu">
										<li><a href="index2.php?modul=kriteria&aksi=tampil"><i class="fa fa-angle-double-right"></i>Kriteria</a></li>
										<li><a href="index2.php?modul=bobot_kriteria&aksi=tampil"><i class="fa fa-angle-double-right"></i>Bobot Kriteria</a></li>
									</ul>
						</li>
                        <li class="treeview bg-menu">
									<a href="#">
										<i class="fa fa-table"></i> <span>Data Alternatif</span>
										<i class="fa fa-angle-left pull-right"></i>
									</a>
									<ul class="treeview-menu">
										<li><a href="index2.php?modul=alternatif&aksi=tampil"><i class="fa fa-angle-double-right"></i>Alternatif</a></li>
										<li><a href="index2.php?modul=bobot_alternatif&aksi=tampil"><i class="fa fa-angle-double-right"></i>Bobot Alternatif</a></li>
									</ul>
						</li>
						<li class="bg-menu">
								<a href="index2.php?modul=pertanyaan_kuisioner&aksi=tampil"><i class="fa fa-question-circle"></i> <span>Pertanyaan Kuisioner</span></a>
						</li>
						<?php
						}
						?>
						
						<?php
							if ($_SESSION['status_login']=='Kadis'){
						?>
							<li class="bg-menu">
								<a href="index2.php?modul=default&aksi=beranda"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
							</li>
							<li class="bg-menu">
								<a href="index2.php?modul=sekolah&aksi=tampil"><i class="fa fa-building-o"></i> <span>Data Sekolah</span></a>
							</li>
							<li class="bg-menu">
								<a href="index2.php?modul=perbaikan_akreditasi&aksi=pilih_tahun"><i class="fa fa-signal"></i> <span><p style="padding-left:1.8em; margin-top:-20px; margin-bottom:0;">Laporan Perbaikan Akreditasi Sekolah</p></span></a>
							</li>
						<?php
							}
						?>
						
						<?php
							if ($_SESSION['status_login']=='UPA'){
						?>
							<li class="bg-menu">
								<a href="index2.php?modul=default&aksi=beranda"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
							</li>
							<li class="treeview bg-menu">
									<a href="#">
										<i class="fa fa-table"></i> <span>Data Kriteria</span>
										<i class="fa fa-angle-left pull-right"></i>
									</a>
									<ul class="treeview-menu">
										<li><a href="index2.php?modul=kriteria&aksi=tampil"><i class="fa fa-angle-double-right"></i>Kriteria</a></li>
										<li><a href="index2.php?modul=bobot_kriteria&aksi=tampil"><i class="fa fa-angle-double-right"></i>Bobot Kriteria</a></li>
									</ul>
							</li>
							<li class="treeview bg-menu">
										<a href="#">
											<i class="fa fa-table"></i> <span>Data Alternatif</span>
											<i class="fa fa-angle-left pull-right"></i>
										</a>
										<ul class="treeview-menu">
											<li><a href="index2.php?modul=alternatif&aksi=tampil"><i class="fa fa-angle-double-right"></i>Alternatif</a></li>
											<li><a href="index2.php?modul=bobot_alternatif&aksi=tampil"><i class="fa fa-angle-double-right"></i>Bobot Alternatif</a></li>
										</ul>
							</li>
						<?php
							}
						?>
						
						<?php
							if ($_SESSION['status_login']=='Admin Sekolah'){
							$cek_data = mysql_num_rows(mysql_query("select * from alternatif_kriteria where id_sekolah = '".$_SESSION["id_sekolah"]."' and tahun='".date('Y')."'"));
							$jumlah_data = ceil($cek_data);
							if ($jumlah_data == 0) {
								$aksi = 'tambah';
							}else {
								$aksi = 'tampil';
							}
							$cek_tahun = mysql_fetch_assoc(mysql_query("select max(tahun) as tahun_terakhir from laporan where id_sekolah = '".$_SESSION['id_sekolah']."'"));
							$tahun_terakhir = $cek_tahun['tahun_terakhir'];
							$tahun_berikutnya = $tahun_terakhir+2;
							
							echo'
							<script language="javaScript">
							function konfirmasi()
							{
								alert("Anda Tidak Sedang Dalam Waktu Perbaikan Akreditasi");
							}								
							</script>
							';
						?>
							<li class="bg-menu">
								<a href="index2.php?modul=default&aksi=beranda"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
							</li>
							<li class="bg-menu">
								<a href="index2.php?modul=sekolah&aksi=tampil"><i class="fa fa-building-o"></i> <span>Profil Sekolah</span></a>
							</li>
							<li class="bg-menu">
								<a href="index2.php?modul=galeri_sekolah&aksi=tampil"><i class="fa fa-picture-o"></i> <span>Galeri Sekolah</span></a>
							</li>
							<li class="bg-menu">
								<a href="<?php if (date('Y')>=$tahun_berikutnya || date('Y')==$tahun_terakhir) {echo'index2.php?modul=penilaian_dan_lihat_keputusan&aksi='.$aksi.'';}else{echo'index2.php?modul=default&aksi=beranda';} ?>" <?php if (date('Y')>=$tahun_berikutnya || date('Y')==$tahun_terakhir) {echo'';}else{echo'onclick="return konfirmasi()"';} ?>><i class="fa fa-legal"></i> <span>Penilaian & Keputusan</span></a>
							</li>
						<?php
							}
						?>
                    </ul>
                </section>
                <!-- /.sidebar -->