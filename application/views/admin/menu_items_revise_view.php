<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( 'Menu Item Revise', 'list', 'form' );?>
			<form id="menu-item-revise">
				<?=gen_form_hidden_input( 'menu_item_id', $menu_item['menu_item_id'] );?>
				<div class="form-body">
					<div class="row">
						<div class="col-md-6">
							<?=gen_form_text( 'Title', 'title', $menu_item['title'] );?>
						</div>
						<div class="col-md-6">
							<?=gen_form_text( 'View', 'view', $menu_item['view'] );?>
						</div>
						<div class="col-md-6">
							<?=gen_form_text( 'Icon', 'icon', $menu_item['icon'], array( 'icon' => $menu_item['icon'] ) );?>	
						</div>
						<div class="clearfix"></div>
						<div class="col-md-6">
							<?=gen_form_select( 'Parent', 'parent_id', $parent_options, $menu_item['parent_id'] );?>	
						</div>
						<div class="col-md-6">
							<?=gen_select_access_level( $menu_item['access_level'] );?>
						</div>
					</div>
					<div class="row">
						<?=gen_form_entup( $menu_item['entered'], $menu_item['updated'] );?>	
					</div>
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( 'admin/menu_items' ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>