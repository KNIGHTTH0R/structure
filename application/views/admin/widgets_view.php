<div class="row">
	<div class="col-md-12">
		<?=gen_ui_portlet_open( $page_title, $page_icon, '', [ 'actions' => [ 'href' => 'widgets/create', 'icon_text' => 'Create'	]	] );?>
			<table class="table table-striped table-hover standard-table">
				<thead>
					<tr>
						<th>Revise</th>	
						<th>Alias</th>
						<th>Object</th>
						<th>Status</th>
					</tr>	
				</thead>
				<tbody>
				<?php foreach( $list as $widget ): ?>
					<tr>
						<td class="text-center"><?=gen_ui_revise_button( site_url( 'admin/widgets/revise/' . $widget['widget_id'] ) );?></td>	
						<td><?=$widget['alias'];?></td>
						<td><?=$widget['title'];?></td>
						<td class="text-center"><?=gen_ui_status( $widget['widget_id'], $widget['status'] );?></td>
					</tr>
				<?php endforeach; ?>	
				</tbody>
			</table>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>