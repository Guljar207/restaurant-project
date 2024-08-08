<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "carddb";

// Create connection
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
  // Escape user inputs for security
  $fn = mysqli_real_escape_string($conn, $_POST['name']);
  $ln = mysqli_real_escape_string($conn, $_POST['price']);
  
  // Handling file upload
  $target_dir = 'uploads/';
  $target_file = $target_dir . basename($_FILES['image']['name']);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Check if image file is an actual image or fake image
  $check = getimagesize($_FILES['image']['tmp_name']);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES['image']['size'] > 500000) { // Limit to 500KB
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
      $sql = "INSERT INTO tblcurd (name, price, image) VALUES ('$fn', '$ln', '$target_file')";
      
      if (mysqli_query($conn, $sql)) {
        echo "The file ". basename($_FILES['image']['name']). " has been uploaded and record created successfully.";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}

mysqli_close($conn);
?>


