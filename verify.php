<?php
    session_start();
    if(isset($_SESSION['id'])){
        header("location:index.php?id=0");
    }
    $login = $_POST['login'];
    $pwd = $_POST['pwd'];
    $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
    $sql = "SELECT * FROM user where login='$login' and password=sha1('$pwd')";
    $result=$conn->query($sql);
    if($result->rowCount() == 1){
        $data=$result->fetch(PDO::FETCH_ASSOC);
        $_SESSION['username'] = $data['login'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['id'] = session_id();
        $conn = null;
        header('location:index.php?id=0');
        die();
    }
    else{
        $_SESSION['error'] = "error";
        $conn = null;
        header("location:login.php");
        die();
    }
?>
