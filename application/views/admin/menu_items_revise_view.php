<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( $page_title, $page_icon, 'form' );?>
			<form id="menu-item-revise">
				<?=gen_hidden_input( 'menu_item_id', $menu_item['menu_item_id'] );?>
				<?=gen_hidden_input( 'section', $menu_item['section'] );?>
				<div class="row">
					<h4 class="col-md-12">Settings</h4>
					<div class="col-md-6">	
						<?=gen_input( 'Title', 'title', $menu_item['title'] );?>
					</div>
					<div class="col-md-6">
						<?=gen_input( 'View', 'view', $menu_item['view'] );?>
					</div>
					<div class="col-md-6">
						<?=gen_input( 'Icon', 'icon', $menu_item['icon'], [ 'addon' => [ 'type' => 'icon', 'option' => $menu_item['icon'] ] ] );?>	
					</div>
					<div class="clearfix"></div>
					<div class="col-md-6">
						<?=gen_select( 'Parent', 'parent_id', $parent_options, $menu_item['parent_id'] );?>	
					</div>
					<div class="col-md-6">
						<?=gen_select_access_level( $menu_item['access_level'] );?>
					</div>
				</div>
				<div class="row">
					<?=gen_form_entup( $menu_item['entered'], $menu_item['updated'] );?>	
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( 'admin/menu_items?section=' . $section  ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>