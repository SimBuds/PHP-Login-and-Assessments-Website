<section>
    <div>
        <h2>Register</h2>
        <form method="POST">
            <label>Enter your username:</label>
            <input type="text" name="username" required>
            <label>Enter your email:</label>
            <input type="email" name="userEmail" required>
            <label>Enter password:</label>
            <input type="password" name="userPassword" required>
            <button type="submit" name="signup">Signup</button>
        </form>

        <?php 
            if (isset($_GET['option'])) {
                if ($_GET['option'] == 'error') {
                    echo '<span>There was an error registering your account.</span>';
                }
            }
        ?>
    </div>
</section>