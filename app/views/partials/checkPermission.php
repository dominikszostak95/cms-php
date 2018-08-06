<?php

session_start();

if (!isset($_SESSION['loggedIn'])) {
    redirect('');
}
