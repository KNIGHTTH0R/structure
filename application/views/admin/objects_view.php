<div class="row">
	<div id="access-level-wrapper" class="col-md-12">
		<?=gen_ui_portlet_open( $page_title, $page_icon, '', [ 'actions' => [ 'href' => 'objects/create', 'icon_text' => 'Create' ] ] );?>
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
			<?php foreach( $list as $object ): ?>
				<tr>
					<td class="text-center"><?=gen_ui_revise_button( site_url( 'admin/objects/revise/' . $object['object_id'] ) );?></td>
					<td><?=$object['title'];?></td>
					<td><?=$object['file'];?>.php</td>
					<td class="text-center"><?=gen_ui_status( $object['object_id'], $object['status'] );?></td>
				</tr>
			<?php endforeach; ?>	
			</tbody>
		</table>
		<?=gen_ui_portlet_close();?>	
	</div>
</div>