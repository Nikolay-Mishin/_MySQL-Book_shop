<? include_once('./views/templates/header.php'); ?>
	<div class="contact_form">
	<div class="form_subtitle">Зарегистрироваться:</div>
	
		<? if (count($errors) != 0): ?>
			<div> 
				<? foreach ($errors as $error): ?>
					<p> <?= $error; ?> </p> 
				<? endforeach; ?>
			</div>
		<? endif; ?>

	 <form name="register" method="POST" >          
		<div class="form_row">
		<label class="contact"><strong>Email:</strong></label>
		<input type="email" class="contact_input" name="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : '' ?>"/>
		</div>
		
		<div class="form_row">
		<label class="contact"><strong>Пароль:</strong></label>
		<input type="password" class="contact_input" name="password" value="<?= (isset($_POST['password'])) ? $_POST['password'] : '' ?>" />
		</div> 
		
		<div class="form_row">
		<label class="contact"><strong>Повторите пароль:</strong></label>
		<input type="password" class="contact_input" name="repeatpassword" value="<?= (isset($_POST['repeatpassword'])) ? $_POST['repeatpassword'] : '' ?>" />
		</div> 
		
		<div class="form_row">
		<input type="submit" class="register" value="Зарегистрироваться" />
		</div>   
	  </form>     
	</div>  