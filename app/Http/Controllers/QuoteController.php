<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Quote;
use App\Http\Resources\QuoteResource;
use Auth;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = auth()->user();
        // $id = auth()->user()->id;

        $quotes = Quote::with('user')->latest()->paginate(20);
        return response()->json( $quotes );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $request->validate([
            // 'name' =>'required|string',
            // 'title' => 'required|string'
        // ]);

        // $quote->name = $request->name;
        // $quote->title = $request->title;
        // $input = $request->all();

        // auth()->user()->create($input);
        // $this->create($input);

        // return response()->json(['quotes' => $quote, 200]);
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
    //    $request->validate([
    //     'name' =>'required|string',
    //     'title' => 'required|string'
    // ]);

    $quote = new Quote;
    $quote->user_id = Auth::user()->id;
    $quote->nama_quote = $request->nama_quote;

    $quote->save();

    // return $quote;
    return response()->json(['data' => $quote, 'status' => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // Get article
        $quote = Quote::findOrFail($id);

        // Return single article as a resource
        return response()->json($quote);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $quote = Quote::findOrFail($id);

        if ($quote->delete()) {
            return new ArticleResource($quote);
        }

        return response()->json($quote, 'record deleted');

    }

}
