<?php


namespace Etoxic\Test\Service\Payment;

use Etoxic\Test\Service\Conf\Conf;

/**
 * Class CreditCardPayment implements doPayment() method
 *
 * Get Conf and if Conf === "test", make rand(1, 2) for a random payment
 * If the result of rand is 1, $reponse = OK, else $ reponse = KO 
 * 
 * Elseif conf === "real"
 * curl_init() -> Init session cURL
 * CURLOPT_URL -> The URL to fetch. This can also be set when initializing a session with curl_init().
 * CURLOPT_POSTFIELDS -> Passed as a urlencoded string (parameter, value)
 * CURLOPT_RETURNTRANSFER -> true to return the transfer as a string of the return value of curl_exec()
 * curl_close() -> close curl session
 * 
 * @param string $creditCarNumber
 * @param string $cardNumber
 * @param string $conf
 * @param string|bool $reponse
 * @return string "Payment success !" ou "Payment failure !"
 * 
 */

class CreditCardPayment implements Payment
{
    //
    private $cardNumber;

    public function __construct($creditCardNumber)
    {
        $this->cardNumber = $creditCardNumber;
    }

    public function doPayment()
    {
        $reponse = '';

        $conf = Conf::getConf();
        if ($conf["env"] === "test") {
            rand(1, 2);
            if (rand(1, 2) == 1) {
                $reponse = 'OK';
            } else {
                $reponse = 'KO';
            }
        } elseif ($conf["env"] == "real") {
            // Création d'une ressource cURL
            $handleCurl = curl_init();

            curl_setopt($handleCurl, CURLOPT_URL, "https://e-toxic.fr/test-payment.php");
            curl_setopt($handleCurl, CURLOPT_POSTFIELDS, "credit-card-number=" . $this->cardNumber);
            curl_setopt($handleCurl, CURLOPT_RETURNTRANSFER, true);

            // Récupération de l'URL et affichage sur le navigateur
            $reponse = curl_exec($handleCurl);

            if (curl_errno($handleCurl)) {
                echo 'Erreur Curl : ' . curl_error($handleCurl);
            }

            curl_close($handleCurl);
        }
        return $reponse;
    }
}
