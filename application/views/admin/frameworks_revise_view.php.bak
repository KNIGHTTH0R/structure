<div class="row">
	<div class="col-md-12">
		<?=gen_ui_portlet_open( 'Framework Revise', 'building', 'form' );?>
			<form id="framework-revise-form" class="form-horizontal" role="form">
				<?=gen_hidden_input( 'framework_id', $framework['framework_id'] );?>
				<div class="form-body">
					<div class="row">
						<h4 class="col-md-12">Settings</h4>
						<div class="col-md-4">
							<?=gen_input( 'Title', 'title', $framework['title'], [ 'inline' => 3 ] );?>
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
						<h4 class="col-md-12">Record Info</h4>
						<div class="col-md-4">
							<?=gen_input( 'Created Date', 'entered', date( 'm/d/Y h:i a', strtotime( $framework['entered'] ) ), [ 'inline' => '3', 'prop' => 'disabled', 'class' => 'input-medium' ] );?>
						</div>
						<div class="col-md-4 col-md-offset-4">
							<?=gen_input( 'Last Updated Date', 'updated', ! empty( $framework['updated'] ) ? date( 'm/d/Y h:i a', strtotime( $framework['updated'] ) ) : 'None', [ 'inline' => '5', 'prop' => 'disabled', 'class' => 'input-medium' ] );?>
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