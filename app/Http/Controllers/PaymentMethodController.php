<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::latest()->paginate(10);
        return view('backEnd.admin.payment-methods.index', compact('paymentMethods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'qr_code' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'instructions' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $paymentMethod = new PaymentMethod();
        $paymentMethod->name = $request->name;
        $paymentMethod->instructions = $request->instructions;
        $paymentMethod->status = $request->status;

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = ImageHelper::uploadImage($request->file('logo'), 'uploads/payment-methods/logos');
            $paymentMethod->logo = $logoPath;
        }

        // Handle QR code upload
        if ($request->hasFile('qr_code')) {
            $qrCodePath = ImageHelper::uploadImage($request->file('qr_code'), 'uploads/payment-methods/qr-codes');
            $paymentMethod->qr_code = $qrCodePath;
        }

        $paymentMethod->save();

        return redirect()->back()->with('success', 'Payment method created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:payment_methods,id',
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'qr_code' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'instructions' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $paymentMethod = PaymentMethod::findOrFail($request->id);
        $paymentMethod->name = $request->name;
        $paymentMethod->instructions = $request->instructions;
        $paymentMethod->status = $request->status;

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($paymentMethod->logo) {
                ImageHelper::deleteImage($paymentMethod->logo);
            }

            $logoPath = ImageHelper::uploadImage($request->file('logo'), 'uploads/payment-methods/logos');
            $paymentMethod->logo = $logoPath;
        }

        // Handle QR code upload
        if ($request->hasFile('qr_code')) {
            // Delete old QR code if exists
            if ($paymentMethod->qr_code) {
                ImageHelper::deleteImage($paymentMethod->qr_code);
            }

            $qrCodePath = ImageHelper::uploadImage($request->file('qr_code'), 'uploads/payment-methods/qr-codes');
            $paymentMethod->qr_code = $qrCodePath;
        }

        $paymentMethod->save();

        return redirect()->back()->with('success', 'Payment method updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        // Delete associated files
        if ($paymentMethod->logo) {
            ImageHelper::deleteImage($paymentMethod->logo);
        }

        if ($paymentMethod->qr_code) {
            ImageHelper::deleteImage($paymentMethod->qr_code);
        }

        $paymentMethod->delete();

        return redirect()->back()->with('success', 'Payment method deleted successfully.');
    }

    /**
     * Get the specified resource for editing.
     */
    public function get($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        return response()->json([
            'id' => $paymentMethod->id,
            'name' => $paymentMethod->name,
            'logo' => $paymentMethod->logo,
            'logo_url' => $paymentMethod->logo ? asset($paymentMethod->logo) : null,
            'qr_code' => $paymentMethod->qr_code,
            'qr_code_url' => $paymentMethod->qr_code ? asset($paymentMethod->qr_code) : null,
            'instructions' => $paymentMethod->instructions,
            'status' => $paymentMethod->status,
        ]);
    }
}
