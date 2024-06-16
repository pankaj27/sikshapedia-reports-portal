@extends('backend.layout.app')
@section('title','Dashboard | ncriptech website CMS')
@section('content')
<div class="mainCon">
                <div class="d-flex flex-md-row flex-sm-column  justify-content-md-between pb-4 ">
                <h2 class="heading">Welcom to <span>Sikshapedia Sales</span> Portal</h2>
                </div>
                <div class="dashboardNotiwrap">

                    <div class="dashboardNotification">
                        <h3>Call Register </h3>
                        <p>Add numbers to register new call</p>
                        <div>
                           <a href="{{route('call-register.list')}}"> <img src="{{asset('assets/assets/img/call.png')}}" alt=""></a>
                        </div>
                    </div>


                    <div class="dashboardNotification">
                        <h3>Appointments</h3>
                        <p>Add numbers to register new call</p>
                        <div>
                           <a href="{{route('book-appointment.list')}}"> <img src="{{asset('assets/assets/img/clock.png')}}" alt=""></a>
                        </div>
                    </div>


                    <div class="dashboardNotification">
                        <h3>Visit Report</h3>
                        <p>Add numbers to register new call</p>
                        <div>
                           <a href="{{route('visit-register.list')}}"> <img src="{{asset('assets/assets/img/file.png')}}" alt=""></a>
                        </div>
                    </div>
                    

                </div>
            </div>

@endsection