<?php
// Подключаем класс для работы с CRUD операциями над JSON данными
require_once 'JsonCrudHandler.php';

class RegistrationHandler
{
    // Объект для работы с CRUD операциями
    private $crudHandler;
    // Массив для хранения ошибок
    public $errors = [];

    // Конструктор класса
    public function __construct()
    {
        // Инициализируем объект для работы с CRUD операциями
        $this->crudHandler = new JsonCrudHandler();
    }

    // Функция для регистрации пользователя
    public function registerUser($data)
    {
        // Проверяем данные на валидность
        $errors = $this->isValidData($data);

        // Если все данные валидны, продолжаем процесс регистрации
        if (count(array_keys($errors, '')) === count($errors)) {
            // Удаляем подтверждение пароля из данных
            unset($data['passConfirm']);

            // Генерируем соль и хэш для пароля
            $data['salt'] = bin2hex(random_bytes(8));
            $data['pass'] = sha1($data['pass'] . $data['salt']);

            // Создаем ключ для хранения сессий в будущем
            $data['session_id'] = [];

            // Создаем нового пользователь
            $this->crudHandler->create($data);

            // Возвращаем результат регистрации
            return ['success' => true];
        } 
        // Возвращаем ошибки валидации, если данные невалидны
        return ['success' => false, 'errors' => $errors];
    }

    // Функция для проверки данных на валидность
    public function isValidData($data)
    {
        // Определяем поля для проверки
        $fields = [
            'login' => trim($data['login']),
            'name' => trim($data['name']),
            'email' => trim($data['email']),
            'pass' => trim($data['pass']),
            'passConfirm' => trim($data['passConfirm'])
        ];

        // Проверяем, используется ли логин или email
        $usedLogin = $this->crudHandler->readBy('login', $fields['login']);
        $usedEmail = $this->crudHandler->readBy('email', $fields['email']);

        // Инициализируем массив для ошибок
        $errors = [];

        // Проходим по всем полям и проверяем их на валидность
        foreach ($fields as $key => $value) {
            switch ($key) {
                // Проверки поля login
                case 'login':
                    if (preg_match('/\W/', $value)) {
                        $errors[$key] = '*В логине не должно быть пробелов и спец. символов';
                    }
                    elseif(strlen($value) < 6){
                        $errors[$key] = '*Длина логина должна быть от 6 символов';
                    }
                    elseif($usedLogin !== false){
                        $errors[$key] = '*Данный логин уже используется';
                    }
                    else{
                        $errors[$key] = '';
                    }
                    break;
                // Проверки поля name
                case 'name':
                    if (!preg_match('/^[a-zA-Z]+$/', $value)) {
                        $errors[$key] = '*В имени не дожно быть пробелов, цифр и спец. символов';
                    }
                    elseif(strlen($value) < 2){
                        $errors[$key] = '*Длина имени должна быть от 2 символов';
                    }
                    else{
                        $errors[$key] = '';
                    }
                    break;
                // Проверки поля email
                case 'email':
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $errors[$key] = '*Некорректный email';
                    }
                    elseif($usedEmail !== false){
                        $errors[$key] = '*Данный email уже используется';
                    }
                    else{
                        $errors[$key] = '';
                    }
                    break;
                // Проверки поля password
                case 'pass':
                    if(!preg_match('/^(?=.*[a-zA-Z])(?=.*\d).+$/', $value)){
                        $errors[$key] = '*Пароль должен состоять из букв и цифр';
                    }
                    elseif(preg_match('/\W/', $value)) {
                        $errors[$key] = '*В пароле не должно быть пробелов и спец. символов';
                    }
                    elseif(strlen($value) < 6){
                        $errors[$key] = '*Длина пароля должна быть от 6 символов';
                    }
                    else{
                        $errors[$key] = '';
                    }
                    break;
                // Проверки поля password confirm
                case 'passConfirm':
                    if($value!== $fields['pass']){
                        $errors[$key] = '*Пароли не совпадают';
                    }
                    else{
                        $errors[$key] = '';
                    }
                    break;    
            }
        }
        // Возвращаем массив ошибок
        return $errors;
    }
}