<?php
    if (!defined('TITLE')) exit();
    mysqli_close($dbc);
    unset($dbc);
?>
    <p>Copyright &copy; <? echo date("Y"); ?> Forums. All rights reserved.</p>
    </body>
</html>