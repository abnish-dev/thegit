<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Schema;


class ArticleController extends Controller
{
  public function __construct()
   {
       $this->middleware('auth');
   }
    public function index(){
      //$articles = DB::table('articles')->orderBy('id','DESC')->get();     // through Query Builder

      $articles = Article::orderBy('id','DESC')->get();       //  through Eloquent ORM
      return view('list')-> with(compact('articles'));

      return Article::all();
    }

    function addArticle(){
      return view('add');

    }

    function saveArticle(Request $request)
    {

          $validator = Validator::make($request->all(),[

          'title' => 'required|max:255',
          'description'=> 'required',
          'author' => 'required|max:100',
          'image' => 'required'

        ]);
 
          if($validator->passes())
          {//echo '<pre>';print_r($request->file('image'));die;
              // enter record into database
              $article = new Article;
              $article->title = $request->title;
              $article->description = $request->description;
              $article->author = $request->author;
              $article->save();
              if ($request->hasfile('image'))
              {
                foreach($request->file('image') as $val){
                   $file = $val;
                   $extension = $file->getClientOriginalExtension();      // getting image extension
                   $filename = time().time().'.'.$file->getClientOriginalExtension();
                   $file->move('uploads/article/', $filename);
                   $saveResult = ArticleImages::create(['image' => $filename,'article_id' => $article->id]);
                 }
              }
              else
              {
                   //$article->image = '';
              }
                $request -> session() -> flash('msg','Article saved successfully');

                return redirect('/home/articles');
              }
           

          else
          {
              // error 
              return redirect('/home/articles/add')->withErrors($validator)->withInput();
          }


      // dd($request-> all());
    }

    function showArticle($id)
    {   

       $article = Article::where('id',$id)->first();
       $articleImages = ArticleImages::where('article_id',$id)->get();
        
       return view('show')->with(compact('article','articleImages')) ;
    }

    function editArticle($id, Request $request)
    {   
        // Fetch a record from the database
        $article = Article::where('id', $id)->first();
        $articleImages = ArticleImages::where('article_id',$id)->get();
        
        return view('edit') -> with(compact('article','articleImages'));
    }


    function updateArticle($id, Request $request)
    {
         $validator = Validator::make($request->all(),[

          'title' => 'required|max:255',
          'description'=> 'required',
          'author' => 'required|max:100'

        ]);

          if($validator->passes())
          {
            $dataArray = [
                'title' => $request->title,
                'description' => $request->description,
                'author' => $request->author,
            ];
            $updateRecord = Article::where('id', $id) ->update($dataArray);
            //echo $updateRecord;die();
            if($updateRecord){
              if($request->hasfile('images')){
                $deleteRecord = ArticleImages::where('article_id', $id)->delete();
                foreach($request->file('images') as $val) {
                  $file = $val;
                  $extension = $file->getClientOriginalExtension();      // getting original image extension
                  $filename = time().uniqid().'.'.$file->getClientOriginalExtension();
                  $file->move('uploads/article/', $filename);
                  $saveResult = ArticleImages::create(['image' => $filename,'article_id' => $id]);
                }
              }              
           } 
             
             $request->session()->flash('msg','Article updated successfully');

             return redirect('/home/articles');
          }
          else
          {
              return redirect('/home/articles/edit/' . $id)->withErrors($validator)->withInput();
          }


      // dd($request-> all());
          
    }

    function deleteArticle($id, Request $request)
    {
        $article = Article::where('id', $id)->first();
        if (!$article)
        {
            $request -> session() -> flash('errorMsg', 'Record not found');
            return redirect('/home/articles');
        }
        else
        {
            Article::where('id', $id)->delete();
            $request -> session() -> flash('errorMsg', 'Record has been been deleted successfully');
            return redirect('/home/articles');
        }
    }
    public function remove_image(Request $request)
    {
     //echo $image->images;die();
        $response =array();
        $id = $request->imageid;
        $image = ArticleImages::findOrFail($id);
       // echo "<pre>";print_r($image->toArray()['images']);die();

        unlink(public_path('uploads/article')."/".$image->toArray()['image']);

         $image->delete();
         $response['success'] = 'true';
         return $response;
    }
}
