<!DOCTYPE html>
<html lang="en">
<head>
  <title>BILL </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

  <img src="{{asset('assets/assets/img/bills/sample-bill.jpg')}}" style="width:100%;height:100%">

  <div style="position:absolute;top:85px;right:80px;font-size:20px;text-alignment:justify;">
    <p>
      <strong>{{$inv_no}}</strong>
    </p>
 </div>
 <div style="position:absolute;top:195px;left:300px;font-size:20px;text-alignment:justify;">
  <p style="font-size:21px;">
    
    {{$institute_name}}
  </p>
</div>

<div style="position:absolute;top:240px;left:120px;font-size:20px;text-alignment:justify;">
  <p style="font-size:21px;">
   
    {{$amout_paid}}
  </p>
</div>

<div style="position:absolute;top:240px;left:400px;font-size:20px;text-alignment:justify;">
  <p style="font-size:20px;">
    
    {{$amount_paid_text}}
  </p>
</div>

<div style="position:absolute;top:295px;right:150px;font-size:20px;text-alignment:justify;">
  <p style="font-size:20px;">
    
    {{$tranaction_date}}
  </p>
</div>

<div style="position:absolute;top:348px;left:175px;font-size:20px;text-alignment:justify;">
  <p style="font-size:21px;">
    
    {{$transaction_no}}
  </p>
</div>

<div style="position:absolute;top:398px;left:135px;font-size:20px;text-alignment:justify;">
  <p style="font-size:21px;">
    
    {{$Reg_txt}}
  </p>
</div>

<div style="position:absolute;top:500px;left:140px;font-size:20px;text-alignment:justify;">
  <p style="font-size:28px;">
   
    <strong style="color:#000">{{$amnttct}}</strong>
  </p>
</div>



<!--------------------- SECOND PAGE ------------------------->
<!--<div style="position:absolute;top:835px;right:80px;font-size:20px;text-alignment:justify;">
  <p>
    <strong>{{$inv_no}}</strong>
  </p>
</div>

<div style="position:absolute;top:945px;left:300px;font-size:20px;text-alignment:justify;">
  <p style="font-size:21px;">
    @php($txt ="ABCDEF ABCDEFABCDEF ABCDEFABCDEF ")
    {{$institute_name}}
  </p>
</div>

<div style="position:absolute;top:990px;left:120px;font-size:20px;text-alignment:justify;">
  <p style="font-size:21px;">
    
    {{$amout_paid}}
  </p>
</div>


<div style="position:absolute;top:990px;left:400px;font-size:20px;text-alignment:justify;">
  <p style="font-size:20px;">
    {{$amount_paid_text}}
  </p>
</div>

<div style="position:absolute;top:1045px;right:150px;font-size:20px;text-alignment:justify;">
  <p style="font-size:20px;">
    {{$tranaction_date}}
  </p>
</div>

<div style="position:absolute;top:1093px;left:175px;font-size:20px;text-alignment:justify;">
  <p style="font-size:21px;">
    {{$transaction_no}}
  </p>
</div>

<div style="position:absolute;top:1143px;left:135px;font-size:20px;text-alignment:justify;">
  <p style="font-size:21px;">
    {{$Reg_txt}}
  </p>
</div>

<div style="position:absolute;top:1250px;left:140px;font-size:20px;text-alignment:justify;">
  <p style="font-size:28px;">
    <strong style="color:#000">{{$amnttct}}</strong>
  </p>
</div>-->



</body>
</html>
