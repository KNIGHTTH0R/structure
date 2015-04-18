<div class="row">
	<div id="template-wrapper" class="col-md-12">
		<?=gen_ui_portlet_open( 'Template Revise', 'picture-o' , 'form' );?>
			<form id="template-revise" class="form-horizontal">
				<?=gen_form_hidden_input( 'template_id', $template['template_id'] );?>
				<?=gen_form_hidden_input( 'framework_id', $template['framework_id'] );?>
				<div class="row">
					<div class="col-md-4">
						<?=gen_form_text( 'Title', 'title', $template['title'], array(), 'inline' );?>
					</div>
					<div class="col-md-4">
						<?=gen_select_framework( $template['framework_id'], array( 'coption' => 'disabled' ), 'inline' );?>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="col-md-3 control-label">Widgets</label>
							<div class="col-md-9">
								<div class="input-group">
									<select class="form-control select2me" id="column_id" data-placeholder="Select...">
										<option value=""></option>
									</select>
									<span class="input-group-btn">
									<button id="add-row" href="#widget-add-modal" data-toggle="modal" type="button" class="btn blue" type="button">Add</button>
									</span>
								</div>
							</div>
						</div>	
					</div>
				</div>
				<div id="framework-item-preview" class="row">
					<div class="framework-mockup">
						<?=gen_ui_framework_item( $framework, $positions );?>
					</div>
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( 'admin/templates' ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>

<div class="modal fade" id="widget-add-modal" tabindex="-1" role="basic" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Widget Add</h4>
		</div>
		<form id="widget-add-form" role="form">
			<div class="modal-body">
				<?=gen_widget_select();?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn blue">Save changes</button>
			</div>
		</form>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>