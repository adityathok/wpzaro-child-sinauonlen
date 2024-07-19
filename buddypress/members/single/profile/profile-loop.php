<?php
/**
 * BuddyPress - Members Profile Loop
 *
 * @since 3.0.0
 * @version 3.1.0
 * 
 * Edit by Adityathok
 */

 $current_id = get_current_user_id();
 global $bp;
 $id_displayed_user = $bp->displayed_user->id;
?>

<h2 class="screen-heading view-profile-screen"><?php esc_html_e( 'View Profile', 'buddypress' ); ?></h2>

<?php bp_nouveau_xprofile_hook( 'before', 'loop_content' ); ?>

<?php if ( bp_has_profile() ) : ?>
	<div class="card shadow-sm p-4 rounded border-0 card-profile-member">
		<?php 		
		$args = [
			'ID' 	=> $id_displayed_user,
		];
		if(user_has_role($id_displayed_user,'guru')) {		
			$adguru = new AdGuru;	
			echo $adguru->view($id_displayed_user);
		}
		if(user_has_role($id_displayed_user,'siswa')) {		
			$adsiswa = new AdSiswa;
			echo $adsiswa->view($id_displayed_user);
		}
		?>
	</div>
<?php endif; ?>

<?php
bp_nouveau_xprofile_hook( 'after', 'loop_content' );
