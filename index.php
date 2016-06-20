<?php
session_start();
if(isset($_SESSION['username']))
{
	header("Location:adira.php");
}
 
include"config/koneksi.php";


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<title>Login Sistem Pendukung Keputusan AHP</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />

        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="css/animate.min.css" rel="stylesheet" type="text/css" />
        <link href="css/animate.delay.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
	<body class="special-page bg-image animate0 bounceIn">

        <div class="form-box" id="login-box">
			<div class="header bg-tosca" style="color:green;">Sign In</div>
            <form action="cek_login.php" method="post">
				<div class="body bg-tosca">
					<div class="form-group animate1 bounceIn">
                        <input type="text" name="username" class="form-control" placeholder="User ID"/>
                    </div>
					<div class="form-group animate2 bounceIn">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
              
                </div>
				<div class="footer bg-tosca">                                                               
                    <button type="submit" class="btn btn-success btn-block animate3 bounceIn">Sign me in</button>  
                </div>
            </form>

        </div>


        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>