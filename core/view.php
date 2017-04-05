<?php
namespace diam\test;
class View
{
	
	//public $template_view; // здесь можно указать общий вид по умолчанию.
	
	/*
	$content_file - виды отображающие контент страниц;
	$template_file - общий для всех страниц шаблон;
	$data - массив, содержащий элементы контента страницы. Обычно заполняется в модели.
	*/
	function generate($content_view, $stamp_view, $data = null)
	{
		
		
		if(is_array($data)) {
			
			// преобразуем элементы массива в переменные
			extract($data);
		}
		
		
		include 'view/'.$stamp_view;
	}
}
