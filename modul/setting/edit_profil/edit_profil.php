<?php
$modul=isset($_GET['aksi']) ?$_GET['aksi'] : '';
include 'lib/kode_auto.php';
include 'lib/fungsi.php';

switch ($modul) {
	case "edit_profil";
	$sql_password = "select password from hak_akses where id = '$_SESSION[id]'";
	$run_password = mysql_query($sql_password);
	$data_password = mysql_fetch_array($run_password);
	
	if ($_SESSION['status_login']=='Administrator') {
		$data = mysql_fetch_assoc(mysql_query("select a.*, b.* from admin a, hak_akses b where a.id = b.id and b.username='$_SESSION[nama_user_login]' and b.password='".$data_password['password']."'"));
	}
	if ($_SESSION['status_login']=='Kadis') {
		$data = mysql_fetch_assoc(mysql_query("select a.*, b.* from kadis a, hak_akses b where a.nip = b.id and b.username='$_SESSION[nama_user_login]' and b.password='".$data_password['password']."'"));
	}
	if ($_SESSION['status_login']=='UPA') {
		$data = mysql_fetch_assoc(mysql_query("select a.*, b.* from upa a, hak_akses b where a.nip = b.id and b.username='$_SESSION[nama_user_login]' and b.password='".$data_password['password']."'"));
	}
	if ($_SESSION['status_login']=='Admin Sekolah') {
		$data = mysql_fetch_assoc(mysql_query("select a.*, b.*, c.* from admin_sekolah a, hak_akses b, sekolah c where a.nip = b.id and a.id_sekolah = c.id_sekolah and b.username='$_SESSION[nama_user_login]' and b.password='".$data_password['password']."'"));
	}
	
	echo ' 
		<div class="col-md-12">
			<form role="form" enctype="multipart/form-data" action="modul/setting/'.$_GET['modul'].'/aksi_'.$_GET['modul'].'.php?modul='.$_GET['modul'].'&aksi=edit" method="post">
			<!-- general form elements disabled -->
				<div class="box box-primary">
					<div class="box-header">
					<h3 class="box-title">'.ucfirst(str_replace("_"," ",$_GET['modul'])).'</h3>
					 </div><!-- /.box-header -->
					 <div class="box-body">
						 <table class="table table-bordered table-striped">
							<tr>
							<div class="form-group">
								<td><label>Username</label></td>
								<td>
									<input type="hidden" class="form-control" name="id" value="'.$_SESSION['id'].'" readonly/>
									<input type="text" class="form-control" name="username_lama" value="'.$_SESSION['nama_user_login'].'"/>
								</td>
							</div>
							</tr>
							<tr>
							<div class="form-group">
								<td><label>Password Lama</label></td>
								<td><input type="hidden" class="form-control" name="password_lama" id="password_lama" value="'.$data['password'].'"><input type="password" class="form-control" name="konfirm_password_lama" id="konfirm_password_lama" onkeyup="checkPasswordMatch();"><br><div class="registrationFormAlert" id="divCheckPasswordMatch"></div></td>
							</div>
							</tr>
							<tr>
							<div class="form-group">
								<td><label>Password Baru</label></td>
								<td><input type="password" class="form-control" name="password_baru" id="password_baru""></td>
							</div>
							</tr>
							<tr>
							<div class="form-group">
								<td><label>Konfirm Password Baru</label></td>
								<td><input type="password" class="form-control" name="konfirm_password_baru" id="konfirm_password_baru" onkeyup="checkPasswordMatch2();"><br><div class="registrationFormAlert2" id="divCheckPasswordMatch2"></div></td>
							</div>
							</tr>
							<tr>
							<div class="form-group">
								<td><label>Nama</label></td>
								<td><input type="text" class="form-control" name="nama" value="'.$_SESSION['nama'].'"></td>
							</div>
							</tr>
							<tr>
							<tr>
							<div class="form-group">
								<td><label>Tempat Lahir</label></td>
								<td><input type="text" class="form-control progress horizontal" name="tempat_lahir" value="'.$data['tempat_lahir'].'" required/></td>
							</div>
							</tr>
							<tr>
							<div class="form-group">
								<td><label>Tanggal Lahir</label></td>
								<td><input type="date" class="form-control progress horizontal" name="tanggal_lahir" value="'.$data['tanggal_lahir'].'" required/></td>
							</div>
							</tr>
							<div class="form-group">
								<td><label>Alamat</label></td>
								<td><input type="text" class="form-control" name="alamat" value="'.$data['alamat'].'"></td>
							</div>
							</tr>
							<tr>
							<div class="form-group">
								<td><label>No. Telepon/ Hp</label></td>
								<td><input type="text" class="form-control" name="no_telp" value="'.$data['nomor_telepon'].'"></td>
							</div>
							</tr>
							<tr>
							<div class="form-group">
								<td><label>Jenis Kelamin</label></td>
								<td>
									<input type="radio" class="form-control" name="jenis_kelamin" value="Laki-Laki"'; if ($data['jenis_kelamin']=='Laki-Laki') {echo'checked';}echo'> Laki-Laki
									<input type="radio" class="form-control" name="jenis_kelamin" value="Perempuan"'; if ($data['jenis_kelamin']=='Perempuan') {echo'checked';}echo'> Perempuan
								</td>
							</div>
							</tr>
							<tr>
							<div class="form-group">
								<td><label>Agama</label></td>';
								$agama = array('Islam', 'Kristen', 'Hindu', 'Budha', 'Konghuchu');
								echo'
								<td>
									<select name="agama" class="form-control" required/>
									<option selected value="'.$data['agama'].'">'.$data['agama'].'</option>';
										for ($i=0; $i<=4; $i++) {
											echo'
												<option value="'.$agama[$i].'">'.$agama[$i].'</option>
											';
										}
									echo'
									</select>
								</td>
							</div>
							</tr>
							<tr>
							<div class="form-group">
								<td><label>Photo</label></td>
								<td>
									<input type="hidden" class="form-control" name="gambar_edit" value="'.$_SESSION['photo'].'">
									<input type="file" class="form-control" name="gambar"><br><img src="'.$_SESSION['photo'].'" style="width:150px; height:200px;">
								</td>
							</div>
							</tr>
						</table>
						<hr>
							<button type="submit" class="btn btn-success" id="edit" disabled>Ubah Profil</button>
			</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	';
break;
}

?>
<script type="text/javascript"><!--
function checkPasswordMatch() {
    var password = $("#password_lama").val();
    var confirmPassword = $("#konfirm_password_lama").val();
	
    if (password != confirmPassword)
		$("#divCheckPasswordMatch").html("<p style='font-family: verdana; color: red;'>Password Tidak Cocok!</p>");
    else
		$("#divCheckPasswordMatch").html("<p style='font-family: verdana; color: Green;'>Password Cocok</p>");
	
	if (password != confirmPassword)
		document.getElementById('password_baru').disabled = true;
    else
		document.getElementById('password_baru').disabled = false;
}
//--></script>

<script type="text/javascript"><!--
function checkPasswordMatch2() {
    var password = $("#password_baru").val();
    var confirmPassword = $("#konfirm_password_baru").val();
	
    if (password != confirmPassword)
		$("#divCheckPasswordMatch2").html("<p style='font-family: verdana; color: red;'>Password Tidak Cocok!</p>");
    else
		$("#divCheckPasswordMatch2").html("<p style='font-family: verdana; color: Green;'>Password Cocok</p>");
	
	if (password != confirmPassword)
		document.getElementById('edit').disabled = true;
    else
		document.getElementById('edit').disabled = false;
}
//--></script>