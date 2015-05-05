<div class="row">
	<div class="col-md-12">
		<?=gen_ui_portlet_open( $page_title, $page_icon, '', [ 'actions' => [ 'href' => '#portal-create', 'icon_text' => 'Create' ] ] );?>
		<table class="table table-striped table-hover standard-table">
			<thead>
				<tr>
					<th>Revise</th>	
					<th>Name</th>
					<th>Status</th>
				</tr>	
			</thead>
			<tbody>
			<?php foreach( $list as $portal ):?>
				<tr>
					<td class="text-center"><?=gen_ui_revise_button( site_url( 'portal/dashboard?portal_id=' . $portal['portal_id'] ), [ 'label' => 'Manage', 'target' => '_blank' ] );?></td>
					<td><?=$portal['name'];?></td>
					<td class="text-center"><?=gen_ui_status( $portal['portal_id'], $portal['status'] );?></td>
				</tr>
			<?php endforeach;?>	
			</tbody>
		</table>
		<?=gen_ui_portlet_close();?>	
	</div>	
</div>
<?=gen_ui_modal_open( [ 'title' => 'Portal Create', 'modal_id' => 'portal-create', 'form_id' => 'portal-form' ] );?>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-6">
				<?=gen_input( 'Portal Name', 'name', '', [ 'prop' => 'autofocus', 'addon' => [ 'type' => 'icon', 'option' => 'globe' ] ] );?>	
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<?=gen_form_actions();?>
	</div>
<?=gen_ui_modal_close();?>