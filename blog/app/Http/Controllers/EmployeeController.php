<?php

namespace App\Http\Controllers;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

     public function display()
    {
        $employees = DB::table('employees')->orderBy('id','DESC')->get();

        //$employees = Employee::orderBy('id','DESC')-> get();
        return view('emp/list') -> with(compact('employees'));
    }

    public function addEmployee()
    {

        return view('emp/add'); 
    }

    public function saveEmployee(Request $request)
    {
      //echo "fgfgdf";die();
        $validator = Validator::make($request->all(),[

          'name' => 'required|max:255',
          'email'=> 'required',
          'post' => 'required|max:100',
          'image' => 'required'

        ]);

        if($validator->passes())
        {
          //echo "1";die;
              // enter record into database
              $employee = new Employee();
              $employee->name = $request->input('name');
              $employee->email = $request->input('email');
              $employee->post = $request->input('post');  

              if ($request->hasfile('image'))
              {
                   $file = $request->file('image');
                   $extension = $file->getClientOriginalExtension();      // getting image extension
                   $filename = time().time().'.'.$file->getClientOriginalExtension();
                   $file->move('uploads/employee/', $filename);
                   $employee->image = $filename;
              }
              else
              {
                   $employee->image = '';
              }
              
              $employee->save();

              $request->session()->flash('msg','Employee record stored successfully');

              return redirect('/employees');
        }
        else
        {
           // echo "2";die;
            return redirect('/employees/emp/add')->withErrors($validator)->withInput();
        }

    }


    public function editEmployee($id, Request $request)
    {

        // echo "<pre>";var_dump($employee);die();
        $employee = Employee::where('id',$id) -> first();
        if(!$employee)
        {
            $request -> session()->flash('msg', "Record not found");
            return redirect('employees');
        }

            return view('emp/edit') -> with(compact('employee'));
        
    }

    function updateEmployee($id, Request $request)
    {
      //echo '<pre>';print_r($employee);die();
         $validator = Validator::make($request->all(),[

          'name' => 'required|max:255',
          'email'=> 'required|max:255',
          'post' => 'required|max:100',
          'image' => 'required'

        ]);

          if($validator->passes())
          {
              // enter record into database
              $employee = Employee::find($id);
              $employee->name = $request->name;
              $employee->email = $request->email;
              $employee->post = $request->post;

              if ($request->hasfile('image'))
              {
                   $file = $request->file('image');
                   $extension = $file->getClientOriginalExtension();      // getting image extension
                   $filename = time().time().'.'.$file->getClientOriginalExtension();
                   $file->move('uploads/employee/', $filename);
                   $employee->image = $filename;
              }
              else
              {
                   return $request;
                   $employee->image = '';
              }
              
              $employee -> save();

              $request -> session() -> flash('msg','Employee record updated successfully');

              return redirect('employees');
          }
          else
          {
              // error 
              return redirect('employees/emp/edit/' . $id)->withErrors($validator)->withInput();
          }


      // dd($request-> all());
          
    }

    function deleteEmployee($id, Request $request)
    {
        $employee = employee::where('id', $id)->first();
        if (!$employee)
        {
            $request -> session() -> flash('errorMsg', 'Record not found');
            return redirect('employees');
        }
        else
        {
            employee::where('id', $id)->delete();
            $request -> session() -> flash('errorMsg', 'Record has been deleted successfully');
            return redirect('employees');
        }
    }
}

