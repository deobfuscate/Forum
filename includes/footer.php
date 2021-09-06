<?php
    if (!defined('TITLE')) exit();
    mysqli_close($dbc);
    unset($dbc);
?>
    <p>Copyright &copy; <? echo date("Y") . " " . $forum_name; ?>. All rights reserved.</p>
    </body>
</html>