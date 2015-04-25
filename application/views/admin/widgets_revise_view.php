<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( $page_title, $page_icon, 'form' );?>
			<form id="widget-revise">
				<?=gen_hidden_input( 'widget_id', $widget['widget_id'] );?>
				<?=gen_hidden_input( 'object_id', $widget['object_id'] );?>
				<div class="row">
					<h4 class="col-md-12">Settings</h4>
					<div class="col-md-6">
						<?=gen_input( 'Alias', 'alias', $widget['alias'] );?>
					</div>
					<div class="col-md-6">
						<?=gen_object_select( $widget['object_id'], [ 'prop' => 'disabled' ] );?>
					</div>
					<h4 class="col-md-12">Object Settings</h4>
					<div id="object-area">
						<?=gen_ui_object_params( $object['params'], $widget['params'] );?>
					</div>
				</div>
				<div class="row">
					<?=gen_form_entup( $widget['entered'], $widget['updated'], $widget['status'] );?>	
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( 'admin/widgets' ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>

<script>
	var params = <?php echo json_encode( $widget['params'] );?>;
</script>