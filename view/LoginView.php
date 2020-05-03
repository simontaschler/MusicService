<form role="form" action="../index.php/login" method="POST">
    <p><input type="text" name="username" id="username" placeholder="Username"></p>
    <p><input type="password" name="password" id="password" placeholder="Password"></p>
    <p><input type="submit" name="confirm" class="button" value="Login" /></p>

    <?php if ($failed) : ?>

        <p><label>Login failed.</label></p>

    <?php endif; ?>

</form>