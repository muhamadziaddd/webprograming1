<?php

class Auth extends Controller {
    
    public function index() 
    {
        $this->view('auth/login');
    }

    public function register() 
    {
        $this->view('auth/register');
    }

    public function login()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $data['login'] = $this->model('Auth_model')->getUser($email, $password);
            
            if ($data['login']['role'] == "ADMIN") {
                // Login berhasil, setel variabel sesi untuk menandai bahwa pengguna telah login
                session_start();
                $_SESSION['isLoggedIn'] = true;
                
                // Arahkan pengguna ke halaman yang sesuai
                header('Location: ' . BASEURL . '/dashboard');
                exit();
            } else {
                
                header('Location: ' . BASEURL . '/');
                exit();
            }
        } else {
            header('Location: ' . BASEURL . '/auth');
            exit();
            
        }
    }


    public function logout()
    {
        // Perform any necessary cleanup or logout actions here

        // Destroy the session and unset session variables
        if (session_status() == PHP_SESSION_NONE){
            session_start();
            $_SESSION['isLoggedIn'] = false; // atau unset($_SESSION['isLoggedIn']);
            session_destroy();
        }

        // Redirect to the login page or any other desired page
        header('Location: ' . BASEURL . '/');
        exit();
    }

}