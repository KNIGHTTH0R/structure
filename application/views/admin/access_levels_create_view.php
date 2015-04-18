<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( 'Access Level Create', 'key', 'form' );?>
			<form id="access-level-create">
				<div class="form-body">
					<div class="row">
						<div class="col-md-6">
							<?=gen_form_text( 'Title', 'title' );?>
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( 'admin/access_levels' ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>