<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <title>Salaries</title>
  <style>
    #salaries {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }
      
      #salaries td, #salaries th {
        border: 1px solid #ddd;
        padding: 8px;
      }
      
      #salaries tr:nth-child(even){background-color: #f2f2f2;}
      
      #salaries tr:hover {background-color: #ddd;}
      
      #salaries th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        color: rgb(20, 20, 20);
      }
      </style>
</head>
<body>
  <div class="row justify-content-center align-items-center" style="min-height: 95vh">
    <h5 class="mb-3 text-center">DATA SALARIES {{$month}}/{{$year}}</h5>
    <table id="salaries" class="table table-bordered">
        <tr style="font-weight: bold; font-size:0.9rem">
          <tr class="header">
            <th>No</th>
            <th>Bulan/tahun</th>
            <th>NIK</th>
            <th>Name</th>
            <th>Position</th>
            <th>Basic Salary</th>
            <th>Bonus</th>
            <th>Total Salary</th>
          </tr>
        </tr>
     
        <?php $nomor = 1;?>
        @foreach ($salaries as $salary)
        <tr style="font-size: 0.8rem">
          <td>{{$nomor}}</td>
          <td>{{$salary->month}}/{{$salary->year}}</td>
          <td>{{$salary->employee->nik}}</td>
          <td>{{$salary->employee->name}}</td>
          <td>{{$salary->position_title}}</td>
          <td>Rp. {{number_format($salary->employee->basic_salary,0,',','.')}}</td>
          <td>{{$salary->position_bonus * 100}}%</td>
          <td>Rp. {{number_format($salary->total_salary,0,',','.')}}</td>
          
        </tr>
      <?php $nomor++ ?>
        
      @endforeach
    </table>
  </div>
</body>
</html>