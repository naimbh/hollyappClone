<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Note;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        if (auth()->check()) {
            if (!auth()->user()->is_admin) {
                return redirect(url('/'));
            }
        }
    }

    public function index()
    {
        $users = User::get();
        $notes = Note::get();
        return view('backend.dashboard', compact('users', 'notes'));
    }

    public function users()
    {
        $users = User::where('is_admin', false)->latest()->get();
        return view('backend.users', compact('users'));
    }

    public function notes()
    {
        $notes = Note::latest()->get();
        return view('backend.notes', compact('notes'));
    }

    public function subscribeToggle(User $user)
    {
        if ($user->is_paid) {
            $user->update([
                'is_paid' => false,
                'subscriptionId' => null,
            ]);
        } else {
            $user->update([
                'is_paid' => true,
                'subscriptionId' => 'Manual',

            ]);
        }

        return back();
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back();
    }

    public function deleteNote(Note $note)
    {
        $note->delete();
        return back();
    }
}
