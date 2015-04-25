<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( $page_title, $page_icon, 'form' );?>
			<form id="menu-item-create">
				<?=gen_hidden_input( 'section', 'ad' );?>
				<div class="row">
					<h4 class="col-md-12">Settings</h4>
					<div class="col-md-6">
						<?=gen_input( 'Title', 'title' );?>
					</div>
					<div class="col-md-6">
						<?=gen_input( 'View', 'view' );?>
					</div>
					<div class="col-md-6">
						<?=gen_input( 'Icon', 'icon', '', array( 'icon' => 'flag' ) );?>	
					</div>
					<div class="clearfix"></div>
					<div class="col-md-6">
						<?=gen_select( 'Parent', 'parent_id', $parent_options );?>	
					</div>
					<div class="col-md-6">
						<?=gen_select_access_level();?>
					</div>
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( 'admin/menu_items' ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>