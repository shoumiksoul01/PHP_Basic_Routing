<?php

declare(strict_types =1);
$uri= parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
$uri= rtrim($uri,'/') ?: '/';
$method= $_SERVER['REQUEST_METHOD'];

match(true){
    $uri ==='/' && $method ==='GET'
        => homepage(),

    $uri=== '/about'&&  $method ==='GET'
        => aboutpage(),

    $uri ==='/contact'&& $method ==='GET'
        =>  contactpage(),

    $uri ==='/contact' && $method==='POST'
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
        http_response_code(422);
        require __DIR__ .'/views/contact.php';
        return;

    }

    $record = sprintf("[%s]\n Name: %s\n Email: %s\n Message: %s\n------------------\n",
    date('Y-m-d H:i:s'),
    $name,
    $email,
    $message
    
    );

    file_put_contents(
        __DIR__ . '/storage/contacts.txt',
        $record,
        FILE_APPEND
    );

    header('Location: /contact?success=1');
    exit;

 

}
function notFound(): void
{
    http_response_code(404);
    require __DIR__ . '/views/404.php';
}




?>