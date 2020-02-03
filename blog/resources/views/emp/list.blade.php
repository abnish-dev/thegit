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
    <div class="jumbotron">
        <div class="h3">Image CRUD in Laravel Framework</div>


      <div class="row">
        <div class="col-md-12 text-right mb-3">
          <a href="{{route('employees.add')}}" class="btn btn-primary"> Add a new employee </a>
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
            <table class="table bg-white"><h5>Employees/List</h5>
                <thead class="thead-dark">
        
                  <tr>
                    <th scope="col"> ID </th>
                    <th scope="col"> Name </th>
                    <th scope="col"> Email </th>
                    <th scope="col"> Post </th>
                    <th scope="col"> Image </th>
                    <th width="100">Action</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach($employees as $employee)
                  <tr>
                    <td> {{$employee -> id}} </td>
                    <td> {{$employee -> name}} </td>
                    <td> {{$employee -> email}} </td>
                    <td> {{$employee -> post}} </td>
                    <td> <img src="{{asset('/uploads/employee/' . $employee->image)}}" width="100px" height="100px"></td>

                    <td> <a href="{{url('employees/emp/edit/' . $employee->id)}}" class="btn btn-success"> Edit</a>
                    
                    <a href="#" onclick="deleteEmployee({{$employee->id}}) ;" class="btn btn-danger"> Delete</a></td>
                  </tr>
                @endforeach
              </tbody>
        </table>
      </div>
    </div>
  </div>


</body>
</html>
<script type="text/javascript">
    function deleteEmployee($id)
    {
        if (confirm('Are you sure you want to delete ?'))
        {
          window.location.href = "{{url('employees/delete')}}/" + $id;
        }
    }
</script>