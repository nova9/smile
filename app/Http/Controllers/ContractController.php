<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;

class ContractController extends Controller
{
    // Upload a document and auto-approve
    public function uploadDocument(Request $request, $id)
    {
        $request->validate([
            'contract_document' => 'required|file|mimes:pdf|max:5120', // Max 5MB
        ]);

        $contract = Contract::findOrFail($id);

        $path = $request->file('contract_document')->store('contracts', 'public');

        $contract->contract_document = $path;
        $contract->status = 'approved';
        $contract->save();

        return back()->with('success', 'Contract uploaded successfully!');
    }

    // Manually approve contract
    public function approveContract($id)
    {
        $contract = Contract::findOrFail($id);

        if ($contract->status === 'pending') {
            $contract->status = 'approved';
            $contract->save();

            return back()->with('success', 'Contract approved successfully!');
        }

        return back()->with('error', 'Contract is already approved.');
    }
}
