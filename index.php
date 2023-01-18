<?php
session_start();
if(isset($_SESSION['id'])){
    header("Location: main/");
} else {
    header("Location: login/");
}