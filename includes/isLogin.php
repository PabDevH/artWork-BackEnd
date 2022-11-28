<?php
session_start();
if (!$_SESSION['userId']) {
    Header("Location: login.html");
}