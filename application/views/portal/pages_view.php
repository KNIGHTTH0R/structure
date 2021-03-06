<div class="row">
	<div id="access-level-wrapper" class="col-md-12">
		<?=gen_ui_portlet_open( $page_title, $page_icon, '', [ 'actions' => [ 'href' => 'pages/create?portal_id=' . $portal_id, 'icon_text' => 'Create' ] ] );?>
		<table class="table table-striped table-hover page-table">
			<thead>
				<tr>
					<th>Revise</th>	
					<th>Title</th>
					<th>View (alias)</th>
					<th>Template</th>
					<th>Access Level</th>
					<th>Status</th>
				</tr>	
			</thead>
			<tbody>
			<?php foreach( $list as $page ): ?>
				<tr>
					<td class="text-center">
						<?php
							if( $page['type'] == 'fr' ) {
								gen_ui_revise_button( site_url( 'portal/pages/revise/' . $page['page_id'] . '?portal_id=' . $portal_id ), [ 'class' => 'default-revise' ] );
							} else if( $page['type'] == 'df' ) {
								echo '<span class="label label-sm bg-green">Default</span>';
							}
						?>
					</td>
					<td><?=$page['title'];?></tdw>
					<td><?=$page['alias'];?></td>
					<td><?=$page['template_title'];?></td>
					<td><?=$page['access_level_title'];?></td>
					<td class="text-center">
						<?php
							if( $page['type'] == 'fr' ) {
								gen_ui_status( $page['page_id'], $page['status'] );
							}
						?>
					</td>
				</tr>
			<?php endforeach; ?>	
			</tbody>
		</table>
		<?=gen_ui_portlet_close();?>	
	</div>
</div>