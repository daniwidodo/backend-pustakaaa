<?php

// API route for logout user
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

    //
    Route::resource('/quotes', App\Http\Controllers\QuoteController::class);

    //// USER QUOTES ////
    /*
    Get all quotes by current login user!
    */
    // Route::get('/quotes', function () {
    //     $user_quotes = User::with('quotes')->find(Auth::id())->latest()->paginate(20);

    //     return response()->json($user_quotes);
    // });

     /*
    Get latest quote by current login user!
    */
    // $posts = DB::table('posts')->where('user_id', auth()->id())->get();
    Route::get('/users/quotes', function () {
        $user_quotes = Quote::where('user_id', Auth::id())->with('books')
        ->latest()->paginate(20);

        return response()->json($user_quotes);
    });

    Route::get('/users/quote', function () {
        $user_quotes = Quote::where('user_id', Auth::id())->with('books')
            ->latest('created_at')->first();

        return response()->json($user_quotes);
    });

    Route::post('/users/book', function (Request $request) {

        $validator = Validator::make($request->all(),
              [
                'judul_buku' => 'required|string|max:255',
                'nomor_isbn' => 'required|string|max:255'
             ]);

        if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
             }

        //store book to database
        $book = new Book;
        $book->judul_buku = $request->judul_buku;
        $book->nomor_isbn = $request->nomor_isbn;
        $book->quote_id = $request->quote_id;

        ///////
        $originaFileName = $request->foto_sampul->getClientOriginalName();
        $nameWithoutWhitespace = str_replace(' ', '_', $originaFileName);
        $newImageName = time() . '_' . $nameWithoutWhitespace;

        $book->foto_sampul = $request->foto_sampul->move(public_path('images'),  $newImageName);
        $book->foto_samping = $request->foto_samping->move(public_path('images'),  $newImageName);

        //////////

        $book->save();
        return response()->json($book);
    });
