<?php

session_start();

if (!isset($_SESSION['loggedIn']) or $_SESSION['role_id'] != 1) {
    redirect('');
}