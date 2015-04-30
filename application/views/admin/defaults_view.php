<div class="row">
	<div class="col-md-12">
		<?=gen_ui_portlet_open( $page_title, $page_icon, 'form' );?>
			<div class="tabbable-custom">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#default-pages" data-toggle="tab" aria-expanded="true">
							Pages </a>
						</li>
						<li class="">
							<a href="#default-menu-items" data-toggle="tab" aria-expanded="false">
							Menu Items </a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="default-pages">
						</div>
						<div class="tab-pane" id="default-menu-items">
							<div class="row">
								<div class="col-md-12">
									<?=gen_ui_portlet_open( 'Menu Item Defaults', 'list-ol', 'form', [ 'actions' => [ 'href' => '#menu-item-modal', 'icon_text' => 'Create' ] ] );?>
										<form id="default-menu-items-form">
											<div class="row">
												<h4 class="col-md-12">List</h4>
												<div class="col-md-12">
													<table class="table table-striped table-hover standard-table">
														<thead>
															<tr>
																<th>Revise</th>
																<th>Title</th>
																<th>File</th>
																<th>Status</th>
															</tr>	
														</thead>
														<tbody>
														</tbody>
													</table>	
												</div>
											</div>
										</form>
									<?=gen_ui_portlet_close();?>
								</div>
							</div>
						</div>
					</div>
			</div>
		<?=gen_ui_portlet_close();?>
	</div>
</div>
<div class="modal fade" id="menu-item-add-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->