<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( 'Widget Revise', 'cubes', 'form' );?>
			<form id="widget-revise">
				<?=gen_form_hidden_input( 'widget_id', $widget['widget_id'] );?>
				<div class="row">
					<div class="col-md-6">
						<?=gen_form_text( 'Alias', 'alias', $widget['alias'] );?>
					</div>
					<div class="col-md-6">
						<?=gen_object_select( $widget['object_id'], array( 'coption' => 'disabled' ) );?>
					</div>
					<div id="object-area">
						<div class="col-md-12"><hr></div>
						<?=gen_ui_object_inputs( $object, gen_ui_widget_params( $widget['params'] ) );?>	
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
	var params 		= <?php echo json_encode( $widget['params'] );?>;
</script>