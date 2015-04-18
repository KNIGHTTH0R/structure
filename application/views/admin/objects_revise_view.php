<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( 'Object Revise', 'cube', 'form' );?>
			<form id="object-revise">
				<?=gen_form_hidden_input( 'object_id', $object['object_id'] );?>
				<div class="row">
					<div class="col-md-6">
						<?=gen_form_text( 'Title', 'title', $object['title'] );?>
					</div>
					<div class="col-md-12">
						<h4>Parameters</h4>
						<?php foreach( $object_params as $input ): ?>
							<div class="params-wrapper row">
								<div class="col-md-4">
									<?=gen_form_select( 'none', '', array( 'text' => 'Text', 'select' => 'Select', 'multi' => 'Multi-Select', 'toggle' => 'Toggle', 'wysiwyg' => 'WYSIWYG' ), $input['type'], array( 'coption' => 'disabled' ) );?>
								</div>
								<div class="col-md-4">
									<?=gen_form_text( 'none', '', $input['label'], array( 'placeholder' => 'Label' ) );?>	
								</div>
								<div class="col-md-4">
									<?=gen_form_text( 'none', '', $input['field_name'], array( 'placeholder' => 'Variable Name' ) );?>	
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