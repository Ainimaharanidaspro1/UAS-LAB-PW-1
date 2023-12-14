<?php
session_start();
 include '../config/db.php';

if (!isset($_SESSION['admin'])) {
?> <script>
    alert('Maaf ! Anda Belum Login !!');
    window.location='index.php';
 </script>
<?php
}
 ?>


   <?php

 $id_login = @$_SESSION['admin'];


$sql = mysqli_query($con,"SELECT * FROM tb_admin
 WHERE id_admin = '$id_login'") or die(mysqli_error($con));
$data = mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Akademik sekolah</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
	
</head>
<body>	
		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm">
							<img src="../assets/img/guru.png">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?=$data['nama_lengkap'] ?>
									<span class="user-level">Admin</span>
									<span class="caret"></span>
								</span>
							</a>
        
						<div class="clearfix"></div>
							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#" data-toggle="modal" data-target="#pengaturanAkun" class="akun">
											<span class="link-collapse">Pengaturan Akun</span>
										</a>
									</li>
									<li>
										<a href="#" data-toggle="modal" data-target="#gantiPassword" class="akun">
											<span class="link-collapse">Ganti Password</span>
										</a>
									</li>
									
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item active">
							<a href="dashboard.php" class="dataumum2">
								<p>Dashboard</p>
							</a>							
						</li>
						
						<li class="nav-item">
							<a data-toggle="collapse" href="#base" class="dataumum">
								
								<p>Data Umum</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="dashboard">
									<li>
										<a href="?page=master&act=kelas" class="dataumum">
											<span class="sub-item" >Kelas</span>
										</a>
									</li>

									<li>
										<a href="?page=master&act=semester" class="dataumum2">
											<span class="sub-item">Semester</span>
										</a>
									</li>

									<li>
										<a href="?page=master&act=ta" class="dataumum">
											<span class="sub-item">Tahun Pelajaran</span>
										</a>
									</li>
									<li>
										<a href="?page=master&act=mapel" class="dataumum2">
											<span class="sub-item">Mata Pelajaran</span>
										</a>
									</li>
									<li>
										<a href="?page=walas" class="dataumum">
											<span class="sub-item"> Wali Kelas </span>
										</a>
									</li>
							
								</ul>
							</div>
						</li>

						<button class="nav-item active mt-3">
							<a href="logout.php" class="collapsed">
								Log out
							</a>							
						
                        </button>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		
				<!-- Halaman dinamis -->
				<?php 
				error_reporting();
				$page= @$_GET['page'];
				$act = @$_GET['act'];

				if ($page=='master') {
					// kelas
					if ($act=='kelas') {
					include 'modul/master/kelas/data_kelas.php';
					}elseif ($act=='delkelas') {
					include 'modul/master/kelas/del.php';
					// semster
					}elseif ($act=='semester') {
					include 'modul/master/semester/data.php'; 
					}elseif ($act=='delsemester') {
					include 'modul/master/semester/del.php';
					}elseif ($act=='set_semester') {
						include 'modul/master/semester/set.php';
					}
					// tahun ajaran
					elseif ($act=='ta') {
					include 'modul/master/ta/data.php'; 
					}elseif ($act=='delta') {
					include 'modul/master/ta/del.php';
					}elseif($act=='set_ta'){
						include 'modul/master/ta/set.php';
						// mapel
				}elseif ($act=='mapel') {
					include 'modul/master/mapel/data.php'; 
					}elseif ($act=='delmapel') {
					include 'modul/master/mapel/del.php';
					}					
				}elseif ($page=='walas') {
					if ($act=='') {
					 include 'modul/wakel/data.php';  	
					}
               
               }elseif ($page=='') {
			include 'modul/home.php';
		}else{
			echo "<b>Tidak ada Halaman</b>";
		}


				 ?>


				<!-- end -->
				
			</div>


<!-- modal ganti password -->
		<div class="modal fade bs-example-modal-sm" id="gantiPassword" tabindex="-1" role="dialog" aria-labelledby="gantiPass">
							<div class="modal-dialog modal-sm" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="gantiPass">Ganti Password</h4>
									</div>
									<form action="" method="post">
									<div class="modal-body">
											<div class="form-group">
												<label class="control-label">Password Lama</label>
												<input name="pass" type="text" class="form-control" placeholder="Password Lama">
											</div>
											<div class="form-group">
												<label class="control-label">Password Baru</label>
												<input name="pass1" type="text" class="form-control" placeholder="Password Baru">
											</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button name="changePassword" type="submit" class="btn btn-primary">Ganti Password</button>
									</div>
									</form>
									<?php 
									if (isset($_POST['changePassword'])) {
										$passLama = $data['password'];
										$pass = sha1($_POST['pass']);
										$newPass = sha1($_POST['pass1']);

										if ($passLama == $pass) {
											$set = mysqli_query($con,"UPDATE tb_admin SET password='$newPass' WHERE id_admin='$data[id_admin]' ");
												echo "<script type='text/javascript'>
				alert('Password Telah berubah')
				window.location.replace('dashboard.php'); 
				</script>";
												
										}else{
											echo "<script type='text/javascript'>
				alert('Password Lama Tidak cocok')
				window.location.replace('dashboard.php'); 
				</script>";
										}
									}
									 ?>


								</div>
							</div>
						</div>

						<!--end modal ganti password -->

						<!-- Modal pengaturan akun-->
<div class="modal fade" id="pengaturanAkun" tabindex="-1" role="dialog" aria-labelledby="akunAtur">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="akunAtur"><i class="fas fa-user-cog"></i> Pengaturan Akun</h3>
      </div>
      <form action="" method="post" enctype="multipart/form-data">
      <div class="modal-body">
      	<div class="form-group">
      		<label>Nama Lengkap</label>
      		<input type="text" name="nama" class="form-control" value="<?=$data['nama_lengkap'] ?>">  
      		<input type="hidden" name="id" value="<?=$data['id_admin'] ?>">       		
      	</div>   
      	<div class="form-group">
      		<label>Email</label>
      		<input type="text" name="username" class="form-control" value="<?=$data['username'] ?>">      		
      	</div> 
      	<div class="form-group">
      		<label>Foto Profile</label>
      		<p>
      			<img src="../assets/img/user/<?=$data['foto'] ?>" class="img-thumbnail" style="height: 50px;width: 50px;">
      		</p>
      		<input type="file" name="foto">      		
      	</div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button name="updateProfile" type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
      	<?php 
					if (isset($_POST['updateProfile'])) {

					$gambar = @$_FILES['foto']['name'];
					if (!empty($gambar)) {
					move_uploaded_file($_FILES['foto']['tmp_name'],"../assets/img/user/$gambar");
					$ganti = mysqli_query($con,"UPDATE tb_admin SET foto='$gambar' WHERE id_admin='$_POST[id]' ");
					}  	

					      $sqlEdit = mysqli_query($con,"UPDATE tb_admin SET nama_lengkap='$_POST[nama]',username='$_POST[username]' WHERE id_admin='$_POST[id]' ") or die(mysqli_error($konek));

                        if ($sqlEdit) {
                             echo "<script>
                        alert('Sukses ! Data berhasil diperbarui');
                        window.location='dashboard.php';
                        </script>";  
                        }
					}
					?>
    </div>
  </div>
</div>
<!-- end modal pengaturan akun -->

			
		<footer class="sticky-footer">
				<div class="container">
					<div class="copyright ml-auto">
						<p class="copyright">Copyright by Lab Pw 1</p>
					</div>				
				</div>
			</footer>
		</div>
		
	
	</div>
	

	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>

	
	
			
</body>
</html>