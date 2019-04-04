<?php

$validate = array();

function call ($func, $name = '', $str = '', $msg = '') {
    if ($name == '') $name = $func;
    if (function_exists ($func)) {
        if (isset ($_POST [$func]) || isset ($_POST [$name])) {
            if (preg_match ('/password_dub/', $func)) $msg = $func (htmlentities ($_POST [$func]), htmlentities ($_POST [$name]));
            else if (preg_match ('/name/', $func)) $msg = $func (htmlentities ($_POST [$name]), $str);
            else if (preg_match ('/dates/', $func) || preg_match ('/event/', $func)) $msg = $func (htmlentities ($_POST [$name]));
            else $msg = $func (htmlentities ($_POST [$name]));
            echo $msg;
        }
        else echo 'Заполните поле!';
    }
    else echo "Попытка обратиться к несуществующей функции ('$func')";
}

// Регистрационные данные

// 1. Логин – строка длиной от 8 до 30 символов. Допустимыми символами являются буквы латинского алфавита, цифры и символы «-» и «_».

function login ($str) {
    global $validate;
    $validate['login'] = false;
    if (preg_match ('/^[a-zA-Z\d\-_]{8,30}/', $str)) {
        $validate['login'] = true;
        return 'Логин корректен!';
    }
    else return 'Ошибка! Логин – строка длиной от 8 до 30 символов. <br>
                Допустимыми символами являются буквы латинского алфавита, цифры и символы «-» и «_».';
}

/*
    2. Пароли должны совпадать. Каждый пароль – строка длиной от 8 до 30 символов, содержат в себе символы латинского алфавита, 
        цифры и спецсимволы «-», «_», «+», «#», «$». Пароль обязательно должен содержать по одной заглавной и малой букве, 
        цифру и спец символ.
*/

function password () {
    global $validate;
    $validate['password'] = false;
    if (!empty ($_POST ['password']) && ($_POST ['password'] == $_POST ['password_dub'])) {
        $password = htmlentities ($_POST ['password']);
        if (strlen ($_POST ['password']) < 8) {
            return 'Your Password Must Contain At Least 8 Characters!';
        }
        elseif (!preg_match ('/[A-Z]+/', $password)) {
            return 'Your Password Must Contain At Least 1 Capital Letter!';
        }
        elseif (!preg_match ('/[a-z]+/', $password)) {
            return 'Your Password Must Contain At Least 1 Lowercase Letter!';
        }
        elseif (!preg_match ('/[0-9]+/', $password)) {
            return 'Your Password Must Contain At Least 1 Number!';
        }
        elseif (!preg_match ('/[-_+#$]+/', $password)) {
            return 'Your Password Must Contain At Least 1 Special Symbol!';
        }
        $validate['password'] = true;
        return 'Пароль корректен!';
    }
    elseif (!empty ($_POST['password'])) return "Please Check You've Entered Or Confirmed Your Password!";
    else return 'Please enter password!';
}

// Личные данные

// 3. Фамилия, имя, отчество – поля, в которых допустимы только буквы (латиница и кириллица) и цифры.

function name ($str, $name) {
    global $validate;
    $validate[$name] = false;
    if  (preg_match ('/^[\w][^_]*$/', $str)) {
        $validate[$name] = true;
        return "$name заполнено корректено!";
    }
    else return 'Ошибка! Допустимыми символами являются только буквы (латиница и кириллица) и цифры.';
}

/* 
    4. Дата рождения и дата посещения – строка в формате дд.мм.гггг. Необходимо проверить не только формат заполнения, 
        но и существование указанной даты (с учетом високосности года).
*/

function dates ($str) {
    global $validate;
    $validate['dates'] = false;
    if (preg_match ('/(\d{1,2})\.(\d{1,2})\.(\d{4})/', $str, $arr)) {
        if (validateDate ($arr[1] . '.' . $arr[2] . '.' . $arr[3])) {
            $validate['dates'] = true;
            return 'Дата корректна!';
        }
        else return 'Ошибка! Такой даты не существует.';
    } 
    else return 'Ошибка! Дата указана в неверном формате: дд.мм.гггг.';
}

function validateDate ($date, $format = 'd.m.Y')
{
    $d = DateTime::createFromFormat ($format, $date);
    return $d && $d -> format ($format) == $date;
}

// 5. Телефон – строка, соответствующая указанному шаблону «+7 (123) 456-78-90».

function phone ($str) {
    global $validate;
    $validate['phone'] = false;
    if (preg_match ('/([+7])[ ]*\((\d{3,5})\)[ ]*(\d{3})\-(\d{2})\-(\d{2})/', $str, $arr)) {
        $validate['phone'] = true;
        return 'Телефон корректен!';
    } 
    return 'Ошибка! Телефон указан в неверном формате: +7 (123) 456-78-90.';
}

// 6. E-mail – строка, содержащая корректный e-mail.

function email ($str) {
    global $validate;
    $validate['email'] = false;
    if (preg_match ('/^[0-9a-z]([0-9a-z_\-])*@((?1)|[0-9а-я])*\.((?1)|[0-9а-я]){2,10}$/iu', $str)) {
        $validate['email'] = true;
        return 'E-mail адрес корректен!';
    }
    else {
        return 'Ошибка! E-mail адрес некорректен: test@mail.ru!';
    }
}
?>