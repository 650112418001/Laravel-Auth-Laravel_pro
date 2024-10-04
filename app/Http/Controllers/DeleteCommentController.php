<?php

namespace App\Http\Controllers;

use App\Models\Comment;

//กดปุ่ม Delete Comment
class DeleteCommentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id, Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return back();
    }
}