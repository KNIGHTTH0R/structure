<div class="row">
	<div id="admin-user-wrapper" class="col-md-12">
		<?=gen_ui_portlet_open( $page_title, $page_icon, '', [ 'actions' => [ 'href' => 'admin_users/create', 'icon_text' => 'Create'	] ] );?>
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
			<?php foreach( $list as $admin_user ):?>
				<tr>
					<td class="text-center"><?=gen_ui_revise_button( site_url( 'admin/admin_users/revise/' . $admin_user['admin_user_id'] ) );?></td>
					<td><?=$admin_user['name'];?></td>
					<td class="text-center"><?=gen_ui_admin_user_label( $admin_user['access_level_title'] );?></td>
					<td class="text-center"><?=gen_ui_status( $admin_user['admin_user_id'], $admin_user['status'] );?></td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		<?=gen_ui_portlet_close();?>	
	</div>	
</div>