<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'qr_token' => Str::random(32), // Unique token for QR code
        ]);

        // Generate QR code with the qr_token
        $qrCode = QrCode::size(200)->generate($customer->qr_token);

        return view('customers.qr', compact('customer', 'qrCode'));
    }
}
