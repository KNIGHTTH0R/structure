<div class="row">
	<div class="col-md-12">
		<?=gen_ui_portlet_open( 'Framework Revise', 'building', 'form' );?>
			<form id="framework-revise-form" class="form-horizontal" role="form">
				<?=gen_form_hidden_input( 'framework_id', $framework['framework_id'] );?>
				<div class="form-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-3 control-label">Title</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-medium" id="title" name="title" placeholder="Title" value="<?=$framework['title'];?>">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="framework-mockup">
								<?=gen_ui_framework_item( $framework );?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Entered</label>	
								<div class="col-md-9">
									<input type="text" class="form-control input-medium" value="<?php echo date( 'm/d/Y h:i a', strtotime( $framework['entered'] ) );?>" disabled>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Updated</label>	
								<div class="col-md-9">
									<input type="text" class="form-control input-medium" value="<?php echo !empty( $framework['updated'] ) ? date( 'm/d/Y h:i a', strtotime( $framework['updated'] ) ) : 'None';?>" disabled>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( 'admin/frameworks' ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>