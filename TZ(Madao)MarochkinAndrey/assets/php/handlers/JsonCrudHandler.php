<?php
class JsonCrudHandler
{
    // Путь к файлу, в котором хранятся данные пользователей
    private $filePath = '../../db/users.json';

    // Создает нового пользователя, добавляя его данные в JSON-файл.
    public function create($data)
    {
        // Читаем текущие данные из файла
        $jsonData = json_decode(file_get_contents($this->filePath), true);
        
        // Добавляем новые данные в массив
        $jsonData[] = $data;
        
        // Записываем обновленные данные обратно в файл
        file_put_contents($this->filePath, json_encode($jsonData, JSON_PRETTY_PRINT), LOCK_EX);
    }

    // Возвращает данные всех пользователей из JSON-файла. 
    public function readAll()
    {
        // Проверяем, существует ли файл
        if (!file_exists($this->filePath)) {
            // Если нет, создаем пустой файл
            file_put_contents($this->filePath, json_encode([], JSON_PRETTY_PRINT));
        }
        
        // Читаем данные из файла
        $jsonData = json_decode(file_get_contents($this->filePath), true);
        
        return $jsonData;
    }

    // Возвращает данные пользователя по ключу.
    public function readBy($keyName, $key)
    {
        $allUsers = $this->readAll();

        // Проверяем, существуют ли данные
        if(isset($allUsers)){
            foreach ($allUsers as $user) {
                // Ищем пользователя по ключу
                if ($user[$keyName] === $key) {
                    return $user;
                }
            }
        }
        return false;
    }

    // Обновляет данные пользователя.
    public function update($login, $data)
    {
        $allUsers = $this->readAll();

        // Проходим по всем пользователям
        foreach ($allUsers as $key => $user) {
            // Находим пользователя по логину
            if ($user['login'] === $login) {
                // Обновляем данные пользователя
                foreach($data as $dataKey => $dataValue){
                    $allUsers[$key][$dataKey] = $dataValue;
                }
                
                // Записываем обновленные данные обратно в файл
                file_put_contents($this->filePath, json_encode($allUsers, JSON_PRETTY_PRINT), LOCK_EX);
                
                return true;
            }
        }
        return false;
    }

    // Удаляет пользователя по логину.
    public function delete($login)
    {
        $allUsers = $this->readAll();

        // Фильтруем пользователей, оставляя только тех, кто не совпадает с логином
        $newUsers = array_filter($allUsers, function($user) use ($login){
            return $user['login']!== $login;
        });
        
        // Записываем обновленные данные обратно в файл
        file_put_contents($this->filePath, json_encode($newUsers, JSON_PRETTY_PRINT), LOCK_EX);
    }
}
