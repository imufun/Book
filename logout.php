<?php
session_start();
if (! empty($_SESSION['logged_in']))
{
    ?>

    <p>here is my super-secret content</p>
    <a href='logout.php'>Click here to log out</a>

    <?php
}
else
{
    echo 'You are not logged in. <a href="login.php">Click here</a> to log in.';
}