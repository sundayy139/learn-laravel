<?php

namespace App\Config;

class Shopify {

  public function toArray() {
    return [
      'ShopUrl' => env('SHOPIFY_SHOP_URL'),
      'AccessToken' => env('SHOPIFY_ACCESS_TOKEN'),
      'ApiVersion' => env('SHOPIFY_API_VERSION'),
    ];
  }
}