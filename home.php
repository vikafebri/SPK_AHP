<?php
session_start();
include "cek.php";
include 'lib/fungsi.php';
$id=$_SESSION['status_login'] ;
?>
<?php
switch($_GET['aksi'])//case untuk menampilkan data
	{	
		case"beranda";
		$gambar = mysql_query("select * from galeri_sekolah where id_sekolah='".$_SESSION['id_sekolah']."'");
		$sekolah = mysql_fetch_assoc(mysql_query("select * from sekolah where id_sekolah = '".$_SESSION['id_sekolah']."'"));
		$nama_sekolah = $sekolah['nama_sekolah'];
		if ($id=='Admin Sekolah') {
			echo'
				<h2>
                    Selamat datang
                </h2>
				<div class="clear"></div>
					<h4>Ini adalah Halaman utama Sistem Pendukung Keputusan Perbaikan Akreditasi Sekolah Dengan Menggunakan Metode AHP</h4>
					<div class="row">
						<div id="jssor_html5_AdWords" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 800px; height: 450px; overflow: hidden; visibility: hidden;">
						<!-- Loading Screen -->
						<div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
							<div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
							<div style="position:absolute;display:block;background:url("img/loading.gif") no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
						</div>
								<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 800px; height: 450px; overflow: hidden;">';
									while ($data_gambar = mysql_fetch_array($gambar)) {
										echo'
										<div data-p="68.75" style="display: none;">
											<img data-u="image" src="'.$data_gambar['foto'].'">
											<div data-u="caption" data-t="0" data-3d="1" data-to="100% 50%" style="position: absolute; top: 0px; left: 0px; width: 305px; height: 40px; background-color: #ffffff; font-size: 26px; line-height: 40px; text-align: center;">Galeri Sekolah</div>
											<div data-u="caption" data-t="3" style="position: absolute; top: 20px; left: 0px; width: 305px; height: 100px; background-color: #f65256; font-size: 26px; color: #ffffff; line-height: 40px; text-align: center;">'.$nama_sekolah.'</div>
										</div>
										';
									}
								echo'
								</div>
						<!-- Bullet Navigator -->
						<div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
							<!-- bullet navigator item prototype -->
							<div data-u="prototype" style="width:16px;height:16px;"></div>
						</div>
						<!-- Arrow Navigator -->
						<span data-u="arrowleft" class="jssora12l" style="top:0px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
						<span data-u="arrowright" class="jssora12r" style="top:0px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
					</div>
			';
		}else {
			$alternatif = mysql_query("select * from alternatif order by id_alternatif");
			$alternatif1 = mysql_query("select * from alternatif order by id_alternatif");
			$alternatif2 = mysql_query("select * from alternatif order by id_alternatif");
			echo'	
					<h2>
                        Selamat datang
                    </h2>
					<div class="clear"></div>
					<h1 class="widgettitle"><marquee>Sistem Pendukung Keputusan Perbaikan Akreditasi Sekolah Dengan Menggunakan Metode AHP</marquee></h1>
					<div class="row">
						<div id="graph"></div>
						<div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                        <div class="panel box box-white">
                                            <div class="box-headers">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;">
                                                <div class="box-body">
													<pre id="code" class="prettyprint linenums">
													// Use Morris.Bar
													Morris.Bar({
													  element: "graph",
													  data: [
														{x: "Grafik Perbaikan Akreditasi Sekolah Pada Tahun Sekarang ('.date('Y').')",';
															while($data_alternatif = mysql_fetch_array($alternatif)) {
																$data_laporan = mysql_fetch_assoc(mysql_query("select count(rangking1) as jumlah_data from laporan where rangking1='".$data_alternatif["alternatif"]."' and tahun='".date("Y")."'"));
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
                    </div>
			';
		}
		break;
	}
?>

<script type="text/javascript" src="js/jssor/jssor.slider.min.js"></script>
<!-- use jssor.slider.debug.js instead for debug -->
<script>
	jssor_html5_AdWords_slider_init = function() {
								
	var jssor_html5_AdWords_SlideoTransitions = [
	[{b:-1,d:1,o:-1,rY:-120},{b:2600,d:500,o:1,rY:120,e:{rY:17}}],
	[{b:-1,d:1,o:-1},{b:1480,d:20,o:1},{b:1500,d:500,y:-20,e:{y:19}},{b:2300,d:300,x:-20,e:{x:19}},{b:3100,d:300,o:-1,sY:9}],
	[{b:-1,d:1,o:-1},{b:2300,d:300,x:20,o:1,e:{x:19}},{b:3100,d:300,o:-1,sY:9}],
	[{b:-1,d:1,sX:-1,sY:-1},{b:0,d:1000,sX:2,sY:2,e:{sX:7,sY:7}},{b:1000,d:500,sX:-1,sY:-1,e:{sX:16,sY:16}},{b:1500,d:500,y:20,e:{y:19}}],
	[{b:1000,d:1000,r:-30},{b:2000,d:500,r:30,e:{r:2}},{b:2500,d:500,r:-30,e:{r:3}},{b:3000,d:3000,x:70,y:40,rY:-20,tZ:-20}],
	[{b:-1,d:1,o:-1},{b:0,d:1000,o:1}],
	[{b:-1,d:1,o:-1,r:30},{b:1000,d:1000,o:1}],
	[{b:-1,d:1,o:-1},{b:2780,d:20,o:1},{b:2800,d:500,y:-70,e:{y:3}},{b:3300,d:1000,y:180},{b:4300,d:500,y:-40,e:{y:3}},{b:5300,d:500,y:-40,e:{y:3}},{b:6300,d:500,y:-40,e:{y:3}},{b:7300,d:500,y:-40,e:{y:3}},{b:8300,d:400,y:-30}],
	[{b:-1,d:1,c:{y:200}},{b:4300,d:4400,c:{y:-200},e:{c:{y:1}}}],
	[{b:-1,d:1,o:-1},{b:4300,d:20,o:1}],
	[{b:-1,d:1,o:-1},{b:5300,d:20,o:1}],
	[{b:-1,d:1,o:-1},{b:6300,d:20,o:1}],
	[{b:-1,d:1,o:-1},{b:7300,d:20,o:1}],
	[{b:-1,d:1,o:-1},{b:8300,d:20,o:1}],
	[{b:2000,d:1000,o:-0.5,r:180,sX:4,sY:4,e:{r:5,sX:5,sY:5}},{b:3000,d:1000,o:-0.5,r:180,sX:-4,sY:-4,e:{r:6,sX:6,sY:6}}],
	[{b:-1,d:1,o:-1,c:{m:-35.0}},{b:0,d:1500,x:150,o:1,e:{x:6}}],
	[{b:-1,d:1,o:-1,c:{y:35.0}},{b:0,d:1500,x:-150,o:1,e:{x:6}}],
	[{b:-1,d:1,o:-1},{b:6500,d:2000,o:1}],
	[{b:-1,d:1,o:-1},{b:2000,d:1000,o:0.5,r:180,sX:4,sY:4,e:{r:5,sX:5,sY:5}},{b:3000,d:1000,o:0.5,r:180,sX:-4,sY:-4,e:{r:6,sX:6,sY:6}},{b:4500,d:1500,x:-45,y:60,e:{x:12,y:3}}],
	[{b:-1,d:1,o:-1},{b:4500,d:1500,o:1,e:{o:5}},{b:6500,d:2000,o:-1,r:10,rX:30,rY:20,e:{rY:6}}]
	];
								
	var jssor_html5_AdWords_options = {
	$AutoPlay: true,
	$Idle: 1600,
	$SlideDuration: 400,
	$SlideEasing: $Jease$.$InOutSine,
		$CaptionSliderOptions: {
			$Class: $JssorCaptionSlideo$,
				$Transitions: jssor_html5_AdWords_SlideoTransitions
		},
		$ArrowNavigatorOptions: {
			$Class: $JssorArrowNavigator$,
				$ChanceToShow: 1
		},
		$BulletNavigatorOptions: {
			$Class: $JssorBulletNavigator$,
				$ActionMode: 2
		}
	};
								
	var jssor_html5_AdWords_slider = new $JssorSlider$("jssor_html5_AdWords", jssor_html5_AdWords_options);
	};
</script>
						
<style>
						
	/* jssor slider bullet navigator skin 05 css */
	/*
	.jssorb05 div           (normal)
	.jssorb05 div:hover     (normal mouseover)
	.jssorb05 .av           (active)
	.jssorb05 .av:hover     (active mouseover)
	.jssorb05 .dn           (mousedown)
	*/
	.jssorb05 {
	position: absolute;
	}
	.jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
	position: absolute;
	/* size of bullet elment */
	width: 16px;
	height: 16px;
	background: url('img/b05.png') no-repeat;
	overflow: hidden;
	cursor: pointer;
	}
	.jssorb05 div { background-position: -7px -7px; }
	.jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }
	.jssorb05 .av { background-position: -67px -7px; }
	.jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }

	/* jssor slider arrow navigator skin 12 css */
	/*
	.jssora12l                  (normal)
	.jssora12r                  (normal)
	.jssora12l:hover            (normal mouseover)
	.jssora12r:hover            (normal mouseover)
	.jssora12l.jssora12ldn      (mousedown)
	.jssora12r.jssora12rdn      (mousedown)
	*/
	.jssora12l, .jssora12r {
		display: block;
		position: absolute;
		/* size of arrow element */
		width: 30px;
		height: 46px;
		cursor: pointer;
		background: url('img/a12.png') no-repeat;
	overflow: hidden;
	}
	.jssora12l { background-position: -16px -37px; }
	.jssora12r { background-position: -75px -37px; }
	.jssora12l:hover { background-position: -136px -37px; }
	.jssora12r:hover { background-position: -195px -37px; }
	.jssora12l.jssora12ldn { background-position: -256px -37px; }
	.jssora12r.jssora12rdn { background-position: -315px -37px; }
</style>

<script>
	jssor_html5_AdWords_slider_init();
</script>