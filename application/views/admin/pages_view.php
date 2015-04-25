<div class="row">
	<div id="access-level-wrapper" class="col-md-12">
		<?=gen_ui_portlet_open( $page_title, $page_icon, '', [ 'actions' => [ 'href' => 'pages/create', 'icon_text' => 'Create' ] ] );?>
		<table class="table table-striped table-hover standard-table">
			<thead>
				<tr>
					<th>Revise</th>	
					<th>Title</th>
					<th>View</th>
					<th>Status</th>
				</tr>	
			</thead>
			<tbody>
			<?php foreach( $list as $page ): ?>
				<tr>
					<td class="text-center"><?=gen_ui_revise_button( site_url( 'admin/pages/revise/' . $page['page_id'] ) );?></td>
					<td><?=$page['title'];?></tdw>
					<td><?=$page['view'];?>.php</td>
					<td class="text-center"><?=gen_ui_status( $page['page_id'], $page['status'] );?></td>
				</tr>
			<?php endforeach; ?>	
			</tbody>
		</table>
		<?=gen_ui_portlet_close();?>	
	</div>
</div>