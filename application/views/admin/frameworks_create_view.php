<div class="row">
	<div class="col-md-12">
		<?=gen_ui_portlet_open( 'Framework Create', 'building', 'form' );?>
			<form id="framework-create-form" class="form-horizontal" role="form">
				<div class="form-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-3 control-label">Title</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-medium" id="title" name="title" placeholder="Title">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-3 control-label"># of Columns</label>
								<div class="col-md-9">
									<div class="input-group input-medium">
										<select class="form-control select2me" id="total_columns" name="total_columns" data-placeholder="Select...">
											<option value=""></option>
											<option value="1" selected>One</option>
											<option value="2">Two</option>
											<option value="3">Three</option>
										</select>
										<span class="input-group-btn">
										<button id="add-row" type="button" class="btn blue" type="button">Add</button>
										</span>
									</div>
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