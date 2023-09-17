import { router } from '@inertiajs/react';

$('#addUserForm').submit(function(e){
    e.preventDefault();

    $.ajax({
        url: "/users",
        type: "POST",
        data: $(this).serialize(),
        success: function(response){

                $('#addUserModal').modal('hide');
                $('#addUserForm')[0].reset();
                router.visit('/chat',{ only: ['users','msg_to'], data: { msg_to: response.user } });
        },
        error: function(error){
            alert(error.responseJSON.message);
        }
    });
});

$('#addChatForm').submit(function(e){
    let recieverId = $('#addChatForm input[name="msg_to"]').val();
    e.preventDefault();
    $.ajax({
        url: "/chat",
        type: 'POST',
        data: $(this).serialize(),
        success: function (data) {
                $('#addNewMessageModal').modal('hide');
                $('#addChatForm')[0].reset();
                router.visit('/chat',{ data: { msg_to: data.msg_to } });
        },
        error: function(error){
            alert(error.responseJSON.message);
        }
    });
});
