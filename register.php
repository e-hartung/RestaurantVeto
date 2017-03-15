<?php include('view/header.php'); ?>
<div id="main">
    <h5>Create an Account</h5>
    <form action="." method="post" id="register_form">
        <input type="hidden" name="action" value="create_user">

        <label>Username:</label>
        <input type="text" name="username"
               value="<?php echo htmlspecialchars($username); ?>" size="30">
        <br />

        <label>Password:</label>
        <input type="text" name="password"
               value="<?php echo htmlspecialchars($password); ?>" size="30">
        <br />

        <input type="submit" value="Create">
        <?php if (!empty($error_message)) : ?>         
        <span class="error"><?php echo htmlspecialchars($error_message); ?></span><br>
        <?php endif; ?>
    </form>
</div>
<?php include('view/footer.php'); ?>