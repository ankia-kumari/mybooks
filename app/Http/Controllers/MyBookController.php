<?php

namespace App\Http\Controllers;


use App\Book;
use App\Http\Requests\MyBookRequest;
use App\Http\Resources\MyBookResource;
use App\Notifications\MyBookNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MyBookController extends Controller
{
    public function addMyBook(MyBookRequest $request){

       $add_book = [

         'title' => $request['title'],
         'user_id_fk' => auth()->id(),

       ];

       DB::beginTransaction();
        if($new_book = Book::create($add_book)){

            DB::commit();

            $user = User::find(auth()->id());

            $user->notify(new MyBookNotification(ucfirst($new_book->title).' has been added to your book list'));

            return new MyBookResource($new_book, $user);

        }

    }

    public function listMyBook(){

        $list_book = Book::with('userRelation')->where('user_id_fk', auth()->id())
                           ->orderBy('created_at', 'desc')->get();

        return MyBookResource::collection($list_book);


    }

    public function update(MyBookRequest $request){

        $update_book = Book::findOrFail($request->book_id);

        DB::beginTransaction();
            if($update = $update_book->update(['title'=>$request['title']])) {
                DB::commit();

                return new MyBookResource($update_book);
            }

    }

    public function destroy($id,$type="soft"){

        $book = Book::findOrFail($id);

        DB::beginTransaction();
        $user = User::find(auth()->id());

        if($type == "hard") {

            if($book->forceDelete()) {
            DB::commit();
                $user->notify(new MyBookNotification(ucfirst($book->title).' has been deleted forever from your book list'));
                return new MyBookResource($book);
            }
        }
        else {
            if($book->delete()) {
                DB::commit();
                $user->notify(new MyBookNotification(ucfirst($book->title).' has been soft deleted from your book list'));
                return new MyBookResource($book);
            }
        }


    }


}
