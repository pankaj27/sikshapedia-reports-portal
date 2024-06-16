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

        <p>
            <strong>Terms and Conditions:   
            </strong>
            @php($terms = DB::table('memorandum_of_understandings')->where('key','Terms And Conditions:')->first())
            @php($termcontent = json_decode($terms->value))
            @php($sl=1)
            @foreach($termcontent as $conn)
            <p style="left:290px;text-align:justify;">
                {{$sl}}.{!! $conn !!}
            </p>

            @php($sl++)

            @endforeach

        </p>
        <br>
        <p>
            <strong>Payment Terms: 
            </strong>
            @php($pp = DB::table('product_costs')->where('id',$payment_option_id)->first())
            <b style="color:red">Duration: {{$pp->instalment_duration}} {{$pp->duration_unit}}</b>

        </p>
        <br>
        
        

        @endif
    </main>
  
</body>
</html>
