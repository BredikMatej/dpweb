<?php

session_start();

// Ensure the user is logged in and is admin
if (!isset($_SESSION['loggedin']) || $_SESSION['permission'] !== 0) {
    header("Location: index.php");
    exit();
}
require_once "includes/fetch_subscribers.php";

function sendNewsletter($subject, $body, $headers) {
    $subscribers = fetchSubscribers();
    foreach ($subscribers as $email) {
        mail($email, $subject, $body, $headers);
    }
    echo 'Newsletter has been sent to all subscribers.';
}

// Define newsletter content
$subject = "Your Weekly Newsletter";

$body = "
<html>
<head>
    <title>Your Weekly Newsletter</title>
</head>
<body>
    <h1>Hello, Subscribers!</h1>
    <p>We have a big sale coming up</p>
    <p>click here and find out!</p>
    <a href='https://matejbredik.in/includes/bigsale.html'>Big sale</a>
</body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <admin@matejbredik.in>' . "\r\n";

sendNewsletter($subject, $body, $headers);
?>
