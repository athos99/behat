Feature: Manage a bank account
  In order to manage my account
  As a logged in user
  I need to be able to add or take money on my account

  Background:
    And I am logged in as "jeanfrancois"
    And I have "50" euro
    And I am on "/"

  Scenario: Check my bank account
    Then I should see "You have 50 euro on your account"

  Scenario Outline: Add money
    Given I have "<initialAmount>" euro
    When I select "<operation>" from "Operation"
    And I fill in "Amount" with "<amount>"
    And I press "Go"
    Then I should see "You have <finalAmount> euro on your account"

  Examples:
  | operation   | initialAmount | amount    | finalAmount   |
  | Add money   | 50            | 10        | 60            |
  | Add money   | 50            | 20        | 70            |
  | Add money   | 50            | 5         | 55            |
  | Add money   | 50            | 0         | 50            |
  | Take money  | 50            | 10        | 40            |
  | Take money  | 50            | 20        | 30            |
  | Take money  | 50            | 30        | 20            |

  Scenario: Overdrafts are not allowed
    Given I have "50" euro
    When I select "Take money" from "Operation"
    And I fill in "Amount" with "60"
    And I press "Go"
    Then I should see "You have 50 euro on your account"
    And I should see "Overdrafts are not allowed"