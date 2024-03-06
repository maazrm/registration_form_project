<?php 
include("partials/connection.php");


// display num of rows
$query = "SELECT * FROM `logininfo`";
$data = mysqli_query($conn, $query);

$total = mysqli_num_rows($data);

echo "Total rows: " .$total . "<br>";



if($total != 0)
{
    ?>
    <table border ="3">
        <tr>
            <th>Sno</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Joining time</th>
        </tr>
    
    <?php
    while($result = mysqli_fetch_assoc($data)){
        echo "<tr>
            <td>".$result["sno"]."</td>
            <td>".$result["firstName"]."</td>
            <td>".$result["lastName"]."</td>
            <td>".$result["email"]."</td>
            <td>".$result["dt"]."</td>
        </tr>";
    }
} else {
    echo "No records found!";
}
?>
</table>