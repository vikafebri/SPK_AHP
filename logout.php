<?php
session_start();
  //mengakhiri session
  session_destroy();
  //jendela pemberitahuan kalau session telah diakhiri (berhasil) login
	echo "<script>alert('Anda Telah Logout, Sampai Jumpa');
		  document.location.href = 'index.php';
		 </script>";

?>