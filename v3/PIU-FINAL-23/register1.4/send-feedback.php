<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="resources/css/send-feedback.css">
</head>
<body>
    <form action="submit_feedback.php" method="post">
        <h2>Feedback Form</h2>

        <label for="feedback">Feedback:</label>
        <textarea id="feedback" name="feedback" rows="4" required></textarea>

        <label for="device">Device:</label>
        <select id="device" name="device" required>
            <option value="smartphone">Smartphone</option>
            <option value="desktop">Desktop</option>
        </select>

        <label for="browser">Browser:</label>
        <input type="text" id="browser" name="browser" required>
        <button type="submit">Submit Feedback</button>
    </form>
</body>
</html>