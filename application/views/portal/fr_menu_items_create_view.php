<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( $page_title, $page_icon, 'form' );?>
			<form id="fr-menu-item-create">
				<?=gen_hidden_input( 'portal_id', $portal_id );?>
				<div class="form-body">
					<div class="row">
						<div class="col-md-6">
							<?=gen_input( 'Title', 'title' );?>
						</div>
						<div class="col-md-6">
							<?=gen_input( 'Alias', 'alias' );?>
						</div>
						<div class="col-md-6">
							<?=gen_input( 'Icon', 'icon' );?>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-6">
							<?=gen_select( 'Parent', 'parent_id', $parent_options );?>	
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
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( 'portal/fr_menu_items?portal_id=' . $portal_id ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>