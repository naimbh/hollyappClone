<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Mockery\Matcher\Not;

class NoteController extends Controller
{
    // trees list
    public function index(Request $request)
    {
        if (auth()->check()) {
            $notes = Note::where('user_id', auth()->user()->id)->get();

        } elseif ($request->session()->has('note.ids')) {
            $ids = session('note.ids');
            $notes = Note::find($ids);
        } else {
            //passing a empty object
            $notes = Note::where('id', 500050);
        }

        return view('frontend.trees', compact('notes'));
    }

    //dashboard for auth users
    public function dashboard()
    {
        $user = auth()->user();
        $protectedNotes = Note::where('user_id', $user->id)->where('is_protected', true)->get();

        return view('frontend.dashboard', compact('user', 'protectedNotes'));
    }

    //note editor
    public function create($slug)
    {
        $note = Note::where('slug', $slug)->first();
        $page404 = view('frontend.404');

        //if the note not found
        if (!$note) {
            return $page404;
        }

        if (auth()->check()) {
            $auth_id = auth()->user()->id;
        } else {
            $auth_id = 489383174;
        }

        //password for protected notes
        if ($note->is_protected && $note->user_id != $auth_id) {
            return view('frontend.protect-pass', compact('note'));
        }

        //if non registered user
        if ($note->user_id == null) {
            //if exceedes 30 days
            if ($note->created_at <= Carbon::now()->subDays(30)) {
                $note->delete();
                return $page404;
            }
        }

        //if registered user
        if ($note->user_id != null) {
            if ($note->user->is_paid == false) {
                //if exceedes 90 days
                if ($note->created_at <= Carbon::now()->subDays(90)) {
                    $note->delete();
                    return $page404;
                }
            }
        }

        return view('frontend.new', compact('note'));
    }

    // save note
    public function store(Request $request)
    {
        //genetate random slug
        $time = Carbon::now();
        $slug = Str::random(2) . $time->format('Y') . Str::random(2) . $time->format('ms') . Str::random(2) . $time->format('Hid') . Str::random(1);

        if (auth()->check()) {
            $user_id = auth()->user()->id;
        } else {
            $user_id = null;
        }

        //storing to db
        $note = Note::create([
            'name' => $request->name,
            'slug' => $slug,
            'ip' => $request->ip(),
            'user_id' => $user_id,
        ]);


        //pushing ids if session already created
        if (!auth()->check()) {
            if ($request->session()->has('note.ids')) {
                $request->session()->push('note.ids', $note->id);
            } else {
                $request->session()->put('note.ids', [$note->id]);
            }
        }

        return redirect(route('note.create', $note->slug));
    }

    //update note texts
    public function update(Request $request, $slug)
    {
        $note = Note::where('slug', $slug)->first();
        $note->update([
            'texts' => $request->texts,
        ]);
    }

    //delete trre/ note
    public function destroy($slug)
    {
        $note = Note::where('slug', $slug)->first();
        $note->delete();
        return back();
    }
}
