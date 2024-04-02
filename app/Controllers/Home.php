<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        //$this->view('fragments/header');
        //$this->view('welcome_message');
        return view('welcome_message');
    }

    public function voucher()
    {
        
        return view('voucher');
    }

    public function voucherLookup(string $id)
    {

        return view('voucher');

    }



}
