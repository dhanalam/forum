<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class RepliesController extends Controller implements HasMiddleware
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $channelId, Thread $thread, Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $thread->addReply([
            'body' => $request->get('body'),
            'user_id' => auth()->id()
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reply $reply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reply $reply)
    {
        //
    }


    /**
     * Middleware
     *
     * @return string[]
     */
    public static function middleware(): array
    {
        return ['auth'];
    }
}
