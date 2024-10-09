<?php
              $servername = "localhost";
              $username = "root";
              $password = "";
              $dbname = "Vintex_db";

              $conn = new mysqli($servername, $username, $password, $dbname);

              // Check connection
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                  echo "failed to connect to the databse";
              }
?>