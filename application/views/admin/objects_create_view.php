<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( $page_title, $page_icon, 'form' );?>
			<form id="object-create">
				<div class="row">
					<h4 class="col-md-12">Settings</h4>
					<div class="col-md-6">
						<?=gen_input( 'Title', 'title' );?>
					</div>
					<h4 class="col-md-12">Parameters <button type="button" class="btn btn-xs blue add-params">Add More</button></h4>
					<div class="col-md-12">
					  <div class="row" id="params-container">
					</div>
					</div>
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( 'admin/objects' ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>