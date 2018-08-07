# Instant-RoundUp-To-Goal
Instantly Rounds Up the transaction and transfers it into a Starling Bank Savings Goal.

Simply configure your Starling Bank Personal Access Token (with the transaction:read, savings-goal-transfer:create scopes), the ID of the Savings Goal you'd like the RoundUp to go into and an email address to send notification to:

// Starling Personal Access Token
$starlingPAT = "";

// RoundUps Savings Goal UID
$savingsGoalUID = "";

// Email Address
$emailAddress = "";

You then need to setup a Personal Access Webhook on your account at https://developer.starlingbank.com with the Webhook Types: Mobile Wallet and Card.
