(function($){$(function(){
        
$('#send_but').click(function(){//кнопка Послать Сообщение
    if ($('#comment').val()!=''){
        $('#parent_id').val(0);
        var form = $('#send_form').serialize();
        $.ajax({
            url:'../ajax/add',
            type:'POST',
            data:form,
            success: function(){
                showAll();
            }
        });
    }
    return false;
});

$('#comment_but').click(function(){//кнопка Комментировать
    if ($('#comment').val()!=''){
        var form = $('#send_form').serialize();
        $.ajax({
            url:'../ajax/add',
            type:'POST',
            data:form,
            success: function(){
                showAll();
            }
        });
    }
    return false;
});

$('#save_but').click(function(){//кнопка Сохранить модального окна
    if ($('#comment').val()!=''){
        var form = $('#edit_form').serialize();
        $.ajax({
            url:'../ajax/save',
            type:'POST',
            data:form,
            success: function(){
                showAll();
            }
        });
    }
});

showAll();

function showAll(){//загружает все сообщения/комментарии
$.ajax({
        url:'../ajax/showAll',
        type:'POST',
        success: function(data){
            $('#desk').html(data);
            addClick();
            addSlide();
        }
    });
}

function addSlide(){//добавляет сворачивание/разворачивание для списка сообщений
    $('span.down').each(function(){
                $(this).click(function(){
                    $(this).parent().find('ul').slideToggle();
                    $(this).toggleClass('up');
                });
            });
}

function addClick(){//добавляет события по клику на сообщения
    if ($('#send_form').length>0){
        $('#desk p').each(function(){
           $(this).click(function(){
               var id = $(this).find('span').text();
               $('#parent_id').val(id);
               $('#desk p').removeClass('active');
               $(this).addClass('active');
               $.ajax({
                   url:'../ajax/edit',
                   type:'POST',
                   data:'id='+id+'&user_id='+$('#user_id').val(),
                   success: function(data){
                       if (data){
                           $('#edit_but').removeClass('hidden');
                           $('#edit_id').val(id);
                           $('#edit_comment').val(data);
                       } else {
                           $('#edit_but').addClass('hidden');
                           $('#edit_id').val(0);
                           $('#edit_comment').val('');
                       }
                   }
                });
           });
        });
    }
}



})})(jQuery)