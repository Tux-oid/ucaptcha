<?php
/**
 * This is example of using UCaptcha library in your project
 * @author Tux-oid
 */
use RL\Ucaptcha\Ucaptcha;

$uCaptcha = new UCaptcha;
session_start();
if (isset($_POST['keystring'])) {
    $val = $uCaptcha->check($_POST['keystring']);
    if ($val) {
        echo 'Yes';
    } else {
        echo 'No';
    }
    exit;
} else {
    echo '<html><body><form name="frm" method="post">
	<img src="' . $uCaptcha->draw(1) . '"></img>
	<br>
	<input type="text" name="keystring">
	<br>
	<input type="submit" name="sbm">
	</form></body></html>';
}


