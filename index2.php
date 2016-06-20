<?php
session_start();
include "cek.php";
$id=$_SESSION['status_login'];
?>

<?php

// begin the session
session_start();
include 'config/koneksi.php';	
// store session data
unset($_SESSION['temp']); 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<title>Sistem Pendukung Keputusan Dengan Metode AHP</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="js/plugins/morris/prettify.min.css" rel="stylesheet" type="text/css" />
        <link href="js/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- Data Table -->
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    </head>
    <body class="skin-blue">
	<div id="loadinge" class="pro hide" >
	  <img id="loading-image" src="images/loading.gif" alt="Loading..." />
	 </div>

        <!-- header logo: style can be found in header.less -->
        <header class="header">
			<?php include"dest/header.php";?>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
			<aside class="left-side sidebar-offcanvas bg-sidebar">
				<?php include"dest/side-menu.php";?>
            </aside>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
				<section class="content-header bg-menu text-menu">
					<h1>
						<i class="fa fa-table"></i> <span class="capitalize"><?php if ($_GET['modul'] == 'default') {$_GET['modul'] = 'Dashboard';} if(isset($_GET['modul'])){echo ucwords(str_replace("_"," ", $_GET['modul']));} ?></span>
						<small>Control panel</small>
					</h1>
                    <ol class="breadcrumb">
                        <li><a href="index2.php?modul=default&aksi=beranda"><i class="fa fa-dashboard"></i> Beranda</a></li>
                        <li class="active"> <span class="capitalize"><?php if(isset($_GET['modul'])){echo ucwords(str_replace("_"," ", $_GET['modul']));}?></span></li>
                    </ol>
                </section>
                <!-- Main content -->
				<section class="content bg-content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
						
                    </div><!-- /.row -->

                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                    <?php
					$modul=isset($_GET['modul']) ?$_GET['modul'] : '';
					switch($modul){
						default;
						include"home.php";
						break;
						case"sekolah";
							include"modul/sekolah/sekolah.php";
						break;
						case"admin_sekolah";
							include"modul/admin_sekolah/admin_sekolah.php";
						break;
						case"kadis";
							include"modul/kadis/kadis.php";
						break;
						case"upa";
							include"modul/upa/upa.php";
						break;
						case"kriteria";
							include"modul/kriteria/kriteria.php";
						break;
						case"bobot_kriteria";
							include"modul/bobot_kriteria/bobot_kriteria.php";
						break;
						case"alternatif";
							include"modul/alternatif/alternatif.php";
						break;
						case"bobot_alternatif";
							include"modul/bobot_alternatif/bobot_alternatif.php";
						break;
						case"pertanyaan_kuisioner";
							include"modul/pertanyaan_kuisioner/pertanyaan_kuisioner.php";
						break;
						case"penilaian_dan_lihat_keputusan";
							include"modul/penilaian_dan_lihat_keputusan/penilaian_dan_lihat_keputusan.php";
						break;
						case"hak_akses";
							include"modul/hak_akses/hak_akses.php";
						break;
						case"edit_profil";
							include"modul/setting/edit_profil/edit_profil.php";
						break;
						case"galeri_sekolah";
							include"modul/galeri_sekolah/galeri_sekolah.php";
						break;
						case"perbaikan_akreditasi";
							include"modul/laporan/perbaikan_akreditasi/laporan.php";
						break;
					}
				?>
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
						
                    </div><!-- /.row (main row) -->
					<hr>
					
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
				<footer class="main-footer">
					<div class="pull-right hidden-xs">All Rights Reserved by: Vika Febri Muliati</div>
					© 2016. Sistem Pendukung Keputusan Perbaikan Akdreditasi Sekolah Dengan Menggunakan Metode AHP  | <strong>Universitas Islam Negeri Sultan Syarif Kasim Riau</strong>.
				</footer>
        </div><!-- ./wrapper -->
		
        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <!--<script src="//cdnjs.cloudflarecom/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
		<!-- Data Tables -->
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
		<!-- CHART Morris -->
		<script src="js/plugins/morris/raphael-min.js" type="text/javascript"></script>
		<script src="js/plugins/morris/raphael-min.js" type="text/javascript"></script>
		<script src="js/plugins/morris/morris.js" type="text/javascript"></script>
		<script src="js/plugins/morris/prettify.min.js" type="text/javascript"></script>
		<script src="js/plugins/morris/lib/example.js" type="text/javascript"></script>
        
		<!-- page script -->
        <script type="text/javascript">
		
			$('.dropdown-toggle').dropdown()
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
		<script type="text/javascript">
		//Date range picker
        $('#reservation').daterangepicker({format: 'YYYY/MM/DD'});
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
		//Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );
		</script>
        <script type="text/javascript">
			$('#myModal').modal(options)
        </script>
		<script language="javascript" type="text/javascript">
			$(".logdrop1").click(function(){
			  $('.pro').removeClass('hide');
			});	
			$(".logdrop2").click(function(){
			  $('.pro').removeClass('hide');
			});	
			$(".logdrop3").click(function(){
			  $('.pro').removeClass('hide');
			});		
		  $(window).load(function() {
			$('#loading').hide();
		  });
		</script>
		
		<script language="javascript" type="text/javascript" src="editor/tiny_mce_src.js"></script>
		<script type="text/javascript">
		tinyMCE.init({
				mode : "textareas",
				theme : "advanced",
				plugins : "table,youtube,advhr,advimage,advlink,emotions,flash,searchreplace,paste,directionality,noneditable,contextmenu",
				
				theme_advanced_buttons2_add : "separator,preview,zoom,separator,forecolor,backcolor,liststyle",
				theme_advanced_buttons2_add_before: "cut,copy,paste,separator,search,replace,separator",
				theme_advanced_buttons3_add_before : "tablecontrols,separator,youtube,separator",
				theme_advanced_buttons3_add : "emotions,flash",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				extended_valid_elements : "hr[class|width|size|noshade]",
				file_browser_callback : "fileBrowserCallBack",
				paste_use_dialog : false,
				theme_advanced_resizing : true,
				theme_advanced_resize_horizontal : false,
				theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
				apply_source_formatting : true
		});

			function fileBrowserCallBack(field_name, url, type, win) {
				var connector = "../../filemanager/browser.html?Connector=connectors/php/connector.php";
				var enableAutoTypeSelection = true;
				
				var cType;
				tinymcpuk_field = field_name;
				tinymcpuk = win;
				
				switch (type) {
					case "image":
						cType = "Image";
						break;
					case "flash":
						cType = "Flash";
						break;
					case "file":
						cType = "File";
						break;
				}
				
				if (enableAutoTypeSelection && cType) {
					connector += "&Type=" + cType;
				}
				
				window.open(connector, "tinymcpuk", "modal,width=600,height=400");
			}
		</script>
		
		<script type="text/javascript">
		var htmlobjek;
		$(document).ready(function(){
		  //apabila terjadi event onchange terhadap object <select id=id_kriteria>
		  $("#id_kriteria").change(function(){
			var id_kriteria = $("#id_kriteria").val();
			$.ajax({
				url: "modul/pertanyaan_kuisioner/ambil_data.php",
				data: "id_kriteria="+id_kriteria,
				cache: false,
				success: function(msg){
					//jika data sukses diambil dari server kita tampilkan
					//di <select id=desa>
					$("#pertanyaan").html(msg);
				}
			});
		  });
		});
		</script>
		
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>     
        
        <!-- AdminLTE for demo purposes -->
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>


    </body>
</html>