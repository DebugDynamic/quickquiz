<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Present Perfect Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        #game-container {
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #000;
            border-radius: 10px;
            max-width: 500px;
            background-color: #f9f9f9;
        }
        .question {
            font-size: 1.2em;
            margin: 20px 0;
        }
        .options {
            display: flex;
            justify-content: space-around;
        }
        .option {
            padding: 10px 20px;
            border: 1px solid #000;
            border-radius: 5px;
            cursor: pointer;
            background-color: #fff;
        }
        .correct {
            background-color: #a5d6a7;
        }
        .wrong {
            background-color: #ef9a9a;
        }
        #score {
            margin-top: 20px;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div id="game-container">
        <h1 id="title"></h1>
        <div id="question" class="question"></div>
        <div id="options" class="options"></div>
        <div id="score"></div>
        <button id="next" style="display:none; padding: 8px; border-radius: 8px; background-color: #4ec2bf; color: white; border: none;">Next Question</button>
    </div>
    <script>
    async function updateTitle() {
        const url = `config.json?nocache=${new Date().getTime()}`;
        const response = await fetch(url);
        const data = await response.json();
        const titleElement = document.getElementById('title');
        titleElement.textContent = data.title;
    }

    updateTitle();
    </script>

    <!-- Use a unique query parameter to prevent caching of game.js -->
    <script src="game.js?nocache=<%= new Date().getTime() %>"></script>
</body>
</html>
