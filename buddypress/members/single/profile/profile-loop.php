<?php
/**
 * BuddyPress - Members Profile Loop
 *
 * @since 3.0.0
 * @version 3.1.0
 */

?>

<?php bp_nouveau_xprofile_hook( 'before', 'loop_content' ); ?>

<div class="card shadow-sm p-4 rounded border-0 card-profile-member">
		<?php 
		global $metasiswa;		
		echo AdMember::lihatMember(get_current_user_id(),$metasiswa);
		?>
	</div>

<?php
bp_nouveau_xprofile_hook( 'after', 'loop_content' );
