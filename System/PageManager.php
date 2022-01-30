<?php

class PageManager {

    public function loadHeader(){
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
                include_once view_dir . "Mac-tahminleri.view.php";
                break;
            default: // canli-maclar
                include_once view_dir . "Canli-maclar.view.php";
                break;
        }
        return $this;
    }

}