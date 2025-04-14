<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        /*
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'content' => 'required|string'
        ]);
        */
        $commenterId = session('commenter_id');

        if(!$commenterId){
            return redirect()->route('login.google');
        }

        $test = Comment::create([
            'commenter_id' => $commenterId,
            'project_id' => $request->project_id,
            'content' => $request->content
        ]);


        return back()->with('success', 'Comment added successfully!');
    }

    public function destroy(string $id){
        $comment = Comment::find($id);

        if ($comment) {
            $comment->delete();
            return back()->with('success', 'Comment deleted successfully!');
        } else {
            return back()->with('error', 'Comment not found.');
        }
    }


    public function logout(Request $request)
    {
        session()->forget('commenter_id');
        return redirect('/')->with('success', 'Logged out successfully!');
    }
}