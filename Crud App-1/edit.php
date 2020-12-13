<?php include 'header.php'; ?>

<div id="main-content">
    <h2>Update Record</h2>
    <?php

    require "connection.php";
    $stu_id = $_GET['id'];
    $sql = "SELECT * FROM students where sid=$stu_id";

    $result = mysqli_query($connection, $sql) or die("unsuccessful");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

    ?>
            <form class="post-form" action="updateData.php" method="post">
                <div class="form-group">
                    <label>Name</label>
                    <input type="hidden" name="sid" value="<?php echo $row['sid'] ?>" />
                    <input type="text" name="sname" value="<?php echo $row['sname'] ?>" />
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="saddress" value="<?php echo $row['saddress'] ?>" />
                </div>
                <div class="form-group">
                    <label>Class</label>
                    <?php
                    require "connection.php";
                    $sql1 = "SELECT * FROM studentClass";
                    $result1 = mysqli_query($connection, $sql1) or die("unsuccessful");
                    if (mysqli_num_rows($result) > 0) {
                        echo '<select name="sclass">
                      <option value="" selected disabled>Select Class</option>';

                        while ($courses = mysqli_fetch_assoc($result1)) {
                            if ($row['sclass'] == $courses['cid']) {
                                $select = "selected";
                            } else {
                                $select = "";
                            }
                            echo "<option $select value='" . $courses['cid'] . "'>" . $courses['cname'] . "</option>";
                        }
                        echo "</select>";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="sphone" value="<?php echo $row['sphone'] ?>" />
                </div>
                <input class="submit" type="submit" value="Update" />
            </form>
    <?php }
    } else {
        echo "<h1>Something Wrong</h1>";
    }
    mysqli_close($connection);
    ?>
</div>
</div>
</body>

</html>