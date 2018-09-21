<?php

namespace App\Http\Controllers\Api;

use App\Wrappers\Currencies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    public function index(Currencies $currencies)
    {
        return $currencies->get();
    }
}
