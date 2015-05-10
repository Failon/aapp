<section>
	<h2>Profile Section</h2>
	<div id="profilewrap">
		<div class="campos">
		<h3>Information Update</h3>
			<p>Fill the fields you want to update and press send when you are done</p>
			<form action="<?=APP_W;?>profile/update" method="POST" class="profile">
				<input type="text" name="name" value="name" placeholder="name"/>
				<input type="text" name="email" value="email" placeholder="email"/>
				<input type="text" name="city" value="city" placeholder="city"/>
				<input type="submit" value="send"/>
			</form>			
		</div>
		<div class="campos">
		<h3>Password update</h3>
			<form action="<?=APP_W;?>profile/password" method="POST"class="profile">
				<label>
				<p>Type your actual password</p>
				<input type="password" name="actual_password" required/>
				</label>
				<label>
				<p>Type your new password</p>
				<input type="password" name="password" required/>
				</label>
				<label>
				<p>Repeat your new password</p>
				<input type="password" name="repassword" required/>
				<input type="submit" value="send"/>
				</label>
			</form>		
		</div>
		<div class="campos">
			<form action="<?=APP_W;?>profile/cancel" method="POST" class="profile">
				<input type="button" id="cancelbutton" value="Cancel Account" />
				<input hidden id="cconfirm" type="submit" value="Confirm"/>
			</form>
		</div>
	</div>
</section>
<script>
$("#cancelbutton").click(function(){
	cancelconfirm();
});
	function cancelconfirm() {
    if (confirm("Do you really want to cancel your account?") == true) {
        $("#cconfirm").trigger( "click" );
    }
	}
</script>