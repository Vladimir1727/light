<?php
class Controller_ajax extends diam\test\Controller
{
    function __construct()
    {
        $this->model = new Model_ajax();//подключаем модель
    }

    function action_add()//добавляем комментарий
    {
        $res = $this->model->add($_POST['user_id'], $_POST['parent_id'], trim($_POST['comment']));
    }
    
    function child($data, $id){//поиск "потомков"-комментариев
        $find = FALSE;
        $html = '';
        foreach ($data as $d){
            if ($d['parent_id'] == $id){
                if ($find == FALSE){
                    $find = TRUE;
                    $html = '<ul>';
                }
                $html .= '<li><p>'
                        . '<strong>'.$d['create_at'].'</strong> '
                        .$d['comment']
                        .'<span class="hidden">'.$d['id'].'</span></p>'
                        .$this->child($data, $d['id'])
                        .'</li>';
            }
        }
        if ($find == TRUE){
            $html .= '</ul>';
        }
        return $html;
    }
    
    function action_showAll()//возвращает список всех сообщений
    {
        $data = $this->model->showAll();
        $html = '';
        foreach ($data['posts'] as $d){
            if ($d['parent_id'] == 0){
                $html .= '<div><span class="down"></span><p>'
                        . '<strong>'
                        .$d['create_at'].'</strong> '
                    .$d['comment'].'<span class="hidden">'.$d['id'].'</span></p>'
                    .$this->child($data['comments'], $d['id'])
                    .'</div>';
            }
        }
        echo ($html);
    }
    
    function action_edit()//загружает сообщение для редактирования
    {
        echo $this->model->edit($_POST['id'], $_POST['user_id']);
    }
    
    function action_save()//изменяет сообщение в базе
    {
        $res= $this->model->save($_POST['id'], $_POST['comment']);
    }
}