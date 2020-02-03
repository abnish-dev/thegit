<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Document</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

  <div class="container">
    <h1> Image Upload in Laravel</h1>
    <div class="row">
        <div class="col md-12 text-right mb-3">
          <a href="{{route('employees')}}" class="btn btn-primary">Back</a>
        </div>
      </div>

    <div class="row">
        <div class="col md-12">
          <div class="card">
            <div class="card-header"> <h5>Employees record /Edit</h5></div>
            <div class="card-body">
              <form action="{{url('employees/emp/edit/' . $employee->id)}}" method="post" enctype="multipart/form-data" >
               @csrf

              <div class="form-group">
                <label> Name </label>
                <input type="text" name="name" value="{{old('name',$employee -> name)}}" class="form-control" placeholder="Enter Name">
              </div>

              <div class="form-group">
                <label> Email </label>
                <input type="email" name="email" class="form-control" value="{{old('email',$employee -> email)}}"placeholder="Enter Email Id">
              </div>

              <div class="form-group">
                <label> Post </label>
                <input type="text" name="post" class="form-control" value="{{old('post',$employee -> post)}}"placeholder="Enter Post">
              </div>

              <div class="input-group">
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input" value="{{$employee -> image}}">
                  <label class="custom-file-label"> Choose File</label>
                </div>
              </div>

              <button type="submit" name="submit" class="btn btn-primary btn-lg"> Edit data</button>

            </form>
    </div>
  </div>
</div>
</div>
</div>

</body>
</html>