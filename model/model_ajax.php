<?php
class Model_ajax extends diam\test\Model
{
    public function test(){
        $pdo=diam\test\bdtools::connect();
        return true;
    }

    public function add($user_id, $parent_id, $comment){//добавляем сообщение
        $pdo=diam\test\bdtools::connect();
        $ps=$pdo->prepare('insert into forum (user_id, parent_id, comment, create_at)'
                . ' values (?,?,?,?)');
        try {
                $ps->execute(array($user_id, $parent_id, $comment, date('Y-m-d',time())));
            } catch (PDOException $e) {
                    return false;
            }
        return true;
    }
    
    public function showAll(){//загружаем все сообщения
        $pdo=diam\test\bdtools::connect();
        $ps=$pdo->prepare('select * from forum '
                . ' where parent_id=0'
                . ' order by create_at DESC');
        $pc=$pdo->prepare('select * from forum '
                . ' where parent_id>0'
                . ' order by create_at ASC');
        try {
                $ps->execute();
                $pc->execute();
            } catch (PDOException $e) {
                    return false;
            }
        $data=array(
            'posts'=>$ps->fetchAll(),//все сообщения
            'comments'=>$pc->fetchAll()//все комментарии
        );
        return $data;
    }
    
    public function edit($id, $user_id)//загружаем сообщение для редактирования
    {
        $pdo = diam\test\bdtools::connect();
        $ps = $pdo->prepare('select comment from forum '
                . ' where id=? and user_id=?');
        try {
                $ps->execute(array($id, $user_id));
            } catch (PDOException $e) {
                    return false;
            }
        if ($r = $ps->fetch()){
            return $r['comment'];
        } else{
            return false;
        }
    }
    
    public function save($id, $comment)//сохраняем сообщение
    {
        $pdo=diam\test\bdtools::connect();
        $ps=$pdo->prepare('update forum set comment=?'
                . ' where id=?');
        try {
                $ps->execute(array($comment, $id));
            } catch (PDOException $e) {
                    return false;
            }
        return true;
    }
}