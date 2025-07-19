<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;

class ContractController extends Controller
{
    public function uploadDocument(Request $request, $id)
    {
        $request->validate([
            'contract_document' => 'required|file|mimes:pdf|max:5120', // Max 5MB
        ]);

        $contract = Contract::findOrFail($id);

        $path = $request->file('contract_document')->store('contracts', 'public');

        $contract->contract_document = $path;
        $contract->status = 'approved'; // or leave it unchanged
        $contract->save();

        return back()->with('success', 'Contract uploaded successfully!');
    }
}
