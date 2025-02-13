<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tags\CreateTagsRequest;
use App\Http\Requests\Tags\UpdateTagsRequest;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('tags.index')->with('tags', $tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagsRequest $request)
    {
        Tag::create([
            'name' => $request->name
        ]);

        session()->flash('success', 'Tag created successfully.');

        return redirect(route('tags.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {

        return view('tags.edit')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagsRequest $request, Tag $tag)
    {
        $tag->update([
            'name' => $request->name
        ]);

        session()->flash('success', 'Tag updated successfully.');

        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if ($tag->posts->count() > 0) {
            session()->flash('error', 'Tag cannot be deleted. It is associated with (a) post(s).');
            return redirect()->back();
        }

        $tag->delete();

        session()->flash('success', 'Tag deleted successfully.');

        return redirect(route('tags.index'));
    }
}
