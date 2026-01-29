<?php
session_start();

function is_login()
{
    if (isset($_SESSION["username"])) {
        return true;
    } else return false;
}