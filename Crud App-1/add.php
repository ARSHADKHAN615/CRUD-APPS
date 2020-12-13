<?php include 'header.php'; ?>
<div id="main-content">
    <h2>Add New Record</h2>
    <form class="post-form" action="saveData.php" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="sName" />
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="sAddress" />
        </div>
        <div class="form-group">
            <label>Class</label>
            <select name="class">
                <option value="" selected disabled>Select Class</option>
                <?php
                require "connection.php";
                $sql = "SELECT * FROM studentClass";
                $result = mysqli_query($connection, $sql) or die("unsuccessful");
                while ($courses = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $courses['cid'] . "'>" . $courses['cname'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="sPhone" />
        </div>
        <input class="submit" type="submit" value="Save" />
    </form>
</div>
</div>
</body>

</html>