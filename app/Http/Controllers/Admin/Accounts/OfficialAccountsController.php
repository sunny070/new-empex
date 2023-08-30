<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfficialAccountsController extends Controller
{
  public function getOfficialAccounts()
  {
    if (auth()->guard('admin')->user()->role_id != 1) {
      abort(401);
    }

    return view('admin.accounts.officialAccount');
  }
}
