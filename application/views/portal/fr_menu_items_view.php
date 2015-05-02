<div class="row">
	<div id="list-reorder" class="col-md-3 col-md-offset-4" style="display: none;">
		<?=gen_ui_portlet_open( 'Menu Item Sequence', $page_icon, 'form' );?>
			<form>
				<div class="row">
					<div class="col-md-12">
						<ul id="sequence-list" class="list-unstyled list-group">
							<?php foreach( $list as $menu_item ):?>
								<?php if( $menu_item['status'] == '-' ) { continue; }?>
								<li id="<?=$menu_item['type'];?>_menu_item_id_<?=$menu_item['fr_menu_item_id'];?>" class="list-group-item parent-item">
									<i class="fa fa-sort"></i><?=$menu_item['title'];?>
									<?php if( isset( $menu_item['children_list'] ) ):?>
										<ul class="list-unstyled child-list list-group">
										<?php foreach( $menu_item['children_list'] as $child ):?>
											<?php if( $menu_item['status'] == '-' ): continue;?>
											<?php endif;?>
											<li id="<?=$menu_item['type'];?>_menu_item_id_<?=$child['fr_menu_item_id'];?>" class="list-group-item child-item">
												<i class="fa fa-sort"></i><?=$child['title'];?>
											</li>
										<?php endforeach;?>
										</ul>
									<?php endif;?>
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
				<?php if( $menu_item['status'] == '-' ) { continue; }?>
				<tr>
					<td class="text-center">
						<?php
							if( $menu_item['type'] == 'fr' ) {
								gen_ui_revise_button( site_url( 'portal/fr_menu_items/revise/' . $menu_item['fr_menu_item_id'] . '?portal_id=' . $portal_id ), [ 'class' => 'default-revise' ] );
							} else if( $menu_item['type'] == 'df' ) {
								echo '<span class="label label-sm bg-green">Default</span>';
							}
						?>
					</td>
					<td class="bold"><?=$menu_item['title'];?></td>
					<td><?=$menu_item['alias'];?></td>
					<td><?=$menu_item['access_level_title'];?></td>
					<td class="text-center"><?=gen_ui_icon( $menu_item['icon'] );?></td>
					<td class="text-center">
						<?php
							if( $menu_item['type'] == 'fr' ) {
								gen_ui_status( $menu_item['fr_menu_item_id'], $menu_item['status'] );
							}
						?>
					</td>
				</tr>
				<?php if( isset( $menu_item['children_list'] ) ):?>
					<?php foreach( $menu_item['children_list'] as $child ):?>
						<tr>
							<td class="text-center"><?=gen_ui_revise_button( site_url( 'admin/menu_items/revise/' . $child['fr_menu_item_id'] ) );?></td>
							<td class="text-indent"><?=$child['title'];?></td>
							<td><?=$child['alias'];?></td>
							<td><?=$child['access_level_title'];?></td>
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