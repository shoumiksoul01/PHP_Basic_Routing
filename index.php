<?php

declare(strict_types =1);
$uri= parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
$uri= rtrim($uri,'/') ?: '/';
$method= $_SERVER['REQUEST_METHOD'];

match($uri){
    $uri ==='/' && $method ==='GET'
        => homepage(),

    $uri=== '/about'&&  $method ==='GET'
        => aboutpage(),

    $uri ==='/contact'&& $method ==='GET'
        =>  contactpage(),

    $uri ==='/contact' && method==='POST'
        => handleContactForm(),

    default  => notFound()
    
};

function homepage():void {
    require __DIR__.'/views/home.php';

}
function aboutpage():void{
    require __DIR__.'/views/about.php';

}
function contactpage():void{
    require __DIR__.'/views/contact.php';

}
function handleContactForm():void{
    $name = trim($_POST['name']??"");
    $email = trim($_POST['email']??"");
    $message = trim($_POST['message']??"");
    $errors=[];

    if($name ===''){
        $errors[]="Name is required";

    }

    if($email===''){
        $errors[]= "Email is required";

    }

    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[]="Invalid email format";
    }

    if($message ===''){
        $errors[]="Message is required";
    }
    
    if(!empty($errors)){
        require __DIR__ .'/views/contact.php';
        return;

    }



}




?>