<?php
include 'header.php';
?>
<div id="main-content">
    <h2>All Records</h2>
    <?php
    require "connection.php";
    $sql = "SELECT * FROM students INNER JOIN studentClass  ON students.sclass=studentClass.cid ORDER BY students.sid";
    $result = mysqli_query($connection, $sql) or die("unsuccessful");
    if (mysqli_num_rows($result) > 0) {

    ?>
        <table cellpadding="7px">
            <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Address</th>
                <th>Class</th>
                <th>Phone</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo   "<tr>
            <td>" . $row['sid'] . "</td>
            <td>" . $row['sname'] . "</td>
            <td>" . $row['saddress'] . "</</td>
            <td>" . $row['cname'] . "</td>
            <td>" . $row['sphone'] . "</</td>
            <td>
            <a href='edit.php?id=" . $row['sid'] . "'>Edit</a>
            <a href='delete-inline.php?id=" . $row['sid'] . "'>Delete</a>
            </td>
            </tr>";
                }
                ?>
            </tbody>
        </table>

    <?php } else {
        $sql = "ALTER TABLE students AUTO_INCREMENT=1";
        $result = mysqli_query($connection, $sql) or die("unsuccessful");
        echo "<h1>Record Not found</h1>";
    }
    mysqli_close($connection);
    ?>
</div>
</div>
</body>

</html>