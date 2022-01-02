$(document).ready(function(){
    var userData = $('#userList').DataTable({
        "lengthChange": false,
        "processing": true,
        "serverSide": true,
        "order":[],
        "ajax":{
            url: "action.php",
            type:"POST",
            data:{action:'listUser'},
            dataType:'JSON'
        },
        "columnDefs": [
            {
                "targets": [0, 7, 8],
                "orderable": false,
            },
        ],
        "pageLength": 10

    });
    $(document).on('click', '.delete', function(){
        var user_id = $(this).attr("id");
        var action = "userDelete";
        if(confirm("Are you sure you want to delete this user?")){

            $.ajax({
                url:"action.php",
                method: "POST",
                data:{userid:userid, action:ction},
                success:function(data){
                    userData.ajax.reload();
                }

            })
        }else{
            return false;
        }



    });

    $('#addUser').click(function(){
        $('#userModal').modal('show');
        $('#userForm')[0].reset();
        $('#passwordSection').show();
        $('.modal-title').html("<i class = 'fa fa-plus'></i>Add User");
        $('#action').val('addUser');
        $('#save').val('Add User');
    });



});