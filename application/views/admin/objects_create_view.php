<div class="row">
	<div class="col-md-9">
		<?=gen_ui_portlet_open( 'Object Create', 'cube', 'form' );?>
			<form id="object-create">
				<div class="row">
					<div class="col-md-6">
						<?=gen_form_text( 'Title', 'title' );?>
					</div>
					<div class="col-md-12">
						<h4>Parameters</h4>
					</div>
					<div class="clearfix"></div>
					<div id="params-container">
					</div>
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( 'admin/objects' ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>