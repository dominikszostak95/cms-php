<?php

namespace App\Controllers;

use App\Models\Trader;
use App\Models\Company;

class PagesController
{

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function panel()
    {
        $dane = [
            'lastWeekUsers' => Trader::lastWeek(),
            'lastWeekCompanies' => Company::lastWeek()
        ];

        return view('panel', compact('dane'));
    }

}