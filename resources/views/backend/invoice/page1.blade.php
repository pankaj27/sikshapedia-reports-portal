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
    @page { margin: 5px 5px; }
  </style>
  <style>
    
    tr {
        height: 200px;
    }
</style>
</head>
<body>
    <img src="{{asset('assets/assets/img/invoice/inv.png')}}" style="position: absolute;top:10px;left:10px;width:100%;height:100%">
    <div style="position:absolute;top:355px;left:760px;font-size:18px;text-alignment:justify;">
        <p style="text-align: left;">
          SIK/2024-2025/{{rand(1000,9999)}}
        </p>
     </div>
     <div style="position:absolute;top:385px;left:760px;font-size:18px;text-alignment:justify;">
        <p style="text-align: left;">
           {{$account_name}}
        </p>
     </div>

     <div style="position:absolute;top:415px;left:760px;font-size:18px;text-alignment:justify;">
        <p style="text-align: left;">
            {{date('d.m.Y')}}
        </p>
     </div>

     <div style="position:absolute;top:385px;left:130px;font-size:15px;text-alignment:justify;">
        <p>
            <strong>{{$account_name}}</strong>
        </p>
        <p>
            {{$college_address}}
        </p>
     </div>
     <br>
     <table style="position:absolute;left:10%;top:470px;font-size:25px;text-alignment:justify;width:85%;">
        
            <thead style="background-color: #ea7031;color:white;text-align:center;">
                <tr style="height:80px;text-align:center;">
                    <th> &nbsp;SL. NO</th>
                    <th>DESCRIPTION</th>
                    <th>PRICE</th>
                    <th>QTY</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
       <tbody>
        @php($totlalpric=DB::table('mou_sents')->where('id',$mou_id)->first())
        @php($paymentt = DB::table('product_costs')->where('id',$totlalpric->payment_option)->first())
        <tr style="background-color:#d9d9d9;font-size:25px;height:50px;">
            <td>&nbsp;1</td>
            <td>{{$descc}}</td>
            <td>{{$totlalpric->total_cose}}</td>
            <td>1</td>
            <td>{{$totlalpric->total_cose}}</td>
        </tr>
        <tr ><td colspan="5"></td></tr>
        <tr style="background-color:#f1f1f1;font-size:25px;height:50px;">
            <td></td>
            <td>{{$extra_desc}}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr ><td colspan="5"></td></tr>
        <tr style="background-color:#d9d9d9;font-size:25px;height:50px;">
            <td colspan="5">&nbsp;</td>
        </tr>
        <tr style="background-color:#f1f1f1;font-size:25px;height:50px;">
            <td colspan="5">&nbsp;</td>
        </tr>
       </tbody>
        
     </table>
     <div style="position:absolute;top:770px;right:110px;font-size:20px;text-alignment:justify;">
        
        <p>
            {{$totlalpric->total_cose}}
        </p>
     </div>
     <div style="position:absolute;top:790px;right:110px;font-size:20px;text-alignment:justify;">
        
        <p>
           0.00
        </p>
     </div>
     <div style="position:absolute;top:880px;right:130px;font-size:30px;text-alignment:justify;">
        
        <p>
            <strong>{{$totlalpric->total_cose}}</strong>
        </p>
     </div>


</body>
</html>
