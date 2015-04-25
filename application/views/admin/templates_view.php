<div class="row">
	<div id="template-wrapper" class="col-md-12">
		<?=gen_ui_portlet_open( $page_title, $page_icon, '', [ 'title' => 'Templates', 'actions' => [ 'href' => 'templates/create', 'icon_text' => 'Create'	], 'title_icon' 	=> 'file-text' ] );?>
		<table class="table table-striped table-hover standard-table">
			<thead>
				<tr>
					<th>Revise</th>	
					<th>Title</th>
					<th>Status</th>
				</tr>	
			</thead>
			<tbody>
			<?php foreach( $list as $template ):?>
				<tr>
					<td class="text-center"><?=gen_ui_revise_button( site_url( 'admin/templates/revise/' . $template['template_id'] ) );?></td>
					<td><?=$template['title'];?></td>
					<td class="text-center"><?=gen_ui_status( $template['template_id'], $template['status'] );?></td>
				</tr>
			<?php endforeach;?>	
			</tbody>
		</table>
		<?=gen_ui_portlet_close();?>	
	</div>	
</div>