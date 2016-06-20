<?php

//deklarasi variabel
$server   = "localhost" ;
$username = "root" ;
$password = "" ;
$database = "spk_ahp";

//--------------------------------------------------------------

//Koneksi ke server
mysql_connect($server,$username,$password) 
or die ("Koneksi database gagal");
//--------------------------------------------------------------

//memilih database yg digunakan
mysql_select_db($database) 
or die ("Database tidak tersedia");
//--------------------------------------------------------------

?>
