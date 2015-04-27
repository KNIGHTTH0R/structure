<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( $page_title, $page_icon, 'form' );?>
			<form id="object-revise">
				<?=gen_hidden_input( 'object_id', $object['object_id'] );?>
				<div class="row">
					<h4 class="col-md-12">Settings</h4>
					<div class="col-md-6">
						<?=gen_input( 'Title', 'title', $object['title'] );?>
					</div>
					<h4 class="col-md-12">Parameters <button type="button" class="btn btn-xs blue add-params">Add More</button></h4>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4">
								<strong>Type</strong>
							</div>
							<div class="col-md-3">
								<strong>Label</strong>
							</div>
							<div class="col-md-3">
								<strong>Field Name</strong>
							</div>
						</div>
						<div class="row" id="params-container">
							<?php foreach( $object_params as $param ):?>
								<div class="params-wrapper">
									<div class="col-md-4">
										<?=gen_input( '', '', $param['type'], [ 'prop' => 'disabled', 'class' => 'params-select object-params' ] );?>
										<?=gen_hidden_input( 'type', $param['type'] );?>
									</div>
									<div class="col-md-3">
										<?=gen_input( '', '', $param['label'], [ 'prop' => 'disabled', 'class' => 'params-label object-params' ] );?>
										<?=gen_hidden_input( 'label', $param['label'] );?>
									</div>
									<div class="col-md-3">
										<?=gen_input( '', '', $param['field_name'], [ 'prop' => 'disabled', 'class' => 'params-field_name object-params' ] );?>
										<?=gen_hidden_input( 'label', $param['label'] );?>
									</div>
									<div class="col-md-2">
										<button type="button" class="btn red remove-params">Remove</button>	
									</div>
									<?php if( ! empty( $param['options'] ) ):?>
										<div class="col-md-12">
											<?=gen_multi_select( '', '', $param['options'], $param['options'], [ 'prop' => 'disabled', 'class' => 'params-tags object-params' ] );?>	
										</div>
									<?php endif;?>
								</div>
							<?php endforeach;?>
							<div class="clearfix"></div>
							<!--<h4 class="col-md-12">Add More Parameters</h4>-->
						</div>
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