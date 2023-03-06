<?php

namespace App\Services;

use Stripe\Stripe;

class StripeServices
{
  public function PaiementStripe($success, $cancel, $items)
  {

    $lineItems = [];
    foreach ($items as $item) {

      $lineItems[] =
        [
          'price_data' => [
            'currency' => 'eur',
            'unit_amount' => $item['product']->getPrice() * 100,
            'product_data' => [
              'name' => $item['product']->getTitle(),
              'images' => [
                "http://127.0.0.1:8000/img/product/" . $item['product']->getPictures()->getValues()[0]->getImageName(),
              ],
            ],
          ],
          'quantity' => $item['quantity'],
        ];
    }

    // $StripeSK = 'sk_test_51Mh9SbArgZcue3lGZySKqjTES99T5b20z8AdVYzetGI73EuAMSUj5OstoXCoBXyhVbIVHC4OCp0mNk1n7bVD93rF000LJR8EUK';
    $StripeSK = $_ENV['StripeSK'];
    Stripe::setApiKey($StripeSK);

    $session = \Stripe\Checkout\Session::create([
      'payment_method_types' => ['card'],
      'line_items' => [$lineItems],
      'mode' => 'payment',
      'success_url' => $success,
      'cancel_url' => $cancel,
    ]);
    return $session;
  }
}
