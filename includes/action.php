<?php
include('../classes/functions.php');
$user = new User();
if(!empty($_POST['action'])&& $_POST['action'] == 'listUser'){
    $user -> getUserList();
    }
    if(!empty($_POST['action'])&& $_POST['action'] == 'userDelete'){
        $user -> deletUser();
    }
    if(!empty($_POST['action']) && $_POST['action'] == 'getUser'){
        $user -> getUser();
    }
    if(!empty($_POST['action']) && $_POST['action'== 'addUser']){
        $user -> addUser();
    }
    if(!empty($_POST['action']) && $_POST['action'] == 'updateUser'){
        $user -> updateUser();
    }

?>