<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report</title>
  <style>
    img{
      height: 100px;;
    }

    hr.solid {
    border-top: 2px solid #3B82F6;
    }
  </style>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="title text-center mb-5">
      <h2>Concern Report</h2>
    </div>
    <hr class="solid">

    <div>
      <h6>Report Date :</h6>
      <h6>{{ $pengaduan->created_at->format('l, d F Y') }}</h6>
    </div>
    <hr class="solid">
    
    <div class="mt-3 mb-3">
      <h6>Nama : {{ $pengaduan->user->name }}</h6>
      <h6>Email : {{ $pengaduan->user->email }}</h6>      
      <h6>Phone Number : {{ $pengaduan->user->phone }}</h6>      
    </div>

    <table class="table table-bordered">
      <thead class="thead">
        <tr>
          <th scope="col">Report</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <td>{{ $pengaduan->description }}</td>
        <td>{{ $pengaduan->status }}</td>
      </tbody>
    </table>
  </div>
</body>
</html>