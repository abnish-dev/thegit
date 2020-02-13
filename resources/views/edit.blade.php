@include('layouts.app')


  <div class="container">
      <div class="row">
        <h2> Laravel CRUD app</h2>
      </div>
      <div class="row">
        <div class="col md-12 text-right mb-3">
          <a href="{{route('articles')}}" class="btn btn-primary">Back</a>
        </div>
      </div>
    
      <div class="row" style="margin-bottom: 20px;">
        <div class="col md-12">
          <div class="card">
            <div class="card-header"> <h5>Articles/Edit</h5></div>
            <div class="card-body">
              <form action="{{route('articlesEdit',['id'=>$article->id])}}" method="post" name="addArticles" id="addArticles" enctype="multipart/form-data" >
               @csrf 

                <div class="form-group">
                  <label for="">Title</label>
                  <input type="text" name="title" id="title" value="{{old('title',$article->title)}}" class="form-control {{($errors->any() && $errors->first('title'))?'is-invalid':''}} ">

                  @if($errors->any())
                    <p class="invalid-feedback"> {{$errors->first('title')}} </p>
                
                @endif

                </div>

                <div class="form-group">
                  <label for="">Description</label>
                  <textarea name="description" id="description" cols="30" rows="5" class="form-control {{($errors->any() && $errors->first('description'))?'is-invalid':''}}"> {{old('description',$article->description)}}</textarea>
                  
                  @if($errors->any())
                    <p class="invalid-feedback"> {{$errors->first('description')}} </p>
                
                @endif
                </div>

                <div class="form-group">
                  <label for="">Author</label>
                  <input type="text" name="author" id="author" value="{{old('author',$article->author)}}" class="form-control {{($errors->any() && $errors->first('author'))?'is-invalid':''}} ">

                  @if($errors->any())
                    <p class="invalid-feedback"> {{$errors->first('author')}} </p>
                
                @endif
                </div>
<!----Start Edit Multiple Image ---->
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                      <label  class="col-form-label">{{ __('Select Multiple Images') }}</label>
                    </div>
                        

                    <div class="col-md-3">
                         <input type="file" id="file-input" name="images[]" multiple />
                          <span class="text-danger">{{ $errors->first('image') }}</span>
                          <div id="thumb-output"></div>
                    </div>
                  
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                       @if(count($articleImages)> 0)
                      <div class="row_gallery_img" style="display: flex;">
                          @foreach($articleImages as $image)
                            <div href="javascript:void(0)" class="own_delete_btn" id="{{$image->id}}" title="Delete" style="margin:10px;">
                                <img id="prv_{{$image->id}}" src="{{asset('uploads/article')}}/{{$image->image}}" height="50" width="60">
                                <div><i class="fa fa-trash" aria-hidden="true"></i></div>
                            </div>
                          @endforeach
                      </div>
                    @endif
                    </div>
                  </div>
                    
                </div>
  <!----End Edit Multiple Image ---->            

                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-primary"> Update Articles </button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
<script>
  $(document).ready(function(){

  $(".own_delete_btn").on('click', function(e){
    if(confirm("Are you sure to delete?")){
      var imageid = jQuery(this).attr('id');
      if(imageid!='') {
        jQuery.ajax({
          type : 'GET',
          url : "/article/remove_image",
          data:{'imageid': imageid},
          success:function(response) {
            if(response = "true"){
             $('#prv_'+imageid).remove();
             $('#'+imageid).remove();
           }
         }
       });
      }
    }else{
      return false;
    }
  });
  })
</script>
