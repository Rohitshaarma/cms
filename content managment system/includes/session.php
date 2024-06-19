<?php

session_start();

function Errormessage(){

    if(isset($_SESSION['Errormessage'])){
        $output = '<div class="alert alert-danger">';
        $output .= htmlentities($_SESSION['Errormessage']);
        $output .='<div>';

        $_SESSION["Errormessage"] = null;

        return $output;
    }

}

function successmessage(){

    if(isset($_SESSION['successmessage'])){
        $output = '<div class="alert alert-success">';
        $output .= htmlentities($_SESSION['successmessage']);
        $output .='<div>';

        $_SESSION["successmessage"] = null;

        return $output;
    }

}


?>