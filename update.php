<?php
//include 'config.php'
$con = mysqli_connect("localhost","root","","carddb");


$id = $_GET['id'];

$sql = "SELECT * FROM tblcurd WHERE id='$id' ";
$b1=mysqli_query($con,$sql);
    $data=mysqli_fetch_array($b1);
   $firstname=$data['name'];
   $lastname=$data['price'];
   $image = $data['image'];
   //echo "<td><img src='http://localhost/php/studentproject/$row[image_path]' height='100px' width='100px'></td>";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Background Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    
    <div class="form-container">
    <form action="" method="post" enctype="multipart/form-data">
        
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $firstname;?>"required></td>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo $lastname;?>"required></td><br>
            <lable for="">Image</lable>
            <input type="file" name="image" ><br>
            <img src="http://localhost/php/restaurants/<?php echo $image;?>"alt="" height="100px" width="100px"></td>

            <input type="submit" name="submit" value="submit">
        
    </div>

</form>

    <?php
   // include 'config.php';
    

if(isset($_POST['submit']))
{

    $firstname=$_POST['name'];
    $lastname=$_POST['price'];
    

    $image = $_FILES['image']['name'];
    $target = "uploadsimage/".basename($image);
  


    $con=mysqli_connect("localhost","root","","carddb");
    if($con)
    {
        $q="UPDATE tblcurd SET name='$firstname', price='$lastname',image='$target' WHERE id='$id'";
        
        if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
        echo "Image uploaded successfully";
        }else{
        echo "Failed to upload image";
        }

        $b1=mysqli_query($con,$q);
        if($b1)
        {
            header("location:index.php");
        }
        else
        {
            echo mysqli_error($con);
        }
    }
    else
    {
            echo "not updated";
    }

}
?>
</body>
</html>



