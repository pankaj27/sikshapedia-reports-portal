<!DOCTYPE html>
<html lang="en">
<head>
  <title>MOU </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    @page { margin: 250px 90px; }
    header { position: fixed; top: -200px; left: 0px; right: 0px;  height: 185px; }
    footer { position: fixed; bottom: -120px; left: 0px; right: 0px;  height: 60px; }
    p,table,tr,td{
        font-size: 25px;
        text-align: justify;
        text-justify: inter-word;
        padding-left: 10px;
    }
    
  </style>
</head>
<body>
    <header><img src="{{asset('assets/assets/img/mou/header.jpg')}}" style="width:100%;"></center></header>
    <footer><center><img src="{{asset('assets/assets/img/mou/footer.jpg')}}" style="width:100%;"></center></footer>
    <main>
        @if(isset($content) && !empty($content))

        <center>
            <h2><strong><u>ANNEXURE-1 </u></strong></h2>
            <br>
            <h2><strong><u>SCOPE OF SERVICES </u></strong></h2>
        </center>

        <p>
            First Party Agrees to provide:
        </p>

        <p>
            For the purpose of achieving the aforesaid target, First Party shall carry out the following activities: -
        </p>

        <br>
        <table class="table table-bordered" style="100%">
            <thead>
                <tr>
                    <th>PACKAGE NAME</th>
                    <th>PACKAGE PARTICULARS</th>
                    <th>DURATION</th>
                </tr>
            </thead>
            <tbody>
                @php($package = DB::table('products')->where('id',$package_id)->first())
                <tr>
                    <td>
                        <p>{{$package->product_name}}</p>
                    </td>
                    <td>
                        @php($getallpackage =explode(",",$package->product_features) )
                        @foreach($getallpackage as $pacck)
                        {{$pacck}}<br>
                        @endforeach
                    </td>
                    <td>
                        1 Year
                    </td>
                </tr>
            </tbody>

        </table>
       
          


        @endif
    </main>
  
</body>
</html>
