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
						<div class="row" id="params-container">
							<div class="col-md-4 text-center">
								<strong>Type</strong>
							</div>
							<div class="col-md-4 text-center">
								<strong>Label</strong>
							</div>
							<div class="col-md-4 text-center">
								<strong>Field Name</strong>
							</div>
							<div class="col-md-12"><hr></div>
							<?php foreach( $object_params as $param ):?>
								<div class="params-wrapper">
									<div class="col-md-4">
										<?=gen_input( '', '', $param['type'], [ 'prop' => 'disabled', 'class' => 'params-select object-params' ] );?>
									</div>
									<div class="col-md-4">
										<?=gen_input( '', '', $param['label'], [ 'prop' => 'disabled', 'class' => 'params-label object-params' ] );?>
									</div>
									<div class="col-md-4">
										<?=gen_input( '', '', $param['variable'], [ 'prop' => 'disabled', 'class' => 'params-variable object-params' ] );?>
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