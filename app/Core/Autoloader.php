<?php

namespace Core;
class Autoloader
{
    public static function registrate($dir) //Статический методы вызываются без создания объекта
    {
        $autoloader = function (string $className) use ($dir) // Анонимные функции
        {
            // '\\' - первый слэш экранирует, а второй означает, то что наш слэш обратный
            $path = str_replace('\\', DIRECTORY_SEPARATOR, $className); //App
            //str_replace - Заменяет все вхождения строки поиска на строку замены

            $path = $dir . '/' . $path . '.php'; // /var/www/html/app/App.php

            if (file_exists($path)) { // Проверяет, есть ли такой файл
                require_once $path;
                return true;
            }
            return false; //Если нет такого файла, то переходит на другой Autoloader
        };

        spl_autoload_register($autoloader); // Запускает Автолоадер
    }
}
