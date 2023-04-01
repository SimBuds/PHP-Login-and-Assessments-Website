<section>
    <div>
        <h2>Login</h2>
        <form method="POST">
            <label>Enter your username:</label>
            <input type="text" name="username" required>
            <label>Enter your password:</label>
            <input type="password" name="userPassword" required>
            <button type="submit" name="login">Login</button>
        </form>
        <?php 
            if(isset($_GET['option'])) {
                if($_GET['option'] == 'error') {
                    echo '<span>There was an error logging in.</span>';
                }
            }
        ?>
    </div>    
</section>