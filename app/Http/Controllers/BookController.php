<?php

namespace App\Http\Controllers;
use Illuminate\http\Request;
use App\Models\Models\ModelBook;
use App\Models\User;
use App\Http\Requests\BookRequest;


class BookController extends Controller{
    public $timestamps = false;

    public function index(){
        $book=ModelBook::paginate(2);
        return view('index',compact('book'));
    }

    public function show($id){
        $book=ModelBook::find($id);
        return view('show',compact('book'));
        //echo $id;
    }

    public function create(){
        $users=User::all();
        return view('create',compact('users'));
    }

    public function store(BookRequest  $request){
        $cad=ModelBook::create([
            'title'=>$request->title,
            'pages'=>$request->pages,
            'price'=>$request->price,
            'id_user'=>$request->id_user
        ]);
        if($cad){
            return redirect('books');
        }
    }

    public function edit($id){
        $book=ModelBook::find($id);
        $users=User::all();
        return view('create',compact('book','users'));
    }

    public function update(BookRequest $request, $id){
        ModelBook::where(['id'=>$id])->update([
            'title'=>$request->title,
            'pages'=>$request->pages,
            'price'=>$request->price,
            'id_user'=>$request->id_user
        ]);
        return redirect('books');
    }

    public function destroy($id){
        $del=ModelBook::destroy($id);
        return($del)?"sim":"não";
    }
}