<?php
/**
 * BuddyPress - Members Single Profile Edit
 *
 * @since 3.0.0
 * @version 3.1.0
 */

bp_nouveau_xprofile_hook( 'before', 'edit_content' ); 
global $bp;
$id_displayed_user = $bp->displayed_user->id;
?>

<?php if ( bp_has_profile( 'profile_group_id=' . bp_get_current_profile_group_id() ) ) : ?>

	<div class="card shadow-sm p-4 rounded border-0">
		<?php		
		$args = [
			'ID' 	=> $id_displayed_user,
		];
		if(user_has_role($id_displayed_user,'guru')) {		
			$adguru = new AdGuru;	
			echo $adguru->form($args,'edit');
		}
		if(user_has_role($id_displayed_user,'siswa')) {		
			$adsiswa = new AdSiswa;	
			echo $adsiswa->form($args,'edit');
		}
		?>
	</div>

<?php endif; ?>

<?php
bp_nouveau_xprofile_hook( 'after', 'edit_content' );
