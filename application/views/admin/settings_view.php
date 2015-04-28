<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( 'Settings', 'cogs', 'form' );?>
			<form id="settings-revise">
				<div class="row">
					<div class="col-md-6">
						<?=gen_input( 'Site Title', 'site_title', $settings['site_title'] );?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<?=gen_select( 'Select Me', 'selectme', [ 1 => 'Here', 2 => 'Here2' ] );?>
						<?=gen_multi_select( 'Testing', 'testing', [], [], [ 'addon' => [ 'type' => 'button', 'align' => 'right', 'option' => 'Add', 'class' => 'red test' ] ] );?>	
					</div>	
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( 'none', array( 'submit_text' => 'Save' ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>
</div>