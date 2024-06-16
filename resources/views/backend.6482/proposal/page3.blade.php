<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    body{
      font-family:"Calibri", sans-serif;
    }
  </style>
</head>
<body>
  <img src="{{asset('assets/assets/img/proposal/page-3.jpg')}}" style="width:100%;">
  <div style="position:absolute;top:420px;left:65px; width:55%;font-size:20px;text-alignment:justify;">
    <p style="text-align: justify;">
          
      While registering with <strong>Sikshapedia</strong>, every college, 
      universities get vast facilities like banner advertisement, 
      traffic boosting to their website, mobile application, 
      advertisement on social media platform, content 
      marketing, review facilities and many more. These services 
      will help colleges and universities to target their audience in 
      a specific manner and will help them to engage in the 
      edtech market aggressively.
      
    </p>
    <p style="text-align: justify;">
      Registering colleges and universities on <strong>Sikshapedia</strong> also 
      offers several benefits for educational institutions, 
      students, and the broader academic community. Here are 
      some of the key advantages: 
    </p>
    <h3>{{$product_name}}</h3>
    <ol>
      @php($prodtgg = explode(",",$product_features))
      @foreach($prodtgg as $features)
      <li>{{strtoupper($features)}}</li>
      @endforeach
    </ol>
    

  </div>
  
</body>
</html>
