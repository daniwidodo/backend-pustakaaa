<?php

namespace App\Http\Controllers\API;
use App\Models\Quote;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserQuotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $user = auth()->user();
        // $id = auth()->user()->id;

        $quotes = Quote::with('user')->latest()->paginate(20);
        return response()->json( $quotes );
        // return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        // $user = auth()->user();
        // $id = auth()->user()->id;

        $quote = new Quote;
        $quote->user_id = auth()->user()->id;
        $quote->title = $request->title;

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
        $quote = Quote::with('books')->findOrFail($id);

        return response()->json(['data' => $quote]);
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
        $quote = Quote::find($id)->update($request->all());

        return response()->json([ 'data' => $request ,'result' => $quote, 'status :' =>200 ]);
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

        // if ($quote->delete())
        // {
        //     return $quote;
        // };

        return null;
        // return $quote;
    }
}
