<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';
require_once __DIR__ . '/../../../../application/library/Account.php';

use \MyApp\Account as Account;

/**
 * Features context.
 */
class FeatureContext extends BehatContext {

    /**
     * Testes account
     * 
     * @var \MyApp\Account
     */
    private $_account;
    
    /**
     * Contains the last exception
     * 
     * @var \Exception
     */
    private $_lastException;

    /**
     * @Given /^que je suis un nouveau client$/
     */
    public function queJeSuisUnNouveauClient() {
        $this->_account = new Account;
    }

    /**
     * @Then /^je dois avoir "([^"]*)" euros sur mon compte$/
     */
    public function jeDoisAvoirEurosSurMonCompte($balance) {
        assertEquals($balance, $this->_account->getBalance());
    }

    /**
     * @Given /^que je suis un client$/
     */
    public function queJeSuisUnClient() {
        if(is_null($this->_account)) {
            $this->_account = new Account;
        }
    }

    /**
     * @Given /^que je possède "([^"]*)" euros sur mon compte$/
     */
    public function queJePossedeEurosSurMonCompte($balance) {
        $this->_account->setBalance($balance);
    }

    /**
     * @Given /^je retire "([^"]*)" euros$/
     */
    public function jeRetireEuros($amount) {
        $this->_account->takeMoney($amount);
    }

    /**
     * @Given /^je dépose "([^"]*)" euros$/
     */
    public function jeDeposeEuros($amount) {
        $this->_account->addMoney($amount);
    }

    /**
     * @Given /^j\'essaye de retirer plus d argent que je n en ai sur mon compte$/
     */
    public function jEssayeDeRetirerPlusDArgentQueJeNEnAiSurMonCompte() {
        try {
            $this->_account->setBalance(50);
        $this->_account->takeMoney(100);
        } catch (\Exception $e) {
            $this->_lastException = $e;
        }
    }

    /**
     * @Given /^j\'ai un message d erreur "([^"]*)"$/
     */
    public function jAiUnMessageDErreur($message) {
        assertEquals($message, $this->_lastException->getMessage());
    }

}
