<div class="row">
	<div id="framework-wrapper" class="col-md-12">
		<div class="row">
			<?=gen_ui_framework_preview( $framework_list );?>
		</div>
	</div>	
</div>
<div class="row">
	<div id="template-wrapper" class="col-md-12" style="display: none;">
		<?=gen_ui_portlet_open( $page_title, $page_icon, 'form', $template_create );?>
			<form id="template-create" class="form-horizontal">
				<div class="row">
					<h4 class="col-md-12">Settings</h4>
					<div class="col-md-4">
						<?=gen_input( 'Title', 'title', '', [ 'inline' => 3 ] );?>
					</div>
					<div class="col-md-4">
						<?=gen_select_framework( '', [ 'inline' => 3 ] );?>
					</div>
					<div class="col-md-4">
						<?=gen_select( 'Widgets', 'column_id', [], '', [ 'inline' => 3, 'addon' => [ 'type' => 'button', 'class' => 'blue widget-add', 'option' => 'Add', 'align' => 'right' ] ] );?>	
					</div>
				</div>
				<div id="framework-item-preview" class="row">
					<?=$framework_preview;?>
				</div>
				<div class="form-actions right">
					<?=gen_form_actions();?>
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