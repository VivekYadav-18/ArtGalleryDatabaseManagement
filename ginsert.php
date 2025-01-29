<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['G_ID']) && isset($_POST['GNAME']) && isset($_POST['LOCATION'])) {
        $gid = $_POST['G_ID'];
        $gname = $_POST['GNAME'];
        $location = $_POST['LOCATION'];

        // Establishing a connection to the database
        $link = new mysqli('localhost', 'root', '', 'art_gallery');

        // Check if connection is successful
        if ($link->connect_error) {
            die('Connection error: ' . $link->connect_error);
        }

        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO GALLERY (gid, gname, location) VALUES (?, ?, ?)";

        // Prepare the SQL statement
        if ($stmt = $link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $gid, $gname, $location);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                echo 'Successfully Inserted into GALLERY table.';
            } else {
                echo 'Unable to post.';
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error: " . $link->error;
        }

        // Close the connection
        $link->close();
        die();
    } else {
        echo "Invalid request.";
    }
}
?>
