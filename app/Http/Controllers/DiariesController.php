<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiariesController extends Controller
{
    public function index()
    {
        
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $diaries = $user->diaries()->orderBy('created_at', 'desc')->paginate(25);
            return view('diaries.index', [
            'diaries' => $diaries,
        ]);
    

            $data = [
                'user' => $user,
                'diaries' => $diaries,
            ];
        }
        
        return view('welcome', $data);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:191',
        ]);

        $request->user()->diaries()->create([
            'content' => $request->content,
        ]);

        return back();
    }
    
    public function destroy($id)
    {
        $diary = \App\Cat_Lover::find($id);

        if (\Auth::id() === $diary->user_id) {
            $diary->delete();
        }

        return back();
    }
}
