<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( $page_title, $page_icon, 'form' );?>
			<form id="object-create">
				<div class="row">
					<h4 class="col-md-12">Settings</h4>
					<div class="col-md-6">
						<?=gen_input( 'Title', 'title' );?>
					</div>
					<div class="col-md-6">
						<?=gen_select_template();?>	
					</div>
					<div class="col-md-6">
						<?=gen_input( 'View (alias)', 'view' );?>	
					</div>
					<div class="col-md-6">
						<?=gen_select_access_level();?>	
					</div>
				</div>
				<div class="row">
					<h4 class="col-md-12">Display</h4>
					<div class="col-md-6">
							
					</div>	
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( 'admin/objects' ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>