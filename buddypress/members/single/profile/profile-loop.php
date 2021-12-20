<?php
/**
 * BuddyPress - Members Profile Loop
 *
 * @since 3.0.0
 * @version 3.1.0
 */

global $bp;
$id_displayed_user = $bp->displayed_user->id;
?>

<?php bp_nouveau_xprofile_hook( 'before', 'loop_content' ); ?>

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
			echo $adsiswa->form($args,'edit');
		}
		?>
	</div>

<?php
bp_nouveau_xprofile_hook( 'after', 'loop_content' );
