<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( 'Access Level Revise', 'key', 'form' );?>
			<form id="access-level-revise">
				<?=gen_form_hidden_input( 'access_level_id', $access_level['access_level_id'] );?>
				<div class="form-body">
					<div class="row">
						<div class="col-md-6">
							<?=gen_form_text( 'Title', 'title', $access_level['title'] );?>
						</div>
					</div>
					<div class="row">
						<?=gen_form_entup( $access_level['entered'], $access_level['updated'], $access_level['status'] );?>	
					</div>
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( 'admin/access_levels' ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>