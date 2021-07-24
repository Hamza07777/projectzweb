<?php

function isAdmin(){
    if(auth()->user() && auth()->user()->role == 'admin'){
        return true;
    }

    return false;
}

function isUser(){
    if(auth()->user() && auth()->user()->role == 'user'){
        return true;
    }

    return false;
}

function vaccineDetailPath(){
    return 'assets/images/vaccine-detail/';
}

function alertImagePath(){
    return 'assets/images/alert/';
}

function userImagePath(){
    return 'assets/images/user/';
}

function userBarCodePath(){
    return 'assets/images/user/barcode/';
}

function alertVideoPath(){
    return 'assets/videos/alert/';
}
