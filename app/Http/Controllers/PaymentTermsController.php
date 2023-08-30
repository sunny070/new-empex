<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentTermsController extends Controller
{
    public function index()
    {
        return view('web.payment-terms');
    }
}
