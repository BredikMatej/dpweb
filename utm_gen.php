<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UTM Campaign Link Generator</title>
</head>
<body>
<h2>UTM Campaign Link Generator</h2>
<form id="utmForm">
    <div>
        <p>Base URL: https://matejbredikdp.000webhostapp.com</p>
        <input type="hidden" id="baseUrl" name="baseUrl" value="https://matejbredikdp.000webhostapp.com/">
    </div>
    <div>
        <label for="utmSource">UTM Source:</label>
        <input type="text" id="utmSource" name="utmSource" required>
    </div>
    <div>
        <label for="utmMedium">UTM Medium:</label>
        <input type="text" id="utmMedium" name="utmMedium">
    </div>
    <div>
        <label for="utmCampaign">UTM Campaign:</label>
        <input type="text" id="utmCampaign" name="utmCampaign">
    </div>
    <div>
        <label for="utmTerm">UTM Term:</label>
        <input type="text" id="utmTerm" name="utmTerm">
    </div>
    <div>
        <label for="utmContent">UTM Content:</label>
        <input type="text" id="utmContent" name="utmContent">
    </div>
    <button type="button" onclick="generateLink()">Generate Link</button>
</form>
<p>Generated Link: <span id="generatedLink"></span></p>

<script src="./scripts/utm_script.js"></script>
</body>
</html>

