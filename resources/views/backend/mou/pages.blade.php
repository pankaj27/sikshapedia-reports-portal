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
            <h2><strong><u>Memorandum of Understanding </u></strong></h2>
        </center>

       
            @php($memo = DB::table('memorandum_of_understandings')->where('key','Memorandum Of Understanding')->first())
            @php($content1 = json_decode($memo->value)[0])
            @php($final_content = str_replace("{mouStartDate}", $mouStartdate, $content1))
            
            <p>
            
                {!! $final_content !!}

            

            </p>

            <br>

            <center>
                <h3><strong>BY AND BETWEEN </strong></h3>
            </center>
            @php($memo = DB::table('memorandum_of_understandings')->where('key','BY AND BETWEEN')->first())
            @php($content1 = json_decode($memo->value)[0])
            
            <p>
            
                {{$content1}}

            

            </p>

            <br>

            <center>
                <h3><strong>AND </strong></h3>
            </center>
            @php($memo = DB::table('memorandum_of_understandings')->where('key','ANDT')->first())
            @php($content1 = json_decode($memo->value)[0])
            @php($final_content1 = str_replace("{collegeName}", "<strong>$collegeName</strong>", $content1))
            @php($final_content2 = str_replace("{collegeAddress}", "<strong>$collegeAddress</strong>", $final_content1))
            @php($final_content3 = str_replace("{collegeAdmin}", "<strong>$collegeAdmin</strong>", $final_content2))
            @php($final_content4 = str_replace("{panNo}", "<strong>$panNo</strong>", $final_content3))
            
            <p>
            
                {!! $final_content4 !!}

            

            </p>

            <br>

            <center>
                <h3><strong>FOR THE PURPOSE OF  </strong></h3>
            </center>

            @php($memo = DB::table('memorandum_of_understandings')->where('key','FOR THE PURPOSE OF')->first())
            @php($content1 = json_decode($memo->value)[0])
            @php($content2 = json_decode($memo->value)[1])
            <p>
            
                {!! $content1 !!}

            

            </p>

            <p>
            
                <strong>{!! $content2 !!}</strong>

            

            </p>
            <p>
                <strong>1. Term of the Agreement. 
                </strong>
                @php($terms = DB::table('memorandum_of_understandings')->where('key','Term Of The Agreement.')->first())
                @php($termcontent = json_decode($terms->value))
                @foreach($termcontent as $conn)
                @php($conn = str_replace("{mouValidUpto}", "<span style='color:red;'>$mouValidUpto</span> ", $conn) )
                <p style="left:290px;text-align:justify;">
                    {!! $conn !!}
                </p>

                @endforeach

            </p>

            <p>
                <strong>2.Scope of Services 
                </strong>
                @php($terms = DB::table('memorandum_of_understandings')->where('key','Scope Of Services')->first())
                @php($termcontent = json_decode($terms->value))
                @php($sl=1)
                @foreach($termcontent as $conn)
                <p style="left:290px;text-align:justify;">
                    {{ $sl}}. {!! $conn !!}
                </p>

                @php($sl++)

                @endforeach

            </p>


            <p>
                <strong>3.Pricing & Payments:  
                </strong>
                @php($terms = DB::table('memorandum_of_understandings')->where('key','Pricing & Payments')->first())
                @php($termcontent = json_decode($terms->value))
                @php($sl=1)
                @foreach($termcontent as $conn)
                <p style="left:290px;text-align:justify;">
                    {{ $sl}}. {!! $conn !!}
                </p>

                @php($sl++)

                @endforeach

            </p>
            <br>
            <center>
                <h3><u>Banking Details of First Party</u></h3>
            </center>
            <table class="table-bordered table-striped" style="width:100%;">
                <tbody>
                    
                

                    <tr>
                        @php($bankdetails = DB::table('memorandum_of_understandings')->where('key','Account Holder')->first())
                        @php($bankdetailscont = json_decode($bankdetails->value)[0])


                        <td><strong>Account Holder</strong></td>
                        <td>{!! $bankdetailscont !!}</td>
                    </tr>

                    <tr>
                        @php($bankdetails = DB::table('memorandum_of_understandings')->where('key','Account Number')->first())
                        @php($bankdetailscont = json_decode($bankdetails->value)[0])


                        <td><strong>Account Number</strong></td>
                        <td>{!! $bankdetailscont !!}</td>
                    </tr>

                    <tr>
                        @php($bankdetails = DB::table('memorandum_of_understandings')->where('key','Bank Name')->first())
                        @php($bankdetailscont = json_decode($bankdetails->value)[0])


                        <td><strong>Bank Name</strong></td>
                        <td>{!! $bankdetailscont !!}</td>
                    </tr>

                    <tr>
                        @php($bankdetails = DB::table('memorandum_of_understandings')->where('key','IFSC Code')->first())
                        @php($bankdetailscont = json_decode($bankdetails->value)[0])


                        <td><strong>IFSC Code</strong></td>
                        <td>{!! $bankdetailscont !!}</td>
                    </tr>

                    <tr>
                        @php($bankdetails = DB::table('memorandum_of_understandings')->where('key','PAN No')->first())
                        @php($bankdetailscont = json_decode($bankdetails->value)[0])


                        <td><strong>PAN No</strong></td>
                        <td>{!! $bankdetailscont !!}</td>
                    </tr>

                </tbody>
                
            </table>

            <br>

            <p>
                <strong>4.Termination of MoU:  
                </strong>
                @php($terms = DB::table('memorandum_of_understandings')->where('key','Termination Of MoU:')->first())
                @php($termcontent = json_decode($terms->value))
                @php($sl=1)
                @foreach($termcontent as $conn)
                <p style="left:290px;text-align:justify;">
                    {{ $sl}}. {!! $conn !!}
                </p>

                @php($sl++)

                @endforeach

            </p>

            <br>
            <br>
            <br>

            <p>
                <strong>5.Point of Contact :  
                </strong>
                <br>
                Point of contact from first party shall be as follows
                <table class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Email Id</th>
                            <th>Mobile No</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($first_part_contract as $pp)
                        
                        <tr>
                            <td>{{$pp->name}}</td>
                            <td>{{$pp->designation}}</td>
                            <td>{{$pp->email_id}}</td>
                            <td>{{$pp->mobile_no}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <br>
                <p>
                    Point of contact from second party shall be as follows:
                </p>
                
                <br>

                <table class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Email Id</th>
                            <th>Mobile No</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($second_part_contract as $pp)
                        
                        <tr>
                            <td>{{$pp->name}}</td>
                            <td>{{$pp->designation}}</td>
                            <td>{{$pp->email_id}}</td>
                            <td>{{$pp->mobile_no}}</td>

                        </tr>
                        @endforeach

                        
                    </tbody>
                </table>

                <br>
                <p>
                    For the escalations purpose, either parties can mail/write to the above point of contacts, and the party shall respond within 24 hours.  
               </p>

            </p>

            <br>
            <p>
                <strong>6.Arbitration:   
                </strong>
                @php($terms = DB::table('memorandum_of_understandings')->where('key','Arbitration:')->first())
                @php($termcontent = json_decode($terms->value))
                @php($sl=1)
                @foreach($termcontent as $conn)
                <p style="left:290px;text-align:justify;">
                     {!! $conn !!}
                </p>

                @php($sl++)

                @endforeach

            </p>

            <br>
            <p>
                <strong>7.Intellectual Property Rights:   
                </strong>
                @php($terms = DB::table('memorandum_of_understandings')->where('key','Intellectual Property Rights:')->first())
                @php($termcontent = json_decode($terms->value))
                @php($sl=1)
                @foreach($termcontent as $conn)
                <p style="left:290px;text-align:justify;">
                    {{ $sl}}. {!! $conn !!}
                </p>

                @php($sl++)

                @endforeach

            </p>

            <br>
            <p>
                <strong>8.Confidentiality:   
                </strong>
                @php($terms = DB::table('memorandum_of_understandings')->where('key','Confidentiality:')->first())
                @php($termcontent = json_decode($terms->value))
                @php($sl=1)
                @foreach($termcontent as $conn)
                <p style="left:290px;text-align:justify;">
                    {{ $sl}}. {!! $conn !!}
                </p>

                @php($sl++)

                @endforeach

            </p>


            <br>
            <p>
                <strong>9.Indemnity:   
                </strong>
                @php($terms = DB::table('memorandum_of_understandings')->where('key','Indemnity:')->first())
                @php($termcontent = json_decode($terms->value))
                @php($sl=1)
                @foreach($termcontent as $conn)
                <p style="left:290px;text-align:justify;">
                    {!! $conn !!}
                </p>

                @php($sl++)

                @endforeach

            </p>

            <br>
            <p>
                <strong>10.Force Majeure:   
                </strong>
                @php($terms = DB::table('memorandum_of_understandings')->where('key','Force Majeure:')->first())
                @php($termcontent = json_decode($terms->value))
                @php($sl=1)
                @foreach($termcontent as $conn)
                <p style="left:290px;text-align:justify;">
                    {!! $conn !!}
                </p>

                @php($sl++)

                @endforeach

            </p>
            <br>
            <table>
                <tr>
                    <td style="width:50%">
                        <p>Authorised Signatories:</p>
                    </td>
                    <td style="width:50%">
                        <p>Authorised Signatories:</p>
                    </td>
                </tr>
                <tr>
                    <td style="width:50%"><img src="{{asset('assets/assets/img/mou/sign-sks.png')}}" style="height:150px;">
                        <br>
                        <p>For Sikshapedia Global LLP <br>(First Party)
                        </p>
                    </td>
                    <td style="width:50%"><img src="{{asset('assets/assets/img/mou/sign-sample.png')}}" style="height:150px;">
                        <br>
                        <p>For, {{$collegeName}}
                            <br>(Second Party)
                            
                        </p>
                   </td>
                </tr>
                
                <tr>
                    <td style="width:50%">
                        <table>
                            <tr>
                                <td>Name:</td>
                                <td>Nirmalendu Sarkar</td>
                            </tr>
                            <tr>
                                <td>Designation:</td>
                                <td>Area Manager</td>
                            </tr>
                            <tr>
                                <td>Date:</td>
                                <td>{{date('d F, Y')}}</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width:50%">
                        <table>
                            <tr>
                                <td>Name:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Designation:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Date:</td>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            


        @endif
    </main>
  
</body>
</html>
