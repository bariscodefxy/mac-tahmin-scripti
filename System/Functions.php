<?php

/**
 * @param $title
 * @return string|null
 */
function pageTitle($title){
    $page = @$_GET['page'];
    if($page) {
        switch($page){
            case "mac-tahminleri":
                return "$title - Maç Tahminleri";
                break;
            default:
                return "$title - Canlı Maçlar";
                break;
        }
    }
    return null;
}