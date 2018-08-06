<?php

namespace App\Models;

use App\Core\App;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class User
{
    public $name;
    public $email;
    public $password;
    public $phoneNumber;

    public function __construct($name, $email, $password, $phoneNumber)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->phoneNumber = $phoneNumber;
    }

    public static function login($login, $pass)
    {

        $user = App::get('database')->login();

        if (!($user && password_verify($pass, $user['password']))) {
            redirect('');
            return view('login');
        } else {
            session_start();
            $_SESSION['loggedIn'] = true;
            $_SESSION['login_user'] = $login;
            $_SESSION['role_id'] = $user['role_id'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            return redirect('panel');
        }
    }

    public static function show()
    {
        return App::get('database')->selectAll('users');
    }

    public static function logout()
    {
        session_start();
        session_unset();
        session_destroy();
    }


    public static function traders()
    {
        return App::get('database')->select('users', 'role_id', 2);
    }

    public static function sendPassword($email)
    {
        $user = App::get('database')->select('users', 'email', $email);

        if (isset($user[0]->id)) {
            $mail = new PHPMailer(true);

            $mail->isSMTP();// Set mailer to use SMTP
            $mail->CharSet = "utf-8";// set charset to utf8
            $mail->SMTPAuth = true;// Enable SMTP authentication
            $mail->SMTPSecure = 'tls';// Enable TLS encryption, `ssl` also accepted

            $mail->Host = 'smtp.gmail.com';// Specify main and backup SMTP servers
            $mail->Port = 587;// TCP port to connect to
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->isHTML(true);// Set email format to HTML

            $mail->Username = 'ddumel55@gmail.com';// SMTP username
            $mail->Password = 'dumelu10';// SMTP password

            $mail->setFrom('ddumel55@gmail.com', 'Sklep Komputerowy');//Your application NAME and EMAIL
            $mail->Subject = 'Reset hasła';//Message subject
            $mail->MsgHTML("http://nauka.com/reset?id={$user[0]->id}");// Message body
            $mail->addAddress("{$user[0]->email}", 'Dominik');// Target email


            if (!$mail->send()) {
                die("Mailer Error: " . $mail->ErrorInfo);
            } else {
                die("Link został wysłany na podany adres email.");
            }
        } else {
            die("Nie znaleziono użytkownika o podanym adresie email.");
        }
    }

    public static function changePassword($id, $passsword)
    {
        $pass = password_hash($passsword, PASSWORD_BCRYPT);
        $sql = "update users set password = '{$pass}' where id = {$id};";
        App::get('database')->executeUpdate($sql);
    }

    public function store()
    {
        App::get('database')->insert('users', [
            'role_id' => 1,
            'name' => "'{$this->name}'",
            'email' => "'{$this->email}'",
            'password' => "'{$this->password}'",
            'phone_number' => "'{$this->phoneNumber}'",
            'created_at' => 'NOW()'
        ]);

        session_start();
        $_SESSION['loggedIn'] = true;
        $_SESSION['login_user'] = $this->email;
    }
}