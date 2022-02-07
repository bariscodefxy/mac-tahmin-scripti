<?php

function hook($name, $callback = null, $value = null, $priotiry = 0){
    static $events = [];
    if($callback !== null) {
        if($callback) {
            $events[$name][$callback] = $priotiry;
        }else {
            unset($events[$name]);
        }
    }else if(isset($events[$name])){
        foreach($events[$name] as $callback => $priotiry){
            $value = call_user_func($callback, $value);
        }
        return $value;
    }
    return $value;
}
function add_hook($name, $callback, $priotiry = 0){
    return hook($name, $callback, null, $priotiry);
}
function run_hook($name, $value){
    return hook($name, null, $value);
}
function remove_hook($name){
    hook($name, false);
}