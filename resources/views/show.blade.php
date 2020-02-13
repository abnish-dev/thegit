<!DOCTYPE html>
<html>
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> Laravel crud</title>
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}">
  
</head>

<body class="bg-light">
  <div class="p-3 mb-2 bg-dark text-white">
    <div class="container">
      <div class="h3">Laravel 6.0 CRUD application</div>
    </div>
  </div>

  <div class="container">
      <div class="row">
        <div class="col md-12 text-right mb-3">
          <a href="{{route('articles')}}" class="btn btn-primary">Back</a>
        </div>
      </div>
    
      <div class="row">
        <div class="col md-12">
          <div class="card">
            <div class="card-header"> <h5>Articles/ Record</h5></div>
            <div class="card-body">
              <form action="{{route('articlesShow',['id'=>$article->id])}}" method="GET" enctype="multipart/form-data" >
               @csrf 

              <table class="table">
                
                  
                    <tr>
                      <td>
                    <div class="col-md-4" style="font-size: 20px;font-weight: bold;">Title</div>
                    <div class="col-md-4"><p name="title" id="title" value="">
                      {{old('title',$article->title)}}</p></div>
                    </td>
                  </tr>
                  
                

                
                  <tr>
                    <td>
                    <div class="col-md-4" style="font-size: 20px;font-weight: bold;">Description</div>
                    <div class="col-md-4"><p name="description" id="description" value="">{{old('description',$article->description)}}</p></div>
                  </td></tr>
                 

                
                  <tr><td>
                    <div class="col-md-4" style="font-size: 20px;font-weight: bold;">Author</div>
                    <div class="col-md-4"><p name="author" id="author" value="" >{{old('author',$article->author)}}</p></div>
                  </td></tr>
                                         

                  <tr><td>
                <div class="col-md-12">
                  <div style="font-size: 20px;font-weight: bold;">Images</div>
                  @if(count($articleImages)> 0 )
                    @foreach($articleImages as $images)
                    <img src="/uploads/article/<?php echo $images['image'];?>" style="width:100px;height:100px;">
                    @endforeach
                  @endif
                </div>
              </td></tr>

              </table>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>

  
</body>
</html>