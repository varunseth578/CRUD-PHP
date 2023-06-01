<?php
// Database connection details
$host = 'localhost';
$username = 'roott';
$password = 'root';
$database = 'database2';


// Create a connection
$conn = mysqli_connect($host, $username, $password, $database);


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Create a new record
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    
    $sql = "INSERT INTO test (name, email) VALUES ('$name', '$email')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully.";}
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
}


// Update a record
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];


    $sql = "UPDATE test SET name='$name', email='$email' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully.";}
        else {
            echo "Error updating record: " . mysqli_error($conn);
        }
}


// Delete a record
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];


    $sql = "DELETE FROM test WHERE id='$id'";


    if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully.";}
    else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}


// Retrieve all records
$sql = "SELECT * FROM test";
$result = mysqli_query($conn, $sql);


?>


<!DOCTYPE html>
<html>
<head>
    <title>Simple CRUD</title>
</head>
<body>
<h2>Create a new user</h2>
<form method="post" action="">
<input type="text" name="name" placeholder="Name" required>
<input type="email" name="email" placeholder="Email" required>
<button type="submit" name="submit">Create</button>
</form>


<h2>Users List</h2>
<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Action</th>
</tr>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td>
<a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
<a href="?delete=<?php echo $row['id']; ?>">Delete</a>
</td>
</tr>
<?php } ?>
</table>
</body>
</html>


<?php
// Close the database connection
mysqli_close($conn);
?>
