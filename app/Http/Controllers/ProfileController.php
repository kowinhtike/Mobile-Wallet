<?php

namespace App\Http\Controllers;

use App\Services\WalletService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //

    protected $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function createProfile(Request $request){
        $profile = $this->walletService->createProfile($request);
        return response()->json($profile);
    }

    public function getProfile(Request $request){
        $profile = $this->walletService->getProfile($request);
        return response()->json($profile);
    }

    public function createTransaction(Request $request){
        $transaction = $this->walletService->createTransaction($request);
        return response()->json($transaction);
    }

    public function getTransactions(Request $request){
        $transactions = $this->walletService->getTransactions($request);
        return response()->json($transactions);
    }

    public function setPin(Request $request){
        $profile = $this->walletService->setPin($request);
        return response()->json($profile);
    }

    public function setPhoto(Request $request){
        $profile = $this->walletService->setPhoto($request);
        return response()->json($profile);
    }



}
