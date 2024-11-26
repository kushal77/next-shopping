@extends('client.master')

@section('content')
    <style>
        .select-bar{
            display: none!important;
        }
        .dropdown{
            display: block!important;
        }
    </style>


    <section class="about-us py-5 d-flex justify-content-between align-items-center flex-column">
        <div class="bread text-white align-self-top">
            <h1 class="font-weight-bold cav">About Us</h1>
        </div>
        <div class="container-fluid text-center py-4">
            <h1 class="font-weight-bold display-4 mb-2 cav">Delivering Happiness On The Go !!</h1>
            <h1 class="font-weight-bold happy">HAPPY SHOPPING</h1>
        </div>
    </section>


    <section class="our-story py-5">
        <div class="container story text-center">
            <h1 class="font-weight-bold cav">Our Story</h1>
            <div class="row">
                <div class="col-lg-6 py-5 story-content">
                    <p>HiTech has a wide range of domain specific application software that provides efficient and effective management of operations. These applications have powerful features to take care of all requirements of Dealers, Distributors, Retailers, Departmental Stores, Corporate House, Restaurant, Couriers, Transport, Service Industry as well as Complex Manufacturing Industry including all types of medium and small business segment.</p><br>
                    <p>HiTech Solutions and Services Pvt. Ltd. is one of the premier business software solution providers in Nepal with its corporate office located at Kalimati, Kathmandu (Nepal). Promoted by professionals with more than a decade experience in accounting, </p>
                </div>
                <div class="col-lg-6 py-5 story-content">
                    <p>HiTech has a wide range of domain specific application software that provides efficient and effective management of operations. These applications have powerful features to take care of all requirements of Dealers, Distributors, Retailers, Departmental Stores, Corporate House, Restaurant, Couriers, Transport, Service Industry as well as Complex Manufacturing Industry including all types of medium and small business segment.</p><br>
                    <p>HiTech Solutions and Services Pvt. Ltd. is one of the premier business software solution providers in Nepal with its corporate office located at Kalimati, Kathmandu (Nepal). Promoted by professionals with more than a decade experience in accounting, </p>
                </div>
            </div>
        </div>
    </section>

    <section class="our-values py-5">
        <div class="container value text-center">
            <h1 class="font-weight-bold cav">Our Values</h1>
            <div class="row mt-3">
                <div class="col-lg-6 py-5 value-image">
                    <img src="pics/value-img.jpg" alt="#" class="img-fluid">
                </div>
                <div class="col-lg-6 py-5 value-content">
                    <ul class="list-unstyled px-4">
                        <li>More than 15 years Experience in IT Products Services</li>
                        <li>More than 1500 Satisfied Clients all over  Nepal</li>
                        <li>Providing service to almost all Corporate Houses in Nepal</li>
                        <li>Widest Support Network in Nepal, Offices in all Major Cities of Nepal.</li>
                        <li>Scientifically designed workspace with full Support Services</li>
                        <li>Team of Qualified and Skilled Software and Hardware Professionals</li>
                        <li>Proper Office Management System to provide quality Products and Services</li>
                        <li>We believe in giving the best to our customers, sellers & society.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    </div>
    <section class="our-values py-5">
        <div class="container value text-center">
            <h1 class="font-weight-bold cav">Goals & Objectives</h1>
            <div class="row mt-3">
                <div class="col-lg-6 py-5 value-content">
                    <ul class="list-unstyled px-4">
                        <li>More than 15 years Experience in IT Products Services</li>
                        <li>More than 1500 Satisfied Clients all over  Nepal</li>
                        <li>Providing service to almost all Corporate Houses in Nepal</li>
                        <li>Widest Support Network in Nepal, Offices in all Major Cities of Nepal.</li>
                        <li>Scientifically designed workspace with full Support Services</li>
                        <li>Team of Qualified and Skilled Software and Hardware Professionals</li>
                        <li>Proper Office Management System to provide quality Products and Services</li>
                        <li>We believe in giving the best to our customers, sellers & society.</li>
                    </ul>
                </div>
                <div class="col-lg-6 py-5 value-image">
                    <img src="pics/our-goal.jpg" alt="#" class="img-fluid goal-img">
                </div>
            </div>
        </div>
    </section>

    <section class="around py-5">
        <div class="container py-5 text-white text-center d-flex justify-content-end">
            <h1 class="font-weight-bold cav display-4">5 Countries, <br>Milions Of Products</h1>
        </div>
    </section>
@endsection