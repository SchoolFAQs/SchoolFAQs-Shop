<?php

namespace App\Http\Controllers\admin;

use Bmatovu\MtnMomo\Products\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinancesController extends Controller
{
    //
    public function getbalance() {
		$collection = new Collection();
		$accountbalance = $collection->getAccountBalance();
		$amount = $accountbalance['availableBalance'];
		return view('admin.superadmin.finance.accountbalance', compact('amount'));
    }
}
