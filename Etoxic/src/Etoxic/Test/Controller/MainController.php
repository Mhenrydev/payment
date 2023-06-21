<?php

namespace Etoxic\Test\Controller;

use Etoxic\Test\Service\Payment\CreditCardPayment;

/**
 * function run() -> Call the CréditCardPayment class
 * make a new payment with doPayment function

 * @param array $creditCarNumber
 * @param string $request "OK" or "KO"
 * 
 */

class MainController
{
    public function run($creditCardNumber)
    {
        $newPayment = new CreditCardPayment($creditCardNumber);
        $request = $newPayment->doPayment();
        if ($request == "OK") {
            echo "Payment success !";
        } elseif ($request == "KO") {
            echo "Payment failure !";
        } else {
            echo $request;
        }
    }
}
