<div class="row">
	<div id="list-reorder" class="col-md-3 col-md-offset-4" style="display: none;">
		<?=gen_ui_portlet_open( 'Order Access Levels', $page_icon, 'form' );?>
			<form>
				<div class="row">
					<div class="col-md-12">
						<ul id="sequence-list" class="list-unstyled list-group">
							<?php foreach( $list as $access_level ):?>
								<li id="access_level_id_<?=$access_level['access_level_id'];?>" class="list-group-item parent-item">
									<i class="fa fa-sort"></i><?=$access_level['title'];?>
								</li>
							<?php endforeach;?>
						</ul>
					</div>
				</div>
				<div class="form-actions right">
					<button type="submit" class="btn green">Done</button>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>
	<div id="access-level-wrapper" class="col-md-12">
		<?=gen_ui_portlet_open( $page_title, $page_icon, '', [ 'actions' => [ 'href' => 'access_levels/create', 'icon_text' => 'Create', 'reorder' => TRUE	] ] );?>
		<table class="table table-striped table-hover access-level-table">
			<thead>
				<tr>
					<th>Revise</th>	
					<th>Title</th>
					<th>Level</th>
					<th>Admin Access</th>
					<th>Status</th>
				</tr>	
			</thead>
			<tbody>
			<?php foreach( $list as $access_level ):?>
				<tr>
					<td class="text-center"><?=gen_ui_revise_button( site_url( 'admin/access_levels/revise/' . $access_level['access_level_id'] ) );?></td>
					<td><?=$access_level['title'];?></td>
					<td><?=$access_level['level'];?></td>
					<td class="text-center"><input type="checkbox" class="make-switch" data-on-color="primary" data-off-color="danger" data-on-text="Yes" data-off-text="No" data-size="mini" <?=$access_level['admin_flg'];?>></td>
					<td class="text-center"><?=gen_ui_status( $access_level['access_level_id'], $access_level['status'] );?></td>
				</tr>
			<?php endforeach;?>	
			</tbody>
		</table>
		<?=gen_ui_portlet_close();?>	
	</div>	
</div>