<?php
include '../classes/Mysql.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $login_data = json_decode($_POST['loginData'], true);

   switch($login_data['typeUser']) {
      case 'admin_auth':
         $response = null;
         $mysql = new Mysql();
         if($mysql->dbConnect()) {
            $response = $mysql->checkAdmin($login_data);
            $mysql->dbDisconnect();
         }
         if (!$response) {
            echo json_encode(['response'=>"Ошибка авторизации!"]);
         } else {
            session_start();
            $_SESSION['USER'] = 'administrator';
            echo json_encode(['response'=> "Вы авторизовались как администратор!"]);
         }

         break;
   }
}