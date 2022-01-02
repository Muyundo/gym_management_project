<?php
session_start();
require('../includes/connect.php');
class User extends dbConfig{//extend properties of the parentclass
    protected $hostName;
    protected $userName;
    protected $password;
    protected $dbName;
    private $users = 'user';
    private $dbConnect = false;
    public function __construct(){//used to pass parameters when you firstcreate an object
        if(!$this -> dbConnect){
            $database = new dbConfig();
            $this -> hostName = $database -> serverName;
            $this -> userName = $database -> userName;
            $this -> password = $database -> password;
            $this -> dbName = $database -> dbName;
            $conn = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);
            if($conn->connect_error){
                die("Error: Filed to connect to MYSQL: " . $conn->connect_error);
            }else{
                $this -> dbConnect = $conn;
            }



        }

    }
    public function adminLogin(){

        $errorMessage = '';
        if(!empty($_POST['login']) && $_POST["email"]!='' && $_POST["pass"]!=''){
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $sqlQuery = "SELECT * FROM" .$this -> users. "WHERE email = '".$email."' AND pass ='".md5($pass)."'AND utype = 'admin' ";
             $resultSet = mysqli_num_rows($this-> $connect, $sqlQuery);
             $isValidLogin = mysqli_num_rows($resultSet);
             if($isValidLogin){
                 $userDetails = mysqli_fetch_assoc($resultSet);
                 $_SESSION['adminUserid'] = $userDetails['user_id'];
                 $_SESSION['admin'] = $userDetails['fname']. " ".$userDetails['lname'];
                 header("location: index.php");
        
        
             }else{
                 $errorMessage = 'Invalid Login';
             }
        } else if(!empty ($_POST['login'])){
            $errorMessage = 'Enter user name and password';
        }
        return $errorMessage;
        
        }

        public function register(){

            $message = '';
            if(!empty($_POST['register']) && $_POST['email'] != ''){
                $uQuery = "SELECT * FROM " .$this -> users. "WHERE email = '".$_POST['email']."' ";
                $result = mysqli_query($this -> dbConnect, $uquery);
                $isUserExist = mysqli_num_rows($result);
                if($isUserExist){
                    $message = "User already exist with this email address";
                }else{
                    $authtoken = $this -> getAuthtoken($_POST['email']);
                    $insertQuery = "INSERT INTO ".$this -> users. "(fname, lname, phone, email, uname, utype, pass, authtoken)
                    VALUES( '" .$_POST[ "fname" ]. "', '".$_POST["lname"]. "', '".$_POST["phone"]. "', '".$_POST["email"]. "', 
                    '".$_POST["uname"]. "', '".$_POST["utype"]. "', '".md5($_POST["pass"]). "', '".$authtoken. "'  )";
                    $userSaved = mysqli_query($this-> dbConnect, $insertQuery);
                    if($userSaved){
                        $link = "<a href='http://webdamn.com/demo/user-management-system/verify.php?authtoken=".$authtoken."'>Verify Email</a>";
                        $toEmail = $_POST["email"];
                        $subject = "Verify to complete registration";
                        $msg = "Hi there, click on this" .$link. " to verify email to complete registration.";
                        $msg = wordwrap($msg, 70);
                        $headers = "From: Kimfitty training fitness";
                        if(mail($toEmail, $subject, $msg, $headers)){
                            $message = "Verification message send to your email. Please check emailand verify to complete registration.";
                        }else{
                            $message = "User registration request failed";
                    }
                }
            }
        }
                return $message;
            }
            public function getAuthtoken($email){
                $code = md5(889966);
               $authtoken = $code."".md5($email);
               return $authtoken;

            }

            public function verifyRegister(){
                $verifyStatus = 0;
                if(!empty($_GET["authtoken"]) && $_GET["authtoken"] !="" ){
                    $uquery = "SELECT * FROM ".$this -> users. " WHERE authtoken = '".$_GET["authtoken"]."' ";
                    $resultSet = mysqli_query($this -> dbConnect, $sqlQuery);
                    $isValid = mysqli_num_rows($resultset) ;
                    if($isValid){

                        $userDetails = mysqli_fetch_assoc($resultset);
                        $authtoken = $this-> getAuthtoken($userDetails["email"]);
                        if($authtoken == $_GET["authtoken"]){
                            $updateQuery = "UPDATE" .$this -> users. "SET status = 'active' WHERE user_id = '".$userDetails['id']."'";
                            $isUpdated = mysqli_query($this-> dbConnect, $updateQuery);
                            if($isUpdated){
                                $verifyStatus = 1;
                            }
                        }
                    }
                }
                return $verifyStatus;

            }

            public function getUserList(){
                $sqlQuery = "SELECT * FROM" $this->users. "WHERE user_id != '".$_SESSION['adminUserId']."' " ;
                if(!empty($_POST["search"]["value"])){
                    $sqlQuery .= '(user_id LIKE "%'.$_POST["search"]["value"].'%" ';
                    $sqlQuery .= 'OR fname LIKE "%' .$_POST["search"]["value"].'%" ';
                    $sqlQuery .= 'OR lname LIKE "%'.$_POST["search"]["value"].'%"';
                    $sqlQuery .= 'OR email LIKE "%'.$_POST["search"]["value"].'%"';
                    $sqlQuery .= 'OR phone LIKE "%'.$_POST["search"]["value"].'%" ';
                    $sqlQuery .= 'OR utype LIKE "%'.$_POST["value"]["search"].'%" ';
                    $sqlQuery .= 'OR status LIKE "%'.$_POST["search"]["value"].'%")';
                }
                if(!empty($_POST["order"])){
                    $sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';

                }else{
                    $sqlQuery .= 'ORDER BY user_id DESC';

                }
                if($_POST["length"]!= -1){
                    $sqlQuery .= 'LIMIT' .$_POST['start']. ', ' . $_POST['length'];

                }
                $result = mysqli_query($this -> dbConnect, $sqlQuery);
                $sqlQuery1 = "SELECT *FROM " .$this-> users. "WHERE user_id != '".$_SESSION['adminUserId']."' ";
                $result1 = mysqli_query($this -> dbConnect, $sqlQuery1);
                $numRows = mysqli_num_rows($result1);

                $userData = array();
                while($users mysqli_fetch_assoc($result)){
                    $userRows = array();
                    $status = '';
                if($users['status']== 'active'){
                    $status = '<span class="label label-success">Active</span>';
                } else if($users['status'] == 'pending') {
                    $status = '<span class="label label-warning">Inactive</span>';
                } else if($users['status'] == 'deleted') {
                    $status = '<span class="label label-danger">Deleted</span>';
                }
                $userRows[]= $users['user_id'];
                $userRows[]= $users['fname'];
                $userRows[]= $users['fname'];
                $userRows[]= $users['email'];
                $userRows[]= $users['phone'];
                $userRows[]= $users['utype'];
                $userRows[]= $status;
                $userRows[]=  '<button type="button" name="update" id="'.$users["user_id"].'" 
                class="btn btn-warning btn-xs update">Update</button>';
                $userRows[] = '<button type="button" name="delete" id="'.$users["user_id"].'"
                 class="btn btn-danger btn-xs delete" >Delete</button>';
               $userData[]= $userRows;

                }
                $output = array(
                    "draw"          => intval($_POST["draw"]),
                    "recordsTotal"  => $numRows,
                    "recordsFiltered" => $numRows,
                    "data"            => $userData
                );
                echo json_encode ($output);

            }
            


        }
        

?>