<div class="row">
	<div class="col-md-12">
		<?=gen_ui_portlet_open( 'Frameworks List', 'building', '', $framework_list );?>
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
			<?php foreach( $list as $framework ):?>
				<tr>
					<td class="text-center"><?=gen_ui_revise_button( site_url( 'admin/frameworks/revise/' . $framework['framework_id'] ) );?></td>
					<td><?=$framework['title'];?></td>
					<td><?=$framework['file'];?>.php</td>	
					<td class="text-center"><?=gen_ui_status( $framework['framework_id'], $framework['status'] );?></td>
				</tr>
			<?php endforeach;?>	
			</tbody>
		</table>
		<?=gen_ui_portlet_close();?>	
	</div>	
</div>

<script>
	var site_url = '<?=$site_url;?>';	
</script>