<div class="row">
	<div class="col-md-6">
		<?=gen_ui_portlet_open( $page_title, $page_icon, 'form' );?>
			<form id="user-revise">
				<?=gen_hidden_input( 'portal_id', $portal_id );?>
				<div class="form-body">
					<?=gen_hidden_input( 'user_id', $user['user_id'] );?>
					<div class="row">
						<h4 class="col-md-12">Settings</h4>
						<div class="col-md-6">
							<?=gen_input( 'First Name', 'first_name', $user['first_name'] );?>
						</div>
						<div class="col-md-6">
							<?=gen_input( 'Last Name', 'last_name', $user['last_name'] );?>	
						</div>
						<div class="col-md-6">
							<?=gen_input( 'Email Address', 'email', $user['email'] );?>	
						</div>
						<div class="col-md-6">
							<?=gen_input( 'Username', 'username', $user['username'] );?>	
						</div>
						<div class="col-md-6">
							<?=gen_input( 'Password', 'password', '', [ 'type' => 'password' ] );?>	
						</div>
						<div class="col-md-6">
							<?=gen_select( 'Access Level', 'access_level_id', $access_level_options, $user['access_level_id'] );?>	
						</div>
					</div>
					<div class="row">
						<?=gen_form_entup( $user['entered'], $user['updated'], $user['status'] );?>	
					</div>
				</div>
				<div class="form-actions right">
					<?=gen_form_actions( site_url( 'portal/users?portal_id=' . $portal_id ) );?>
				</div>
			</form>
		<?=gen_ui_portlet_close();?>
	</div>	
</div>