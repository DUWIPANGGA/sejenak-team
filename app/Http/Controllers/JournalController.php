<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\User;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('journals.index', compact('journals'));
    }

    public function create()
    {
        $users = User::all();
        return view('journals.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Journal::create($validated);
        return redirect()->route('journals.index')->with('success', 'Journal created successfully.');
    }

    public function show(Journal $journal)
    {
        $journal->load('user');
        return view('journals.show', compact('journal'));
    }

    public function edit(Journal $journal)
    {
        $users = User::all();
        return view('journals.edit', compact('journal', 'users'));
    }

    public function update(Request $request, Journal $journal)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $journal->update($validated);
        return redirect()->route('journals.index')->with('success', 'Journal updated successfully.');
    }

    public function destroy(Journal $journal)
    {
        $journal->delete();
        return redirect()->route('journals.index')->with('success', 'Journal deleted successfully.');
    }

    public function userJournals(User $user)
    {
        $journals = $user->journals()->orderBy('created_at', 'desc')->paginate(10);
        return view('journals.user-journals', compact('user', 'journals'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $journals = Journal::with('user')
            ->where('title', 'like', "%{$search}%")
            ->orWhere('content', 'like', "%{$search}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('journals.index', compact('journals', 'search'));
    }
}