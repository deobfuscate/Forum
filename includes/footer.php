<?php
    if (!defined('TITLE'))
        exit();
    mysqli_close($dbc);
    unset($dbc);
    $year = date("Y");
?>
        <br>
        <p>Copyright &copy; <?="{$year} {$forum_name}"?>. All rights reserved.</p>
    </body>
</html>