<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Concern Report</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      color: #333;
      margin: 20px;
      padding: 0;
    }
    .container {
      max-width: 1200px;
      margin: auto;
      background: #fff;
      padding: 20px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }
    .title {
      text-align: center;
      margin-bottom: 20px;
    }
    .title h2 {
      margin: 0;
      font-size: 2em;
      color: #333;
    }
    .title p {
      margin: 10px 0;
      color: #777;
      font-size: 1.1em;
    }
    .summary {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }
    .summary div {
      width: 28%;
      background: #f2f2f2;
      margin-bottom: 10px;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    .summary div p {
      margin: 0;
      font-size: 1.2em;
      color: #333;
    }
    .summary div p strong {
      display: block;
      font-size: 1.1em;
      margin-bottom: 5px;
      color: #555;
    }
    .table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    .table th, .table td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: left;
    }
    .table th {
      background-color: #f2f2f2;
      font-weight: bold;
    }
    .table tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    .footer {
      text-align: center;
      margin-top: 20px;
      font-size: 0.9em;
      color: #666;
    }
    .left-align {
      text-align: left;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="title">
      <h2>Concern Report</h2>
      <p class="left-align">Below is the summary of the reported concerns.</p>
    </div>
    
    {{-- <div class="mt-3 mb-3">
      <h6>Nama : {{ $pengaduan->user->name }}</h6>
      <h6>Email : {{ $pengaduan->user->email }}</h6>      
      <h6>Phone Number : {{ $pengaduan->user->phone }}</h6>      
    </div> --}}

    <!-- Summary Section -->
    <div class="summary mt-3 mb-3">
        <p><strong>Total Reports:</strong> {{ $data['pengaduan'] }}</p>
        <p><strong>Pending Reports:</strong> {{ $data['pending'] }}</p>
        <p><strong>In Process Reports:</strong> {{ $data['process'] }}</p>
        <p><strong>Resolved Reports:</strong> {{ $data['success'] }}</p>
        <p><strong>Total Responses:</strong> {{ $data['tanggapan'] }}</p>
    </div>
    
    <p class="left-align">Below is a list of the reported concerns.</p>
    <!-- Table Section -->
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Email</th>
          <th>Report</th>
          <th>Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pengaduan as $item)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ htmlspecialchars($item->user->name, ENT_QUOTES, 'UTF-8') }}</td>
            <td>{{ htmlspecialchars($item->user->email, ENT_QUOTES, 'UTF-8') }}</td>
            <td>{{ htmlspecialchars($item->description, ENT_QUOTES, 'UTF-8') }}</td>
            <td>{{ $item->created_at->format('l, d F Y') }}</td>
            <td>{{ htmlspecialchars($item->status, ENT_QUOTES, 'UTF-8') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <!-- Footer Section -->
    <div class="footer">
      <p>Generated on: {{ date('l, d F Y') }}</p>
    </div>
  </div>
</body>
</html>
