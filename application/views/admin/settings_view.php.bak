<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( 'Settings', 'cogs', 'form' );?>
			<form id="settings-revise">
				<div class="row">
					<div class="col-md-6">
						<?=gen_form_text( 'Site Title', 'site_title', $settings['site_title'] );?>
					</div>
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( 'none', array( 'submit_text' => 'Save' ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<?=gen_ui_portlet_open( 'Article Add', '', 'form' );?>
		<form>
			<div class="row">
				<div class="col-md-12">
					<h3 class="form-section">Content</h3>
					<?=gen_form_text( 'Title', 'title' );?>
					<?=gen_form_text( 'Sub Title', 'title' );?>
					<?=gen_form_wysiwyg( 'Content', 'content' );?>
				</div>
				<div class="col-md-6">
					<?=gen_form_wysiwyg( 'Excerpt', 'econtent' );?>	
				</div>
				<div class="col-md-6">
					<?=gen_form_wysiwyg( 'Keywords', 'kcontent' );?>	
				</div>
				<div class="col-md-6">
					<?=gen_form_multi_select( 'Author(s)', 'author', [] );?>	
				</div>
				<div class="col-md-6">
					<?=gen_form_text( 'Publish Date', 'pub' );?>	
				</div>
				<div class="col-md-6">
					<?=gen_form_multi_select( 'Category(s)', 'category', [] );?>	
				</div>
				<div class="col-md-6">
					<?=gen_form_multi_select( 'Tag(s)', 'category', [] );?>	
				</div>
				<div class="col-md-6">
					<?=gen_form_text( 'File', 'title', '', ['type' => 'file'] );?>
				</div>
				<div class="col-md-12"><h3 class="form-section">Availability</h3></div>
				<div class="col-md-6">
					<?=gen_form_multi_select( 'Regions(s)', 'category', [] );?>	
				</div>
				<div class="col-md-6">
					<?=gen_form_multi_select( 'Industry(s)', 'category', [] );?>	
				</div>
				<div class="col-md-6">
					<?=gen_form_toggle( 'Portal Default <a href="#">Manage Portals</a>', 'category' );?>	
				</div>
				<div class="col-md-12"><h3 class="form-section">Display</h3></div>
				<div class="col-md-6">
					<?=gen_form_toggle( 'Featured Portal Default <a href="#">Manage Portals</a>', 'category' );?>	
				</div>				
				<div class="col-md-6">
					<?=gen_form_toggle( 'Featured Publicly', 'category' );?>	
				</div>
				<div class="col-md-6">
					<?=gen_form_toggle( 'Sticky', 'category' );?>	
				</div>
			</div>
		</form>	
		<?=gen_ui_portlet_close();?>
	</div>	
</div>