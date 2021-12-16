<?php
/**
 * BuddyPress - Members Single Profile Edit
 *
 * @since 3.0.0
 * @version 3.1.0
 */

bp_nouveau_xprofile_hook( 'before', 'edit_content' ); ?>

<?php if ( bp_has_profile( 'profile_group_id=' . bp_get_current_profile_group_id() ) ) :
	while ( bp_profile_groups() ) :
		bp_the_profile_group();
	?>

		<form action="<?php bp_the_profile_group_edit_form_action(); ?>" method="post" id="profile-edit-form" class="card shadow standard-form profile-edit <?php bp_the_profile_group_slug(); ?>">

			<h2 class="screen-heading edit-profile-screen mt-0"><?php esc_html_e( 'Edit Profile', 'buddypress' ); ?></h2>

			<?php bp_nouveau_xprofile_hook( 'before', 'field_content' ); ?>

				<?php
				while ( bp_profile_fields() ) :
					bp_the_profile_field();
				?>

					<div<?php bp_field_css_class( 'editfield' ); ?>>
						<fieldset>
							<?php
							$field_type = bp_xprofile_create_field_type( bp_get_the_profile_field_type() );
							$field_type->edit_field_html();
							?>
							<?php //bp_nouveau_xprofile_edit_visibilty(); ?>
						</fieldset>
					</div>

				<?php endwhile; ?>

				<!-- <input type="text" class="form-control" name="datakelas" value=""> -->

				<div class="editfield field_2 field_datakelas optional-field visibility-public alt field_type_textbox">
					<fieldset>
						<legend id="field_2-1">datakelas</legend>
						<input id="field_2" name="field_2" type="text" value="" aria-labelledby="field_2-1" aria-describedby="field_2-3">
					</fieldset>
				</div>

				<?php print_r(get_user_meta( get_current_user_id(),'nama-lain' )); ?>

			<?php bp_nouveau_xprofile_hook( 'after', 'field_content' ); ?>

			<input type="hidden" name="field_ids" id="field_ids" value="<?php bp_the_profile_field_ids(); ?>" />

			<?php bp_nouveau_submit_button( 'member-profile-edit' ); ?>

		</form>

	<?php endwhile; ?>

<?php endif; ?>

<?php
bp_nouveau_xprofile_hook( 'after', 'edit_content' );
