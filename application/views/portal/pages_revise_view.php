<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( $page_title, $page_icon, 'form' );?>
			<form id="page-revise">
				<div class="row">
					<?=gen_hidden_input( 'page_id', $page['page_id'] );?>
					<?=gen_hidden_input( 'portal_id', $page['portal_id'] );?>
					<h4 class="col-md-12">Settings</h4>
					<div class="col-md-6">
						<?=gen_input( 'Title', 'title', $page['title'] );?>
					</div>
					<div class="col-md-6">
						<?=gen_select_template( $page['template_id'] );?>	
					</div>
					<div class="col-md-6">
						<?=gen_input( 'View (alias)', 'alias', $page['alias'] );?>	
					</div>
					<div class="col-md-6">
						<?=gen_select_access_level( $page['access_level_id'] );?>	
					</div>
				</div>
				<div class="row">
					<?=gen_form_entup( $page['entered'], $page['updated'] );?>	
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( section_check( TRUE ) . '/pages?portal_id=' . $portal_id ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>