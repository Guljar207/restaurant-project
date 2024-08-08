<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <center>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Background Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="form-container">
    
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
  
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required><br>
            <lable for="">Image</lable>
            <input type="file" name="image" ><br>
            <input type="submit" name="submit" value="Upload">

        </form> 

        
        </div>
</center>


<?php
   include 'config.php';
   $sql = "SELECT * FROM tblcurd";
  $result = mysqli_query($con, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' bgcolor='grey' align='center' width='45%'>";
    echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Image</th><th>Action</th>
    </tr></br>";

    while($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>".$row['id']."</td>";
      echo "<td>".$row['name']."</td>";
      echo "<td>".$row['price']."</td>";
       echo "<td><img src='http://localhost/php/restaurants/$row[image]' height='100px' width='100px'></td>";
      echo "<td><a href='update.php?id=$row[id]'>Edit</a></td>";
      echo "<td><a href='delete.php?id=$row[id]'>Delete</a></td>";
      ?>

  <td>      
    <!-- for downloading image button -->
     
    <form action="download.php" method="post"
      style="">
      <input type="hidden" name="path"value="<?php echo $row['image']; ?>">
      <input type="submit" name="download"value="Download">
    </td>

</form>
      <?php
    
  
    
  
   echo "</tr>";
   
    
    }
    echo "</table>";
  } else {
    echo "0 results";
  }
  
  mysqli_close($con);

  ?>
  
  </body>
  </html>
