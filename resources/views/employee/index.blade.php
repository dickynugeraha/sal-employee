@extends('layouts.admin_view')

@section('content_admin')
<h3 class="text-center my-3">EMPLOYEES</h3>
<div class="mb-4">
  <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddEmployee" style="text-decoration:none">
    <i class="fa fa-plus me-2"></i> Add employee</a>
</div>
 <script>
  let msg = '{{Session::get('alert')}}';
  let exist = '{{Session::has('alert')}}';

  if (exist){
    alert(msg);
  }
 </script>
 <div class="modal fade" id="modalAddEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="/employee" method="post" enctype="multipart/form-data">
          <div class="modal-body">
              <div class="mb-2">
                  <label for="nik" class="form-label">NIK</label>
                  <input type="number" name="nik" id="nik" class="form-control" required>
              </div>
              <div class="mb-2">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" name="name" id="name" class="form-control" required>
              </div>
              <div class="mb-2">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" id="email" class="form-control" required>
              </div>
              <div class="mb-2">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" name="address" id="address" class="form-control" required>
              </div>
              <div class="mb-2">
                  <label for="age" class="form-label">Age</label>
                  <input type="number" name="age" id="age" class="form-control" required>
              </div>
              <div class="mb-2">
                <label for="bank" class="form-label">Bank</label>
                <input type="text" name="bank" id="bank" class="form-control" required>
              </div>
              <div class="mb-2">
                <label for="no_rekening" class="form-label">Nomor Rekening</label>
                <input type="number" name="no_rekening" id="no_rekening" class="form-control" required>
              </div>
              <div class="mb-2">
                <label for="basic_salary" class="form-label">Basic Salary</label>
                <input type="number" name="basic_salary" id="basic_salary" class="form-control" required>
              </div>
              <div class="mb-2">
                <label for="position" class="form-label">Position</label>
                <select class="form-select" name="position_id" id="position">
                  @foreach ($positions as $position)
                      <option value="{{$position->id}}">{{ $position->title }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-2">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" name="photo" id="photo" class="form-control">
              </div>
            </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button class="btn btn-sm btn-primary" type="submit">Add</button>
          </div>
        </form>

      </div>
  </div>
</div>
<div class="row">
    <table id="data-employees" class="table table-hover" >
      <thead>
        <tr>
          <th>No</th>
          <th>NIK</th>
          <th>Name</th>
          <th>Position</th>
          <th>Email</th>
          <th>Address</th>
          <th>Age</th>
          <th>Bank</th>
          <th>Nomor Rekening</th>
          <th>Basic Salary</th>
          <th>Photo</th>
          <th>Action</th>
        </tr>
      </thead>
      <?php $nomor = 1; ?>
      <tbody>
        @foreach ($employees as $employee)
          <tr>
            <td>{{$nomor}}</td>
            <td>{{$employee->nik}}</td>
            <td>{{$employee->name}}</td>
            <td>{{$employee->position->title}}</td>
            <td>{{$employee->email}}</td>
            <td>{{$employee->address}}</td>
            <td>{{$employee->age}}</td>
            <td>{{$employee->bank}}</td>
            <td>{{$employee->no_rekening}}</td>
            <td>Rp. {{number_format($employee->basic_salary,0,',','.')}}</td>
            <td>
              <img class="rounded" width="120px" height="120px" src="/uploads/photo/{{$employee->photo}}" alt="Photo product" srcset="">
            </td>
            <td>
              <a data-bs-toggle="modal" data-bs-target="#exampleModal{{$employee->id}}" class="text-decoration-none me-2" href="/"> Edit</a>
              <a class="text-decoration-none" href="/employee/{{$employee->id}}/delete"> Delete</a>
            </td>
          </tr>
        <?php $nomor++ ?>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal{{$employee->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Employee edit</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/employee/update" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                      <div class="mb-2">
                          <label for="nik" class="form-label">NIK</label>
                          <input type="number" name="nik" id="nik" class="form-control" required value={{$employee->nik}}>
                      </div>
                      <div class="mb-2">
                          <label for="name" class="form-label">Name</label>
                          <input type="text" name="name" id="name" class="form-control" required value={{$employee->name}}>
                      </div>
                      <div class="mb-2">
                          <label for="email" class="form-label">Email</label>
                          <input type="email" name="email" id="email" class="form-control" required value={{$employee->email}}>
                      </div>
                      <div class="mb-2">
                          <label for="address" class="form-label">Address</label>
                          <input type="text" name="address" id="address" class="form-control" required value={{$employee->address}}>
                      </div>
                      <div class="mb-2">
                          <label for="age" class="form-label">Age</label>
                          <input type="number" name="age" id="age" class="form-control" required value={{$employee->age}}>
                      </div>
                      <div class="mb-2">
                        <label for="bank" class="form-label">Bank</label>
                        <input type="text" name="bank" id="bank" class="form-control" required value={{$employee->bank}}>
                      </div>
                      <div class="mb-2">
                        <label for="no_rekening" class="form-label">Nomor Rekening</label>
                        <input type="number" name="no_rekening" id="no_rekening" class="form-control" required value={{$employee->no_rekening}}>
                      </div>
                      <div class="mb-2">
                        <label for="basic_salary" class="form-label">Basic Salary</label>
                        <input type="number" name="basic_salary" id="basic_salary" class="form-control" required value={{$employee->basic_salary}}> 
                      </div>
                      <div class="mb-2">
                        <label for="position" class="form-label">Position</label>
                        <select class="form-select" name="position_id" id="position">
                          @foreach ($positions as $position)
                              <option value="{{$position->id}}">{{ $position->title }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-2">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                      </div>
                      <input type="hidden" name="employee_id" value="{{$employee->id}}">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button class="btn btn-sm btn-primary" type="submit">Update</button>
                  </div>
                </form>
            </div>
          </div>
        @endforeach
      </tbody>
    </table>
</div>
@endsection

@section('add_javascript')
<script>
  $(document).ready(function () {
      $('#data-employees').DataTable();
  });
</script>
@endsection