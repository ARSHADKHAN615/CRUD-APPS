<?php include 'header.php'; ?>
<div id="main-content">
    <h2>Edit Record</h2>



    <form class="post-form" action="update.php" method="post">
        <div class="form-group">
            <label>Id</label>
            <input type="text" name="sid" />
        </div>
        <input class="submit" type="submit" name="showBtn" value="Show" />
    </form>
    <?php
    require "connection.php";
    if ((isset($_POST['showBtn']))) {
        $id = $_POST['sid'];
        $sql = "SELECT * FROM students where `sid`=$id";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
    ?>
                <form class="post-form" action="updateData.php" method="post">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="hidden" name="sid" value="<?php echo $row['sid'] ?>" />
                        <input type="text" name="sname" value="<?php echo $row['sname'] ?>" />
                    </div>
                    <div class=" form-group">
                        <label>Address</label>
                        <input type="text" name="saddress" value="<?php echo $row['saddress'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Class</label>
                        <select name="sclass">
                            <option value="" selected disabled>Select Class</option>
                            <?php
                            require "connection.php";
                            $sql1 = "SELECT * FROM studentClass";
                            $result1 = mysqli_query($connection, $sql1) or die("unsuccessful");
                            if (mysqli_num_rows($result1) > 0) {
                                while ($courses = mysqli_fetch_assoc($result1)) {
                                    if ($row['sclass'] == $courses['cid']) {
                                        $select = "selected";
                                    } else {
                                        $select = "";
                                    }
                                    echo "<option $select value='" . $courses['cid'] . "'>" . $courses['cname'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="sphone" value="<?php echo $row['sphone'] ?>" />
                    </div>
                    <input class="submit" type="submit" value="Update" />
                </form>
</div>
</div>
<?php
            }
        }
    }
    mysqli_close($connection);
?>
</body>

</html>