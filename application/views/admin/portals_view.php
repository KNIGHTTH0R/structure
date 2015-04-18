<div class="row">
	<div class="col-md-12">
		<?=gen_ui_portlet_open( 'Portal List', 'globe', '', $portal_list );?>
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
					<td class="text-center"><?=gen_ui_revise_button( site_url( 'admin/portal/dashboard/?portal_id=' . $portal['portal_id'] ) );?></td>
					<td><?=$portal['name'];?></td>
					<td class="text-center"><?=gen_ui_status( $portal['portal_id'], $portal['status'] );?></td>
				</tr>
			<?php endforeach;?>	
			</tbody>
		</table>
		<?=gen_ui_portlet_close();?>	
	</div>	
</div>