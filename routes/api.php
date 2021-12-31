<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Models\User;
use App\Models\Quote;
use App\Models\Book;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);

    //
    Route::resource('/quotes', App\Http\Controllers\QuoteController::class);

    //// USER QUOTES ////
    /*
    Get all quotes by current login user!
    */
    Route::get('/user-all-quotes', function (Request $request) {
        $user_quotes = User::with('quotes')->find(Auth::id())->latest()->paginate(20);

        return response()->json($user_quotes);
    });

     /*
    Get latest quote by current login user!
    */
    // $posts = DB::table('posts')->where('user_id', auth()->id())->get();
    Route::get('/user-get-all-latest-quotes', function () {
        $user_quotes = Quote::where('user_id', Auth::id())->with('books')
        ->latest()->paginate(20);

        return response()->json($user_quotes);
    });

    Route::get('/user-get-single-latest-quote', function () {
        $user_quotes = Quote::where('user_id', Auth::id())->with('books')
            ->latest('created_at')->first();

        return response()->json($user_quotes);
    });

    Route::post('/user-post-book-from-latest-quote', function (Request $request) {

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

});
