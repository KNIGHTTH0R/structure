<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( 'Object Revise', 'cube', 'form' );?>
			<form id="object-revise">
				<?=gen_hidden_input( 'object_id', $object['object_id'] );?>
				<div class="row">
					<h4 class="col-md-12">Settings</h4>
					<div class="col-md-6">
						<?=gen_input( 'Title', 'title', $object['title'] );?>
					</div>
					<h4 class="col-md-12">Parameters</h4>
					<div class="col-md-12">
						<?php foreach( $object_params as $input ): ?>
							<div class="params-wrapper row">
								<div class="col-md-4">
									<?=gen_select( '', '', [ 'text' => 'Text', 'select' => 'Select', 'multi' => 'Multi-Select', 'toggle' => 'Toggle', 'wysiwyg' => 'WYSIWYG' ], $input['type'], [ 'prop' => 'disabled' ] );?>
								</div>
								<div class="col-md-4">
									<?=gen_input( '', '', $input['label'], [ 'placeholder' => 'Label' ] );?>	
								</div>
								<div class="col-md-4">
									<?=gen_input( '', '', $input['field_name'], [ 'placeholder' => 'Variable Name' ] );?>	
								</div>
							</div>
						<?php endforeach;?>
					</div>
				</div>
				<div class="row">
					<?=gen_form_entup( $object['entered'], $object['updated'], $object['status'] );?>	
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( 'admin/objects' ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>