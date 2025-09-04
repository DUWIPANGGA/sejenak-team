<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $users = User::all();
        return view('transactions.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|integer',
            'type' => 'required|in:topup,usage',
            'description' => 'nullable|string',
        ]);

        Transaction::create($validated);

        // Update user's token balance
        $user = User::find($validated['user_id']);
        if ($validated['type'] === 'topup') {
            $user->increment('tokens_balance', $validated['amount']);
        } else {
            $user->decrement('tokens_balance', $validated['amount']);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('user');
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $users = User::all();
        return view('transactions.edit', compact('transaction', 'users'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|integer',
            'type' => 'required|in:topup,usage',
            'description' => 'nullable|string',
        ]);

        // Revert previous transaction effect
        $oldUser = User::find($transaction->user_id);
        if ($transaction->type === 'topup') {
            $oldUser->decrement('tokens_balance', $transaction->amount);
        } else {
            $oldUser->increment('tokens_balance', $transaction->amount);
        }

        $transaction->update($validated);

        // Apply new transaction effect
        $user = User::find($validated['user_id']);
        if ($validated['type'] === 'topup') {
            $user->increment('tokens_balance', $validated['amount']);
        } else {
            $user->decrement('tokens_balance', $validated['amount']);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        // Revert transaction effect before deletion
        $user = User::find($transaction->user_id);
        if ($transaction->type === 'topup') {
            $user->decrement('tokens_balance', $transaction->amount);
        } else {
            $user->increment('tokens_balance', $transaction->amount);
        }

        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}