<section>
    <div>
        <h2>Assessments</h2>
        <table>
            <thead>
                <th>ID</th>
                <th>Course</th>
                <th>Type</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </thead>
            <tbody>
                <?php
                require 'data/database.php';
                    $selectQuery = "SELECT * FROM assessments";
                    $query = mysqli_query($connection, $selectQuery);
                     
                    // Replace with getAssessments function
                    while (($result = mysqli_fetch_assoc($query))) {
                ?>
                <tr>
                  <td><?php echo $result['id']; ?></td>
                  <td><?php echo $result['course']; ?></td>
                  <td><?php echo $result['type']; ?></td>
                  <td><?php echo $result['date']; ?></td>
                  <td><?php echo $result['time']; ?></td>
                  <td><?php echo $result['status']; ?></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>               
    </div>
</section>