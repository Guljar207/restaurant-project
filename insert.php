
<?php
include 'config.php';

if(isset($_POST['submit']))
{
 
    $name=$_POST['name'];
    $price=$_POST['price'];
    $target = 'uploadsimage/'.basename($_FILES['image']['name']);
  
    $sql = "INSERT INTO tblcurd (name,price,image)VALUES('$name','$price','$target')";
  
    if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
    echo "Image uploaded successfully";
    }else{
    echo "Failed to upload image";
    }
    
    
    if (mysqli_query($con, $sql)) {

    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
  }

  $sql = "SELECT * FROM tblcurd";
  $result = mysqli_query($con, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' bgcolor='green' align='center' width='60%'>";
    echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Image</th><th>Action</th></br>
    </tr>";

    while($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>".$row['id']."</td>";
      echo "<td>".$row['name']."</td>";
      echo "<td>".$row['price']."</td>";
       echo "<td><img src='http://localhost/php/restaurants/$row[image]' height='100px' width='100px'></td>";
      //echo "<td><a href='updatestudent.php?id=$row[id]'>Edit</a></td>";
      //echo "<td><a href='delete.php?id=$row[id]'>Delete</a></td>";
  
    
  
   echo "</tr>";
   
    
    }
    echo "</table>";
  } else {
    echo "0 results";
  }
  
  mysqli_close($conn);
  ?>
  





  
  

    