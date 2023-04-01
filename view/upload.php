<section>
    <div>
        <h2>Upload Assessments Page</h2>
        <span>Please Upload a New Assessment File</span><br>
        <span>CSV file must be in the following format:</span><br>
        <span>id,course_name,assessment_name,date,time,status [Completed/Current]</span><br>

        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="file" required>
            <button type="submit" name="upload">Upload</button>
        </form>

        <?php 
            if (isset($_GET['option'])) {
                if ($_GET['option'] == 'error') {
                    echo '<span>There was an error uploading your file.</span>';
                }
            }
        ?>
 
    </div>
</section>