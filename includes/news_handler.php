<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['news_title'];
    $text = $_POST['news_text'];


    try {
        require_once "connect.php";

        $query = "INSERT INTO news (title, text) VALUES (?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$title, $text]);

        postToLinkedIn($title, $text);

        $pdo = null;
        $stmt = null;

        header("Location: ../news.php");

        die();
    }catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../news.php");
}

function postToLinkedIn($title, $text) {
    $accessToken = 'AQXiEU4dhl8EM_EsprP_u7PrUxUjc5W7N-wGIMX7vt79AtBQK5yYGTQJK8B0TVLFAxicf6NrDUL_kW3eXyTmrVhUJlwlmZTr2tNyC7UJbUhW-VVZvs7qWHvhyCbxc2A7zdSiXRPUYizwOp_wzNjQrMHltkG8ukqxD8TyR2YojW0fJozyoaN9BQ3k0nq7X628n0QWEY75kdzw3Djykmiol4mtpy2xUQMqvLHKfKsK247dIvfpvEZSOu91144gqS74ADuZh-LeuL5GBmSuVE72qIBs172BcHZ9tLs9xonmwOzG9h6tCFgXvGypJ4cFhzZC0oZ27D2uD4ebMPdEJu8jjeIzKbnxoQ'; // Replace with your actual access token

    // Define your article URL and other necessary details
    $articleURL = 'https://matejbredikdp.000webhostapp.com/news.php'; // Replace with the actual URL of the article
    $articleTitle = $title;
    $articleText = $text;

    $headers = [
        "Authorization: Bearer $accessToken",
        "Content-Type: application/json",
        "x-li-format: json"
    ];

    $postData = json_encode([
        'content' => [
            'title' => $articleTitle,
            'submitted-url' => $articleURL
        ],
        'comment' => $articleText,
        'visibility' => [
            'code' => 'anyone'
        ]
    ]);

    $ch = curl_init('https://api.linkedin.com/v2/ugcPosts');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    // Handle the response or log it for debugging
    error_log(print_r($response, true));
}