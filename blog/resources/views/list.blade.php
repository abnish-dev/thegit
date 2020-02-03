
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel 6.0 CRUD application</title>

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
        <div class="col-md-12 text-right mb-3">
          <a href="{{route('articles.add')}}" class="btn btn-primary">ADD</a>
        </div>

        @if(Session:: has('msg'))
          <div class="col-md-12">
            <div class = "alert alert-success"> {{Session::get('msg')}}</div>
          </div>
      
        @endif


        @if(Session:: has('errorMsg'))
          <div class="col-md-12">
            <div class = "alert alert-danger"> {{Session::get('errorMsg')}}</div>
          </div>
      
        @endif

      </div>
    
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header"> <h5>Articles/List</h5></div>
            <div class="card-body">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th> ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Created</th>
                    <th width="100">Edit</th>
                    <th width="100">Delete</th>
                  </tr>
                </thead>
                @if($articles)
                    @foreach($articles as $article)
                      <tr>
                        <td>{{$article->id}}</td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->author}}</td>
                        <td>{{$article->created_at}}</td>
                        <td><a href="{{url('articles/edit/' . $article->id)}}" class="btn btn-primary"> Edit</a></td>
                        <td><a href="#" onclick="deleteArticle({{$article->id}}) ;" class="btn btn-danger"> Delete</a></td>  
                      </tr>
                    @endforeach
                 @else
                   <tr>
                      <td colspan="6">Article has not been added yet</td>  
                   </tr>
                 @endif   
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>

</body>
</html>

<script type="text/javascript">
    function deleteArticle($id)
    {
        if (confirm('Are you sure you want to delete ?'))
        {
          window.location.href = "{{url('articles/delete')}}/" + $id;
        }
    }
</script>