<?php
if (isset($_GET['nodata'])) {
    echo "<script>alert('Please enter your name and class!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGame</title>
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
        <form id="myForm" action="play.php" method="post">
          <label for="name" style="font-size: 120%">Your Name:</label><br>
          <input type="text" id="name" name="name" required style="padding: 8px; border-radius: 8px; font-size: 120%; text-align: center;"><br><br>
          <select id="class" name="class" style="padding: 8px; border-radius: 8px; font-size: 120%; text-align: center;" required>
            <option selected disabled value="NULL">Choose Group</option>
            <?php
            $jsonData = file_get_contents('config.json');
            // Assuming $jsonData contains your JSON data
            $data = json_decode($jsonData); // Decode the JSON data

            if ($data === null) {
                // Handle JSON decoding error
                die('Error decoding JSON data');
            }

            $groups = $data->groups; // Get the groups array from JSON
            foreach ($groups as $group) {
                $groupName = $group->name;
                echo "<option value=\"$groupName\">$groupName</option>"; // Output option element
            }
            ?>
          </select>
        <br><br>
          <button type="submit" style="width: 60%; border-radius: 8px; border: none; background-color: #fa2f33; color: white; font-size: 120%; max-height: 30px;">Mängi</button>
        </form>
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
