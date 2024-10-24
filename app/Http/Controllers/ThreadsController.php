<?php

namespace App\Http\Controllers;

use App\Filters\ThreadFilters;
use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rules\Exists;
use function Pest\Laravel\postJson;

class ThreadsController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public function index(Channel $channel, ThreadFilters $filters)
    {
        $builder = Thread::latest();

        if ($channel->exists) {
            $builder->where('channel_id', $channel->id);
        }

        $threads = $builder->filter($filters)->get();

        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): mixed
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'channel_id' => ['required', new Exists((new Channel())->getTable(), 'id')]
        ]);

        $thread = Thread::create([
            'channel_id' => $request->get('channel_id'),
            'user_id' => auth()->id(),
            'title' => $request->get('title'),
            'body' => $request->get('body'),
        ]);

        return redirect()->to($thread->path);
    }

    /**
     * Display the specified resource.
     */
    public function show($channelId, Thread $thread)
    {
        return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thread $thread)
    {
        //
    }

    public static function middleware(): array
    {
        return [new Middleware('auth', null, ['index', 'show'])];
    }
}
