<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Изменить</h4>
      </div>
      <div class="modal-body">
          <form id="edit_form">
              <input type="hidden" id="edit_id" name="id">
              <textarea id="edit_comment" name="comment" class="form-control">
              </textarea>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="save_but">Сохранить</button>
      </div>
    </div>

  </div>
</div>

<form class="form-inline" id="send_form">
    <input type="hidden" value="<?php echo $user_id; ?>" name="user_id" id="user_id">
    <input type="hidden" value="0" name="parent_id" id="parent_id">
    <textarea class="form-control" rows="4" cols="40" name="comment" id="comment">
    </textarea>
    <div class="btn btn-group-vertical">
        <button class="btn btn-default" id="send_but">Оставить сообщение</button>
        <button class="btn btn-default" id="comment_but">Оставить комментарий</button>
        <button type="button" class="btn btn-default hidden" data-toggle="modal" data-target="#editModal" id="edit_but">
            Редактировать
        </button>
    </div>
</form>