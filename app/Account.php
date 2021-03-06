<?php



class Account {

    /**
     * balance
     * 
     * @var float
     */
    protected $_balance = 0;

    /**
     * get the balance
     * 
     * @return float
     */
    public function getBalance() {
        return $this->_balance;
    }

    /**
     * Set balance
     * 
     * @param float $balance 
     */
    public function setBalance($balance) {
        $this->_balance = (float) $balance;
    }

    /**
     * Take money on the account
     * 
     * @param float $amount
     * @return Account
     * @throws \Exception
     */
    public function takeMoney($amount) {
        if ($this->getBalance() - $amount <= 0) {
            throw new \Exception("Overdrafts are not allowed");
        }
        $this->_balance -= $amount;
        return $this;
    }

    /**
     * Add money to the account
     * 
     * @param float $amount
     * @return Account
     */
    public function addMoney($amount) {
        $this->_balance += $amount;
    }

}