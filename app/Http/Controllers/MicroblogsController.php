<?php

namespace App\Http\Controllers;

use App\Models\Microblog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MicroblogRequest;


class MicroblogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function showPerson(User $user)
    {
        $microblogs = $user->microblogs()
                             ->orderBy('created_at','desc')
                             ->paginate(20);
        return view('microblogs._microblog', compact('user','microblogs'));
    }

    public function show(Microblog $microblog)
    {
        return view('microblogs.show', compact('microblog'));
    }

    public function create()
    {
        return view('microblogs._createForm');
    }

    public function store(MicroblogRequest $request)
    {
        $microblog = Microblog::create($request->all());
        return redirect()->route('microblogs.show', $microblog->id)->with('message', 'Created successfully.');
    }

    public function edit(Microblog $microblog)
    {
        $this->authorize('update', $microblog);
        return view('microblogs.create_and_edit', compact('microblog'));
    }

    public function update(MicroblogRequest $request, Microblog $microblog)
    {
        $this->authorize('update', $microblog);
        $microblog->update($request->all());

        return redirect()->route('microblogs.show', $microblog->id)->with('message', 'Updated successfully.');
    }

    public function destroy(Microblog $microblog)
    {
        $this->authorize('destroy', $microblog);
        $microblog->delete();

        return redirect()->route('microblogs.index')->with('message', 'Deleted successfully.');
    }
}