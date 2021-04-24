<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AnnoncesController extends Controller
{
    
public function createArticle(){

    return view('createArticle');
}


public function articleForm(Request $request){

    $photo = $request->file('photo');
    $extension = $photo->getClientOriginalExtension();
    $photoName = time() . '.' . $extension;

    $photo->move(public_path('img'),$photoName);

    Annonce::create([
        'title' =>request('title'),
        'description' => request('description'),
        'price' => request('price'),
        'photo' => $photoName,
        'user_id' => Auth::id()
    ]);
    return redirect(route('showArticles'))->
    with('success','Article successfully created');

}

public function displayArticleEdit(){
    return view('articleEdit');
}

public function modifyArticle(Request $request){


    $article = Annonce::find($request->get('id'));
    $article->title = $request->post('title');
    $article->description = $request->post('description');
    $article->price = $request->post('price');
    $article->save();
    return redirect(route('articleEdit'))->with('success','Article modified');


}

public function deleteArticle(Request $request){


    $article = Annonce::find($request->get('id'));
    $article->delete();

    return redirect(route('showArticles'))->with('success','Article deleted');


}




 



}
