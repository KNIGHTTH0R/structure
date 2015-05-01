<div class="row">
	<div class="col-md-12">
		<?=gen_ui_portlet_open( $page_title, $page_icon, 'form' );?>
			<div class="tabbable-custom">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#default-pages" data-toggle="tab" class="default-pages" aria-expanded="true">
							Pages </a>
						</li>
						<li class="">
							<a href="#default-fr-menu-items" class="default-fr-menu-items" data-toggle="tab" aria-expanded="false">
							Menu Items </a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="default-pages">
						</div>
						<div class="tab-pane" id="default-fr-menu-items">
							<div class="row">
								<div class="col-md-12">
									<?=gen_ui_portlet_open( 'Default Menu Items', 'list-ol', 'form' );?>
										<form>
											<?php foreach( $pages as $page ):?>
												<?php $meta_data = json_decode( $page['meta_data'], TRUE );?>
												<div class="row">
													<div class="col-md-2">
														<?=gen_toggle( $meta_data['title'], $page['fr_menu_item_id'], $meta_data['status'] );?>
													</div>
													<div class="col-md-2">
														<?=gen_input( 'Title', 'title', $meta_data['title'] );?>	
													</div>
													<div class="col-md-2">
														<?=gen_input( 'View (alias)', 'alias', $meta_data['alias'] );?>	
													</div>
													<div class="col-md-2">
														<?=gen_input( 'Icon', 'icon', $meta_data['icon'], [ 'addon' => [ 'type' => 'icon', 'option' => $meta_data['icon'] ] ] );?>	
													</div>
													<div class="col-md-2">
														<?=gen_select_access_level( $meta_data['access_level_id'] );?>	
													</div>
												</div>
											<?php endforeach;?>
											<div class="form-actions right">
												<button type="submit" class="btn green">Save</button>
											</div>
										</form>
									<?=gen_ui_portlet_close();?>
								</div>
							</div>
						</div>
					</div>
			</div>
		<?=gen_ui_portlet_close();?>
	</div>
</div>