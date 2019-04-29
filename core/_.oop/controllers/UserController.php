<?php
	class UserController {
	
		public function actionRegister() {
			/*echo 'Вызван метод actionIndex в контроллере MainController'; */
			$title = "Зарегистрироваться"; 
			$errors = array(); 
			if (isset($_POST['email'])) {
				$email = Helper::escape($_POST['email']);
				$password = Helper::escape($_POST['password']);
				$repeatPassword = Helper::escape($_POST['repeatpassword']); 
				$user = new User(); 
				if ($user -> checkIfEmailExists($email)) {
					$errors[] = 'Такой email уже существует. Введите другой!'; 
				}
				if ($password != $repeatPassword) {
					$errors[] = 'Пароли не совпадают!'; 
				}
				if (count($errors) == 0) {
					$password = Helper::hashMD5($password); 
					$user->registerUser($email, $password); 
				}
			}
			include_once('./views/users/register.php'); 
			return true;
		}
	
	}


?>