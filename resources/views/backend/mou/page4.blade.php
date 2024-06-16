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
            <h2><strong><u>ANNEXURE-2 </u></strong></h2>
            <h2><strong><u>PAYMENT TERMS AND SCHEDULE</u></strong></h2>
            <br>
           
            <p style="text-align: center;"><u>Details of Payment</u></p>
        </center>
        <br>
        <table class="table table-bordered" style="width:100%">
            <thead>
                <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Details of Payment</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php($package = DB::table('products')->where('id',$package_id)->first())
                    <tr>
                        <td>1.</td>
                        <td>Subscription of Package {{$package->product_name}} "{{$collegeName}}"</td>
                        <td>INR {{$product_cost}} (Including Taxes)</td>
                    </tr>
                    <tr>
                        <td colspan="2">Offer Deduction</td>
                        <td>INR {{$discount}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Total</td>
                        <td>INR {{ number_format((float)($product_cost-$discount), 2, '.', '')}} (Including Taxes)</td>
                    </tr>
                </tbody>
            </thead>
        </table>


        @endif
    </main>
  
</body>
</html>
