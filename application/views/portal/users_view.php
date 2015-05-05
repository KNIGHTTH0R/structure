<div class="row">
	<div id="admin-user-wrapper" class="col-md-12">
		<?=gen_ui_portlet_open( $page_title, $page_icon, '', [ 'actions' => [ 'href' => 'users/create?portal_id=' . $portal_id, 'icon_text' => 'Create'	] ] );?>
		<table class="table table-striped table-hover standard-table">
			<thead>
				<tr>
					<th>Revise</th>	
					<th>Name</th>
					<th>Access Level</th>
					<th>Status</th>
				</tr>	
			</thead>
			<tbody>
			<?php foreach( $list as $user ):?>
				<tr>
					<td class="text-center"><?=gen_ui_revise_button( site_url( 'portal/users/revise/' . $user['user_id'] . '?portal_id=' . $portal_id ) );?></td>
					<td><?=$user['name'];?></td>
					<td class="text-center"><?=gen_ui_admin_user_label( $user['access_level_title'] );?></td>
					<td class="text-center"><?=gen_ui_status( $user['user_id'], $user['status'] );?></td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		<?=gen_ui_portlet_close();?>	
	</div>	
</div>