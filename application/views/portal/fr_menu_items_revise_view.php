<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( $page_title, $page_icon, 'form' );?>
			<form id="fr-menu-item-revise">
				<?=gen_hidden_input( 'fr_menu_item_id', $fr_menu_item['fr_menu_item_id'] );?>
				<?=gen_hidden_input( 'portal_id', $portal_id );?>
				<div class="form-body">
					<div class="row">
						<div class="col-md-6">
							<?=gen_input( 'Title', 'title', $fr_menu_item['title'] );?>
						</div>
						<div class="col-md-6">
							<?=gen_input( 'Alias', 'alias', $fr_menu_item['alias'] );?>
						</div>
						<div class="col-md-6">
							<?=gen_input( 'Icon', 'icon', $fr_menu_item['icon'], [ 'addon' => [ 'type' => 'icon', 'option' => $fr_menu_item['icon'] ] ] );?>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-6">
							<?=gen_select( 'Parent', 'parent_id', $parent_options, $fr_menu_item['parent_id'] );?>	
						</div>
						<div class="col-md-6">
							<?=gen_select_access_level( $fr_menu_item['access_level_id'] );?>
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( 'portal/fr_menu_items?portal_id=' . $portal_id ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>