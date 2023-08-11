<?php

namespace App\Http\Controllers\Api;

use App\Models\Novel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NovelController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $novels = Novel::all();
        return response()->json($novels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Novel $novel)
    {
      $novel->create($request->all());
        return response()->json(Novel::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Novel  $novel
     * @return \Illuminate\Http\Response
     */
    public function show(Novel $novel)
    {
        return response()->json($novel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Novel  $novel
     * @return \Illuminate\Http\Response
     */
    public function edit(Novel $novel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Novel  $novel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Novel $novel)
    {
        $novel->update($request->all());
        return response()->json($novel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Novel  $novel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Novel $novel)
    {
        $novel->delete();
        return response()->json(Novel::all());
    }
}
