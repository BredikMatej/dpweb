<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Specify your email and subject
    $toEmail = "matejbredikdp@gmail.com";
    $subject = "Website Contact Form: $name";
    $body = "You have received a new message from your website contact form.\n\n" .
        "Here are the details:\n\nName: $name\n\n" .
        "Email: $email\n\nMessage:\n$message";

    // Headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email
    if (mail($toEmail, $subject, $body, $headers)) {
        // Success message
        echo "<p>Thank you for contacting us, $name. We will get back to you soon.</p>";
    } else {
        // Error message
        echo "<p>Oops! Something went wrong, and we couldn't send your message.</p>";
    }
} else {
    // Not a POST request
    echo "<p>Something went wrong.</p>";
}