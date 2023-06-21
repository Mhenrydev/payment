<!-- Form , method post with input for credit card number enter -->
<form action="" method="post">
    <fieldset>
        <legend>Payment</legend>
        <div>
            <label for="$argc" name="label">CB</label><br>
            <input type="text" name="$argc" placeholder="Numero de carte">
        </div>
    </fieldset>
    <button type="submit" name="submit">Valider</button>
</form>

<?php

/**
 * if length of credit card number < 2  $error = die("message")
 * else $argv = array()
 * $argv[1] = $argc (get user input)
 * Call the CréditCardPayment class make a new payment with doPayment function

 * @param string $error -> message error if length of credit card number < 2
 * @param mixed  $argc  -> get user input
 * @param int    $argcLength -> length of credit card number
 * @param string $request "OK" or "KO"
 * 
 */


define('ROOT_DIR', __DIR__);
require_once ROOT_DIR . '/vendor/autoload.php';

$error = "";
$argc = isset($_POST['$argc']) ? $_POST['$argc'] : '';
$argcLength = strlen($argc);

if ($argcLength < 2) {
    $error = die("Please give us your credit card number !\n");
} else {
    $argv = array();
    $argv[1] = $argc;
    $controller = new \Etoxic\Test\Controller\MainController();
    $controller->run($argv[1]);
}
