<?php
/**
 * BuddyPress - Members/Blogs Registration forms
 *
 * @since 3.0.0
 * @version 8.0.0
 */

?>

<?php bp_nouveau_signup_hook( 'before', 'page' ); ?>

<div id="register-page" class="page register-page">

	<?php if (!is_user_logged_in()) : ?>
		<?php if(!isset($_POST['user_login']) && !isset($_POST['user_email']) && !isset($_POST['user_pass']) ):  ?>
			<div class="card card-register-page">
				<div class="card-body p-3">
					<form action="" method="POST">
						<div class="form-group mb-3">
							<label class="form-label text-success">Daftar sebagai :</label>
							<select class="form-select text-success border-success" name="role" aria-label="Default select siswa">
								<option value="siswa">Siswa</option>
								<option value="guru">Guru</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label for="user_login" class="form-label">Username</label>
							<input type="text" name="user_login" class="form-control" id="user_login" placeholder="username" required>
							<div id="user_loginHelp" class="form-text">id unik, tanpa spasi dan tanda baca</div>
						</div>
						<div class="form-group mb-3">
							<label for="first_name" class="form-label">Nama</label>
							<input type="text" name="first_name" class="form-control" id="first_name" placeholder="Nama" required>
						</div>
						<div class="form-group mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="email" name="user_email" class="form-control" id="email" placeholder="Alamat Email" required>
						</div>
						<div class="form-group mb-3">
							<label for="pass" class="form-label">Password</label>
							<input type="password" name="user_pass" class="form-control" id="pass" placeholder="Password" required>
						</div>
						<input type="hidden" name="role" value="siswa">
						<button type="submit" id="submit-register" class="btn btn-info my-2">Daftar</button>
						<a href="<?= home_url();?>/login" class="btn btn-outline-dark btn-sm my-2 ml-2">Login</a>
					</form>					
				</div>
			</div>
		<?php else : ?>
			<?php 
				echo AdMember::tambahMember( $_POST,
					[
						'message-success'=>'Pendaftaran berhasil, silahkan login'
					]
				);
			?>
		<?php endif; ?>
	<?php else : ?>

	<?php endif; ?>

</div>

<?php bp_nouveau_signup_hook( 'after', 'page' ); ?>