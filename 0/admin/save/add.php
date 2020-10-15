<?php
include '../../../koneksi.php';
if (isset($_POST['save'])){
	$id			= htmlspecialchars($_POST['id']);
	$nik		= htmlspecialchars($_POST['nik']);
	$nm_dpn		= htmlspecialchars($_POST['nm_dpn']);
	$nm_blk		= htmlspecialchars($_POST['nm_blk']);
	$password	= md5($_POST['password']);
	$pass		= htmlspecialchars($_POST['pass']);
	$jbtn		= htmlspecialchars($_POST['jbtn']);
	$email		= htmlspecialchars($_POST['email']);
	$tlp		= htmlspecialchars($_POST['tlp']);
	$level		= htmlspecialchars($_POST['level']);
	$cek		= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user WHERE nik='$nik'"));
		if ($cek > 0) {
			echo "<script language = 'javascript'> alert ('Maaf NIK Sudah terdaftar'); window.location='../add-user'</script>";
		}else{
			$query = mysqli_query($koneksi, "INSERT INTO user (id, nik, nm_dpn, nm_blk, password, pass, jbtn, email, tlp, level)
			VALUES ('".$id."', '".$nik."', '".$nm_dpn."', '".$nm_blk."', '".$password."', '".$pass."', '".$jbtn."', '".$email."', '".$tlp."', '".$level."')");
			echo "<script language = 'javascript'> alert ('Success'); window.location='../add-user' </script>";
		mysqli_query($query);
		}
}
?>