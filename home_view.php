<?php 
    include ('view/header.php'); 
?>
<div id="main">
    <form action="." method="post" id="login_form">
        <input type="hidden" name="action" value="login">

        <label>Username:</label>
        <input type="text" name="username"
               value="<?php echo htmlspecialchars($username); ?>" size="30">
        <br />

        <label>Password:</label>
        <input type="password" name="password"
               value="<?php echo htmlspecialchars($password); ?>" size="30">
        <br />

        <input type="submit" value="Login">
        <?php if (!empty($error_message)) : ?>         
        <span class="error"><?php echo htmlspecialchars($error_message); ?></span><br>
        <?php endif; ?>
    </form>
    <a href="?action=show_register_form">Create an account</a>
</div>
<?php include ('view/footer.php'); ?>