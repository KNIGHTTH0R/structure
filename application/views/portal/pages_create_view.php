<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( $page_title, $page_icon, 'form' );?>
			<form id="page-create">
				<?=gen_hidden_input( 'portal_id', $portal_id );?>
				<div class="row">
					<h4 class="col-md-12">Settings</h4>
					<div class="col-md-6">
						<?=gen_input( 'Title', 'title' );?>
					</div>
					<div class="col-md-6">
						<?=gen_select_template();?>	
					</div>
					<div class="col-md-6">
						<?=gen_input( 'View (alias)', 'alias' );?>	
					</div>
					<div class="col-md-6">
						<?=gen_select_access_level();?>	
					</div>
				</div>
				<?php if( $portal_id == -1 ):?>
					<div class="row">
						<h4 class="col-md-12">Display</h4>
						<div class="col-md-6">
							<?=gen_toggle( 'Add to All Portals', 'all_portals' );?>
						</div>
					</div>
				<?php endif;?>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( section_check( TRUE ) . '/pages?portal_id=' . $portal_id ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>