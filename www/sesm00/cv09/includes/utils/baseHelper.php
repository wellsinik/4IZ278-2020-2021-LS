<?php require_once __DIR__ . '/../classes/UsersDB.php'; ?>
<?php

function removeURLParams($url) {
    $params = explode("?", $url);
    if (count($params) == 2) {
        $url = str_replace("?" . $params[1], "", $url);
    }
    return $url;
}

function getURLFile($url = NULL) {
    if ($url == NULL) {
        $url = removeURLParams($_SERVER['REQUEST_URI']);
    }
    if (substr($url, -3) == "php") {
        $parts = explode("/", $url);
        return $parts[count($parts) - 1];
    }
    return null;
}

function getBaseUrl() {
    $url = $_SERVER['REQUEST_URI'];
    $url = removeURLParams($url);
    $url = str_replace("/admin", "", $url);
    $file = getURLFile();
    if (isset($file)) {
        $url = str_replace($file, "", $url);
    }
    return $url;
}

function getCurrentUrl() {
    return $_SERVER['REQUEST_URI'];
}

function urlMatchPath($pathRoot, $url) {
    $result = array();
    $pattern = str_replace("/", "\/", $pathRoot);
    preg_match('/'. $pattern . '/', $url, $result);
    return (count($result) > 0);
}

function verifyUserAccess($accessLevel) {
    $usersDB = new UsersDB();
    $users = $usersDB->fetchBy(array('where' => array('ident' => $_COOKIE['user'])));

    if (count($users) == 0) {
        setcookie('user', "");
        header('Location: ' . BASE_URL);
        die();
    }

    if ($accessLevel != (PRIVILEGE_MANAGER | PRIVILEGE_ADMINISTRATOR)) {
        if ($accessLevel != $users[0]['privilege']) {
            header('Location: ' . BASE_URL);
            die();
        }
    } else {
        if ($users[0]['privilege'] == PRIVILEGE_CUSTOMER) {
            header('Location: ' . BASE_URL);
            die();
        }
    }
}

function hasUserAccess($accessLevel) {
    $usersDB = new UsersDB();
    $users = $usersDB->fetchBy(array('where' => array('ident' => $_COOKIE['user'])));

    if (count($users) == 0) {
        return false;
    }

    if ($accessLevel == $users[0]['privilege']) {
        return true;
    }

    return false;
}