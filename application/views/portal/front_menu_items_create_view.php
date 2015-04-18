<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( 'Menu Item Create', 'list', 'form' );?>
			<form id="menu-item-create">
				<?=gen_form_hidden_input( 'section', 'fr' );?>
				<div class="form-body">
					<div class="row">
						<div class="col-md-6">
							<?=gen_form_text( 'Title', 'title' );?>
						</div>
						<div class="col-md-6">
							<?=gen_form_text( 'View', 'view' );?>
						</div>
						<div class="col-md-6">
							<?=gen_form_text( 'Icon', 'icon', '', array( 'icon' => 'flag' ) );?>	
						</div>
						<div class="clearfix"></div>
						<div class="col-md-6">
							<?=gen_form_select( 'Parent', 'parent_id', $parent_options );?>	
						</div>
						<div class="col-md-6">
							<?=gen_select_access_level();?>
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( 'portal/menu_items' ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>

<script>
	var site_url = '<?=$site_url;?>';	
</script>