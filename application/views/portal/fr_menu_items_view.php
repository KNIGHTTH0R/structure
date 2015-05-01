<div class="row">
	<div id="menu-item-wrapper" class="col-md-12">
		<?=gen_ui_portlet_open( $page_title, $page_icon, '', [ 'actions' => [ 'href' => 'fr_menu_items/create?portal_id=' . $portal_id, 'icon_text' => 'Create', 'reorder' => TRUE ] ] );?>
		<table class="table table-striped table-hover fr-menu-item-table">
			<thead>
				<tr>
					<th>Revise</th>	
					<th>Title</th>
					<th>Alias</th>
					<th>Access</th>
					<th>Icon</th>
					<th>Status</th>
				</tr>	
			</thead>
			<tbody>
			<?php foreach( $list as $menu_item ):?>
				<tr>
					<td class="text-center"><?=gen_ui_revise_button( site_url( 'portal/fr_menu_items/revise/' . $menu_item['fr_menu_item_id'] . '?portal_id=' . $portal_id ), [ 'class' => 'default-revise' ] );?></td>
					<td class="bold"><?=$menu_item['title'];?></td>
					<td><?=$menu_item['alias'];?></td>
					<td><?=$access_options[$menu_item['access_level_id']];?></td>
					<td class="text-center"><?=gen_ui_icon( $menu_item['icon'] );?></td>
					<td class="text-center"><?=gen_ui_status( $menu_item['fr_menu_item_id'], $menu_item['status'] );?></td>
				</tr>
				<?php if( isset( $menu_item['children_list'] ) ):?>
					<?php foreach( $menu_item['children_list'] as $child ):?>
						<tr>
							<td class="text-center"><?=gen_ui_revise_button( site_url( 'admin/menu_items/revise/' . $child['fr_menu_item_id'] ) );?></td>
							<td class="text-indent"><?=$child['title'];?></td>
							<td><?=$child['alias'];?></td>
							<td><?=$access_options[$child['access_level_id']];?></td>
							<td class="text-center"><?=gen_ui_icon( $child['icon'] );?></td>
							<td class="text-center"><?=gen_ui_status( $child['fr_menu_item_id'], $child['status'] );?></td>
						</tr>
					<?php endforeach;?>
				<?php endif;?>
			<?php endforeach;?>	
			</tbody>
		</table>
		<?=gen_ui_portlet_close();?>	
	</div>	
</div>