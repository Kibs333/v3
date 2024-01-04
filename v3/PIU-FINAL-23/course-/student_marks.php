<?php
$adm="BIT/0841/2021";
$dept="BIT";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the $_POST array
    $year = $_POST["year"];
    $semester = $_POST["semester"];
    $semesterParts = explode('.', $semester);

//    $partA = $semesterParts[0];
//    $partB = $semesterParts[1];

    $reconstruct=$dept."_".$year."_".$semesterParts[0]."_".$semesterParts[1];


$directory = 'cat_marks';

// Check if the directory exists
if (is_dir($directory)) {
    // Get the list of files in the directory
    $files = scandir($directory);

    // Remove . and .. from the list
    $files = array_diff($files, array('..', '.'));

    // print_r($files);
    // // Output the list of files
    // foreach ($files as $file) {
    //     echo $file . '<br>';
    // }



} else {
    echo 'The directory does not exist.';
}



$filename = 'cat_marks/'.$reconstruct.'.json';

// Check if the file exists
if (file_exists($filename)) {
    // Read the JSON file content
    $jsonContent = file_get_contents($filename);

    // Decode the JSON data into a PHP array
    $data = json_decode($jsonContent, true); // Set the second parameter to true for an associative array

    // Check if JSON decoding was successful
    if ($data !== null) {
        // Access the data as a PHP array
        //print_r($data);
        if (isset($data['grades'][$adm])) {
            echo '<table>';
            echo '<caption> CAT MARKS '.$adm.'</caption>';
            echo '<tr>';
            echo '<th>UNIT NAME </th>';
            echo '<th>UNIT CODE </th>';
            echo '<th>LECTURER NAME </th>';
            echo '<th>CAT MARKS</th>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>'.$data['UnitName'].'</td>';
            echo '<td>'.$data['unitCode'].'</td>';
            echo '<td>'.$data['lecturer_name'].'</td>';
            echo '<td>'.$data['grades'][$adm].'</td>';
            echo '</tr>';
            echo '</table>';



            
        } else {




            echo "You have not been graded yet.Check back later";
        }
        





        // You can now work with the $data array

    } else {
        // JSON decoding failed
        echo 'Error decoding JSON.';
    }
} else {
    // File does not exist
    echo "
    <script>
        alert('The Cat Marks for the year $year on semester period $semester for $adm do not exist.  Try another combination or Check back later');
    </script>";
    
}


}


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
  /* Add some styling to the table */
  table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 20px;
    font-family: Arial, sans-serif;
    color: #333;
  }

  /* Add a subtle border to the table cells */
  table, th, td {
    border: 1px solid #ddd;
  }

  /* Style the table header */
  th {
    background-color: #f2f2f2;
    padding: 12px;
    text-align: left;
    font-weight: bold;
  }

  /* Style the table rows alternately for better readability */
  tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  /* Hover effect on table rows */
  tr:hover {
    background-color: #f5f5f5;
  }

  /* Style the table cells */
  td {
    padding: 10px;
  }

  /* Add some spacing between the table cells */
  td:not(:last-child) {
    padding-right: 20px;
  }

  /* Add a subtle shadow to the table for depth */
  table {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  /* Responsive table for small screens */
  @media (max-width: 600px) {
    table {
      font-size: 14px;
    }
  }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            
            height: 100vh;
        }

        .form-container {
            display: flex;
            margin: 0 auto;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-top:20px;
        }

        .form-container label {
            display: block;
            margin-bottom: 8px;
        }

        .form-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
    <title>Year and Semester Form</title>
</head>
<body>
    <div class="form-container">
        <h2>Cat Marks</h2>
        <form action="#" method="post">
            <label for="year">Year:</label>
            <input type="text" id="year" name="year" placeholder="Enter the year" required>

            <label for="semester">Semester Period:</label>
            <input type="text" id="semester" name="semester" placeholder="Enter the semester eg:3.1" required>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>