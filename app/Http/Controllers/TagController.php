<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TagController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index']); // Những user không login chỉ thực hiện được hàm index trong tất cả các hàm dưới đây.
        $this->middleware('admin')->except(['index']); // Những user không phải admin chỉ thực hiện được hàm index trong tất cả các hàm dưới đây.
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('tag.index')->with([
            'tags' => $tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'style' => 'required',
        ]);


        $tag= new Tag([
            'name' => $request['name'],
            'style' => $request['style'],   
        ]);
        $tag->save();
        return $this->index()->with(
            [
                'message_sucess' => "The tag <b>" . $tag->name . "</b> was created."
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        abort_unless(Gate::allows('update', $tag), 403); // Không thể update tag nếu không phải admin

        return view('tag.edit')->with([
            'tag' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {

        abort_unless(Gate::allows('update', $tag), 403); // Không thể update tag nếu không phải admin

        $request->validate([
            'name' => 'required',
            'style' => 'required',
        ]);


        $tag->update([
            'name' => $request['name'],
            'style' => $request['style'],   
        ]);
        
        return $this->index()->with(
            [
                'message_success' => "The tag <b>" . $tag->name . "</b> was updated."
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        abort_unless(Gate::allows('delete', $tag), 403); // Không thể xoá tag nếu không phải admin

        $oldName = $tag->name;
        $tag->delete();
        return $this->index()->with([
            'message_success' => "The tag <b>" . $tag->name . "</b> was deleted."
        ]);
    }
}
