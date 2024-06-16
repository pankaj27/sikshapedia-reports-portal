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
    body,h2{
      font-family:"Calibri", sans-serif;
    }
  </style>
</head>
<body>
  <img src="{{asset('assets/assets/img/proposal/page-5.jpg')}}" style="width:100%;height:100%">
  
  <div style="position:absolute;top:500px;left:120px; width:55%;font-size:20px;text-alignment:justify;">
    <p>
      The Complete Subscription for 1 Year(One Year) costs
    </p>

    <p>
      @php($f = new NumberFormatter("en", NumberFormatter::SPELLOUT))
			@php($tottyy = round($product_cost))

      <table>
        <tr>
          <td><strong>Subscription Cost</strong></td><td>:</td>
          <td style="text-align: right;"><strong>Rs.{{$product_cost}}</strong></td>
        </tr>
        @if($product_discount>0)
        <tr>
          <td><strong>Discount(if any)</strong></td><td>:</td>
          <td style="text-align: right;"><strong>Rs.{{$product_discount}}</strong></td>
        </tr>
        @endif

        <tr>
          <td><strong>GST(18%)</strong></td><td>:</td>
          <td style="text-align: right;"><strong>Rs.{{number_format((float)$gst_value, 2, '.', '');}}</strong></td>
        </tr>

        <tr>
          <td><strong>Total Cost</strong></td><td>:</td>
          <td style="text-align: right;"><strong>Rs.{{number_format((float)$total_cost, 2, '.', '');}}</strong></td>
        </tr>
        <tr>
         <td colspan="3"><strong>Amount in Words: ({{ucwords($cost_in_words)}} Only) </strong></td>
        </tr>
      </table>
			
      
    </p>

    <p>
      <h2><u>Payment Schedule ({{$payment_option}})</u></h2>
      
      @php($terms = explode(',',$product_terms))
      @foreach($terms as $trmm)

        {{$trmm}}
        <br>
      @endforeach
      
      
    </p>
    <p><b style="color:#ea5c39">Proposal Valid Upto: {{date('M d, Y', strtotime($product_proposal))}}</b></p>
    <p><b>Date:{{date('d/m/Y h:i:s A')}}</b></p>
    <p><b style="color:#ea5c39">* 2(Two) Installment should be paid with in 15 days</b></p>

  </div>
</body>
</html>
