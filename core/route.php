<?php

namespace diam\test;
class Route
{

	static function start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'main';
		$action_name = 'index';
		
                $server = $_SERVER['REQUEST_URI'];
                $v = strpos($server, "=");
                if ($v){
                    $value = substr($server, $v+1);
                }
                $s = strpos($server, "?");
                if ($s){
                    $server = substr($server, 0 , $s);
                }
                $routes = explode('/', $server);

		// получаем имя контроллера
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
		
		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}

		// добавляем префиксы
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		/*
		echo "Model: $model_name <br>";
		echo "Controller: $controller_name <br>";
		echo "Action: $action_name <br>";
		*/

		// подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = strtolower($model_name).'.php';
		$model_path = "model/".$model_file;
		if(file_exists($model_path))
		{
			include_once "model/".$model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = ucfirst($controller_name).'.php';
		$controller_path = "controller/".$controller_file;
		if(file_exists($controller_path))
		{
			include_once "controller/".$controller_file;
		}
		else
		{
			Route::ErrorPage404();
		}
		
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;
		
		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
                        if ($v){
                            $controller->$action($value);
                        }
                        else {
                            $controller->$action();
                        }
		}
		else
		{
			Route::ErrorPage404();
		}

	}

	static function ErrorPage404()
	{
        include_once('view/404_view.php');
    }
    
}
