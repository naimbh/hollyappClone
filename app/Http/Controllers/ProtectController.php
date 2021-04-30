<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

class ProtectController extends Controller
{
    //prot4ect tree by pass
    public function create($slug)
    {
        $note = Note::where('slug', $slug)->first();

        return view('frontend.protect', compact('note'));
    }

    //prot4ect tree by pass
    public function protect(Request $request, $slug)
    {
        $data = $request->validate([
            'password' => 'required|string',
        ]);

        $note = Note::where('slug', $slug)->first();

        if ($note->user_id == auth()->user()->id) {
            $note->update([
                'is_protected' => true,
                'password' => $data['password'],
            ]);
        }

        return back();
    }

    public function unprotect($slug)
    {
        $note = Note::where('slug', $slug)->first();

        if ($note->user_id == auth()->user()->id) {
            $note->update([
                'is_protected' => false,
                'password' => null,
            ]);
        }
        return back();
    }

    public function protectCheck(Request $request, $slug)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $note = Note::where('slug', $slug)->first();
        $pass = $request->password;

        if ($note->password == $pass){
            return view('frontend.new', compact('note'));
        }

        return redirect()->back()->with('password-error', 'Sorry! Password did not match.');
    }
}
