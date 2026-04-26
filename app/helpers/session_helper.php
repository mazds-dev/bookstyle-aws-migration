<?php

if (!function_exists('startSessionIfNotStarted')) {
    function startSessionIfNotStarted() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}

//var_dump('loaded'); exit;
