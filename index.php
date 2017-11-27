<?php
session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require('dbcon.php');
if(isset($_POST['member_name']) and isset($_POST['member_password'])) {

	$username = $_POST['member_name'];
	$password = $_POST['member_password'];


	$sql = "SELECT * FROM members WHERE member_name='$username' and member_password='$password'";

	$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	$user = mysqli_num_rows($result);
	if($user==1) {
			$_SESSION["member_id"] = $user["member_id"];
			if(!empty($_POST["remember"]==0)) {
				setcookie ("member_login",$_POST["member_name"],time()+ (365 * 24 * 60 * 60));
				setcookie ("member_password",$_POST["member_password"],time()+ (365 * 24 * 60 * 60));
			}elseif(!empty($_POST["remember"]==1)){
				setcookie ("member_login",$_POST["member_name"],time()+ (365 * 24 * 60 * 60));
				if(isset($_COOKIE["member_password"])){
				setcookie ("member_password","");
				}
			} else {
				if(isset($_COOKIE["member_login"])) {
					setcookie ("member_login","");
				}
				if(isset($_COOKIE["member_password"])) {
					setcookie ("member_password","");
				}
			}
	} else {
		$message = "Invalid Login";
	}
}
?>	
<style>
	form{
		margin-top: 100px;;
		margin-left: 35%;
		margin-right:45%;
		width: 20%;
	}
	#frmLogin {	
		padding: 20px 60px;
		/* padding-left: 25px; */
		background: #B6E0FF;
		color: #555;
		display: inline-block;		
		border-radius: 4px;
	}
	.field-group {
		margin-top:15px;
	}
	.input-field {
		padding: 8px;
		width: 200px;
		border: #A3C3E7 1px solid;
		border-radius: 4px;
	}
	.form-submit-button {
		background: #65C370;
		border: 0;
		padding: 8px 20px;
		border-radius: 4px;
		color: #FFF;
		text-transform: uppercase;
	}
	.member-dashboard {
		padding: 40px;
		background: #D2EDD5;
		color: #555;
		border-radius: 4px;
		display: inline-block;
	}
	.member-dashboard a {
		color: #09F;
		text-decoration:none;
	}
	.error-message {
		text-align:center;
		color:#FF0000;
	}
</style>

<form action="" method="post" id="frmLogin">
	<div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>	
	<div class="field-group">
		<div><label for="login">Username</label></div>
		<div><input name="member_name" type="text" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" class="input-field" autofocus>
	</div>
	</div>
	<div class="field-group">
		<div><label for="password">Password</label></div>
		<div><input name="member_password" type="password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" class="input-field"> 
	</div></div>
	<div class="field-group">
		<div><input type="radio" name="remember" id="remember" value="0" <?php if(isset($_COOKIE["member_password"])) { ?> checked <?php } ?> />
		<label for="remember-me">Remember me</label>
	</div></div>
	<div class="field-group">
		<div><input type="radio" name="remember" id="remember1" value="1" <?php if(!isset($_COOKIE["member_password"]) and isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
		<label for="remember-me">Remember my username only</label>
	</div></div>
	<div class="field-group">
		<div><input type="radio" name="remember" id="remember2" value="3" <?php if(!isset($_COOKIE["member_login"]) and !isset($_COOKIE["member_password"])) { ?> checked <?php } ?> />
		<label for="remember-me">Do not remember me.</label>
	</div></div>
	<div class="field-group">
		<div><input type="submit" name="login" value="Login" class="form-submit-button"></span></div>
	</div> </div>      
</form>