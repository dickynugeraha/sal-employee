@extends('layouts.admin_view')

@section('content_admin')
<h3 class="text-center my-3">SALARIES</h3>
<div class="mb-4">
  <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddSalary" style="text-decoration:none">
    <i class="fa fa-plus me-2"></i> Add salary</a>
</div>
 <script>
  let msg = '{{Session::get('alert')}}';
  let exist = '{{Session::has('alert')}}';

  if (exist){
    alert(msg);
  }
 </script>
 <div class="modal fade" id="modalAddSalary" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add salary</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/salary" method="post" enctype="multipart/form-data">
          <div class="modal-body">
              <div class="mb-2">
                  <label for="name" class="form-label">Name employee</label>
                  <select name="employee_id" id="name" class="form-select">
                    @foreach ($employees as $employee)
                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                    @endforeach
                  </select>
                </div>
             
              <div class="mb-2">
                  <label for="month" class="form-label">Month</label>
                  <input min="1" max="12" type="number" name="month" id="month" class="form-control" required>
              </div>
              <?php $yearNow = date("Y") ?>
              <div class="mb-2">
                  <label for="year" class="form-label">Year</label>
                  <input min={{$yearNow}} max="{{$yearNow + 3}}" type="number" name="year" id="year" class="form-control" required>
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
    <table id="data-salaries" class="table table-hover" >
      <thead>
        <tr>
          <th>No</th>
          <th>Bulan/tahun</th>
          <th>NIK</th>
          <th>Name</th>
          <th>Position</th>
          <th>Basic Salary</th>
          <th>Bonus</th>
          <th>Total Salary</th>
          <th>Actions</th>
        </tr>
      </thead>
      <?php $nomor = 1; ?>
      <tbody>
        @foreach ($salaries as $salary)
          <tr>
            <td>{{$nomor}}</td>
            <td>{{$salary->month}}/{{$salary->year}}</td>
            <td>{{$salary->employee->nik}}</td>
            <td>{{$salary->employee->name}}</td>
            <td>{{$salary->position_title}}</td>
            <td>Rp. {{number_format($salary->employee->basic_salary,0,',','.')}}</td>
            <td>{{$salary->position_bonus * 100}}%</td>
            <td>Rp. {{number_format($salary->total_salary,0,',','.')}}</td>
            <td>
              <a class="text-decoration-none" href="/salary/{{$salary->id}}/delete"> Delete</a>
            </td>
          </tr>
        <?php $nomor++ ?>
          
        @endforeach
      </tbody>
    </table>
</div>
@endsection

@section('add_javascript')
<script>
  $(document).ready(function () {
      $('#data-salaries').DataTable();
  });
</script>
@endsection