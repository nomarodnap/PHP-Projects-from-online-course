<?php

function log_in_admin($admin) {
    session_regenerate_id();
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['username'] = $admin['username'];

    return true;
}

function is_logged_in() {
    return isset($_SESSION['admin_id']);
}

function require_login() {
    if(!is_logged_in()){
        redirect_to(url_for('/staff/login.php'));
    } else {
        // do nothing, let pass
    }
}

function log_out_admin(){
    unset($_SESSION['admin_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['username']);

    return true;
}

?>