// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey("sk_test_Led4hbTuuxDK5DDDX8ZpXw4T");

\Stripe\Payout::create([
    "amount" => 1000,
    "currency" => "eur",
], ["stripe_account" => CONNECTED_STRIPE_ACCOUNT_ID]);
