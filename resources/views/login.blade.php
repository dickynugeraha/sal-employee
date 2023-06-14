<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.partials.header_script')
        <title>{{ $title ?? "Salary Employee" }}</title>
    </head>
    <body style="overflow-x:hidden;">
      <div class="row justify-content-center align-items-center" style="height: 90vh;">
        <div class="card col-md-4 p-4">
          <form action="/login" method="post">
            <div class="mb-2">
              <label for="email" class="form-label">Email</label>
              <input class="form-control" type="email" name="email" id="email" required>
            </div>
            <div class="mb-2">
              <label for="password" class="form-label">Password</label>
              <input class="form-control" type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-sm btn-primary mt-2 ms-auto">Login</button>
          </form>
        </div>
      </div>
    </body>
    @include('layouts.partials.footer_script')
</html>