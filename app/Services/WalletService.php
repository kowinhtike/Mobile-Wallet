<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\Transaction;
use Illuminate\Support\Facades\Storage;

class WalletService
{
    public function createProfile($request)
    {
        $profile = new Profile();
        $profile->user_id = $request->user()->id;
        $profile->ph = $request->ph;
        $profile->save();
        return $profile;
    }

    public function getProfile($request)
    {
        return $request->user()->profile;
    }

    public function createTransaction($request)
    {
        $secondProfile = Profile::where('ph', $request->ph)->get()->first();
        if (!isset($secondProfile->id)) {
            return "Account not found";
        }
        $amount = $request->amount;
        $firstProfile = $request->user()->profile;
        if ($firstProfile->balance < $amount) {
            return "Insufficient balance";
        }
        $firstProfile->balance -= $amount;
        $firstProfile->save();
        $secondProfile->balance += $amount;
        $secondProfile->save();
        $transaction = new Transaction();
        $transaction->note = $request->note;
        $transaction->amount = $amount;
        $transaction->profile1_id = $firstProfile->id;
        $transaction->profile2_id = $secondProfile->id;
        $transaction->save();
        return $transaction;
    }

    public function getTransactions($request)
    {
        $userId = $request->user()->id;
        return Transaction::where('profile1_id', $userId)->orWhere('profile2_id', $userId)->get();
    }

    public function setPin($request)
    {
        $profile = $request->user()->profile;
        $profile->pin = $request->pin;
        $profile->save();
        return $profile;
    }

    public function setPhoto($request){
        $profile = $request->user()->profile;
        if(isset($profile->photo)){
            Storage::delete("public/images/" . $profile->photo);
        }
        $imagefile = $request->file('photo');
        $getImageName = $imagefile->hashName();
        $profile->photo = $getImageName;
        Storage::putFileAs('public/images', $imagefile, $getImageName);
        $profile->save();
        return $profile;
    }
}
