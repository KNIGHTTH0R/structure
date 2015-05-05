						</div>	
					</div>	
				</div>
			</div>
			<footer>
				<span><?=date( 'Y' );?>&copy; Structure CMS.</span>
			</footer>
		</div>
		<?=gen_ui_modal_open( [ 'title' => 'User Login', 'modal_id' => 'front-modal', 'form_id' => 'front-form' ] );?>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<?=gen_input( 'Username', 'username', '', [ 'prop' => 'autofocus', 'addon' => [ 'type' => 'icon', 'option' => 'user' ] ] );?>	
					</div>
					<div class="col-md-6">
						<?=gen_input( 'Password', 'password', '', [ 'type' => 'password', 'addon' => [ 'type' => 'icon', 'option' => 'key' ] ] );?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Log In</button>
			</div>
		<?=gen_ui_modal_close();?>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script src="<?=site_url();?>assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
		<script src="<?=site_url();?>assets/js/ajax_functions.js" type="text/javascript"></script>
		<script src="<?=site_url( 'assets/js/app.js' );?>"></script>
	</body>
</html>