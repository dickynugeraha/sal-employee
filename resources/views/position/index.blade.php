@extends('layouts.admin_view')

@section('content_admin')
<h3 class="text-center my-3">POSITIONS</h3>
<div class="mb-4">
  <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddPositions" style="text-decoration:none"><i class="fa fa-plus me-2"></i> Add position</a>
</div>
 <script>
  let msg = '{{Session::get('alert')}}';
  let exist = '{{Session::has('alert')}}';

  if (exist){
    alert(msg);
  }
 </script>
 <div class="modal fade" id="modalAddPositions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add position</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/position" method="post" >
          <div class="modal-body">
              <div class="mb-2">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" name="title" id="title" class="form-control" required>
              </div>
              <div class="mb-2">
                  <label for="bonus" class="form-label">Bonus</label>
                  <input type="text" name="bonus" id="bonus" class="form-control" required>
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
    <table id="data-positions" class="table table-hover" >
      <thead>
        <tr>
          <th>No</th>
          <th>Title</th>
          <th>Bonus</th>
          <th>Action</th>
        </tr>
      </thead>
      <?php $nomor = 1; ?>
      <tbody>
        @foreach ($positions as $position)
          <tr>
            <td>{{$nomor}}</td>
            <td>{{$position->title}}</td>
            <td>{{$position->bonus * 100}} %</td>
            <td>
              <a data-bs-toggle="modal" data-bs-target="#exampleModal{{$position->id}}" class="text-decoration-none me-2" href="/"> Edit</a>
              <a class="text-decoration-none" href="/position/{{$position->id}}/delete"> Delete</a>
            </td>
          </tr>
        <?php $nomor++ ?>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal{{$position->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Product edit</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/position/update" method="post" >
                  <div class="modal-body">
                      <div class="mb-2">
                          <label for="title" class="form-label">Title</label>
                          <input type="text" name="title" id="title" class="form-control" required value={{$position->title}}>
                      </div>
                      <div class="mb-2">
                          <label for="bonus" class="form-label">Bonus</label>
                          <input type="text" name="bonus" id="bonus" class="form-control" required value={{$position->bonus}}>
                      </div>
                      <input type="hidden" name="position_id" value="{{$position->id}}">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button class="btn btn-sm btn-primary" type="submit">Update</button>
                  </div>
              </form>
            </div>
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
      $('#data-positions').DataTable();
  });
</script>
@endsection