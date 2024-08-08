<?php
$i=$_GET['id'];
$con=mysqli_connect("localhost","root","","carddb");

if($con)
{
    $q="delete from tblcurd where id=$i";
    $query=mysqli_query($con,$q);
    if($query)
    {
        

        header('location:index.php');


    }
    else
    {
        echo "could not data deleted";

    }
}
else{
    die("not connect".mysqli_connect_error());
}
mysqli_close($con);
?>
