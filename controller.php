<!-- Casey Hsu Student Id: 101376814 -->
<?php

include "config.php";
include LIB_PATH . "functions.php";

// If there is a choice grab it if not current will be default
$page = request('option', 'login');

switch ($page) {
    case 'login':
        include_once VIEW_PATH . "header.php";
        include_once VIEW_PATH . "login.php";
        include_once MODEL_PATH . "login.php";
        include_once VIEW_PATH . "footer.php";
        break;
    case 'signup':
        include_once VIEW_PATH . "header.php";
        include_once VIEW_PATH . "signup.php";
        include_once MODEL_PATH . "signup.php";
        include_once VIEW_PATH . "footer.php";
        break;
    case 'assessments':
        include_once VIEW_PATH . "header.php";
        include_once VIEW_PATH . "assessments.php";
        include_once MODEL_PATH . "assessments.php";
        include_once VIEW_PATH . "footer.php";
        break;
    case 'upload':
        include VIEW_PATH . "header.php";
        include VIEW_PATH . "upload.php";
        include MODEL_PATH . "upload.php";
        include VIEW_PATH . "footer.php";
        break;
    case 'error':
        include_once VIEW_PATH . "header.php";
        include_once VIEW_PATH . "error.php";
        include_once VIEW_PATH . "footer.php";
        break;
    case 'logout':
        include_once MODEL_PATH . "logout.php";
        $page = 'login';
        break;
}
