<?php

class PageManager {

    private SessionManager $sessionmanager;

    private \PDO $db;

    public function __construct(\PDO $db){
        $this->sessionmanager = new SessionManager();
        $this->db             = $db;
    }

    public function getSessionManager() : SessionManager {
        return $this->sessionmanager;
    }

    public function loadHeader(){
        if(@$_GET['page'] === "cikis-yap" && $this->getSessionManager()->has('login')) session_destroy(); // cikis yapma kodu
        include_once view_dir . "Header.view.php";
        return $this;
    }

    public function loadFooter(){
        include_once view_dir . "Footer.view.php";
        return $this;
    }

    public function loadPage(){
        $page = @$_GET['page'];
        switch($page) {
            case "mac-tahminleri":
                if(!$this->getSessionManager()->has("login")) break;
                include_once view_dir . "Mac-tahminleri.view.php";
                break;
            case "kayit-ol":
                if($this->getSessionManager()->has("login")) break;
                $notice = null;
                if(@$_POST) {
                    $username   = @$_POST['username'];
                    $password   = @$_POST['password'];
                    $email      = @$_POST['email'];

                    if(!$username || !$password || !$email) {
                        $notice = ["error", "Lütfen boş alan bırakmayın"];
                    }else {
                        if(strlen($username) < 3 || strlen($username) > 32) {
                            $notice = ["error", "Kullanıcı adınız 3 ile 32 harf arasında olmalıdır."];
                        }else {
                            $query = $this->db->prepare("SELECT * FROM kullanicilar WHERE username = ?");
                            $query->execute([$username]);
                            if($query->rowCount()) {
                                $notice = ["error", "Bu kullanıcı adı bulunuyor."];
                            }else {
                                if(preg_match("/\W+/", $username)) {
                                    $notice = ["error", "Kullanıcı adı hatalı."];
                                }else {
                                    if(strlen($password) < 8 || strlen($password) > 255) {
                                        $notice = ["error", "Şifreniz 8 ile 255 karakter arasında olmalıdır."];
                                    }else {
                                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                            $notice = ["error", "Hatalı email adresi."];
                                        }else {
                                            $query = $query = $this->db->prepare("SELECT * FROM kullanicilar WHERE email = ?");
                                            $query->execute([$email]);
                                            if($query->rowCount()) {
                                                $notice = ["error", "Bu eposta bulunuyor."];
                                            }else {
                                                // success
                                                $query = $this->db->prepare("INSERT INTO kullanicilar SET
                                                    username      = :username,
                                                    password      = :password,
                                                    email         = :email,
                                                    register_time = :register_time");
                                                $exec = $query->execute([
                                                    "username"      => $username,
                                                    "password"      => md5(hash('sha256', $password)),
                                                    "email"         => $email,
                                                    "register_time" => time()
                                                ]);
                                                if($exec) {
                                                    $this->getSessionManager()->set("login", true);
                                                    $this->getSessionManager()->set("username", $username);
                                                    $this->getSessionManager()->set("password", md5(hash('sha256', $password)));
                                                    $this->getSessionManager()->set("email", $email);
                                                    $notice = ["success", "Başarıyla kayıt oldunuz..."];
                                                }else {
                                                    $notice = ["error", "Kayıt olurken bir hata oluştu."];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                include_once view_dir . "Kayit-ol.view.php";
                break;
            case "giris-yap":
                if($this->getSessionManager()->has("login")) return;
                $notice = null;
                if(@$_POST) {
                    $username = @$_POST['username'];
                    $password = @$_POST['password'];
                    if(!$username || !$password) {
                        $notice = ["error", "Boş kullanıcı adı veya şifre."];
                    }else {
                        $password = md5(hash('sha256', $password)); // password encrypt
                        $query = $this->db->prepare("SELECT * FROM kullanicilar WHERE username = ? AND password = ?");
                        $query->execute([$username, $password]);
                        if($query->rowCount()) {
                            $fetch = $query->fetch(PDO::FETCH_ASSOC);
                            $this->getSessionManager()->set("login", true);
                            $this->getSessionManager()->set("username", $fetch["username"]);
                            $this->getSessionManager()->set("password", $fetch["password"]);
                            $this->getSessionManager()->set("email", $fetch["email"]);
                            $notice = ["success", "Başarıyla giriş yaptınız..."];
                        }else {
                            $notice = ["error", "Yanlış kullanıcı adı veya şifre."];
                        }
                    }
                }
                include_once view_dir . "Giris-yap.view.php";
                break;
            case "cikis-yap":
                include_once view_dir . "Cikis-yap.view.php";
                break;
            default: // canli-maclar
                include_once view_dir . "Canli-maclar.view.php";
                break;
        }
        return $this;
    }

}