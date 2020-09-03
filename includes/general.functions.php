<?php

/**
 * check if user logged in or not
 */
function checkLogin()
{
    return isset($_SESSION['user'])? true : false;
}