<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( 'Settings', 'cogs', 'form' );?>
			<form id="settings-revise">
				<div class="row">
					<div class="col-md-6">
						<?=gen_form_text( 'Site Title', 'site_title', $settings['site_title'] );?>
					</div>
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( 'none', array( 'submit_text' => 'Save' ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>