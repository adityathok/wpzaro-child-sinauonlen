<?php
/**
 * BuddyPress - Members Single Profile Edit
 *
 * @since 3.0.0
 * @version 3.1.0
 */

bp_nouveau_xprofile_hook( 'before', 'edit_content' ); ?>

<?php if ( bp_has_profile( 'profile_group_id=' . bp_get_current_profile_group_id() ) ) : ?>

	<div class="card shadow-sm p-4 rounded border-0">
		<?php 
		global $metasiswa;
		$args = [
			'ID' 	=> get_current_user_id(),
			'role' 	=> 'siswa',
		];		
		echo AdMember::formMember($args,'edit',$metasiswa);
		?>
	</div>

<?php endif; ?>

<?php
bp_nouveau_xprofile_hook( 'after', 'edit_content' );
