@extends('client.master')

@section('css')
<style>
    .select-bar{
        display: none!important;
    }
    .dropdown{
        display: block!important;
    }
</style>
@endsection

@section('content')
<section class="breadcrumbs py-4">
    <div class="container-fluid px-5">
        <h6><a href="{{route('about')}}">About Us</a><i class="fas red mx-2 fa-chevron-right"></i>Services</h6>
    </div>
</section>

<section class="service-details py-5 bg-light">
    <div class="container">
        <h2 class="font-weight-bold span1 text-center">OFFERING THE <span class="red">BEST</span> SERVICE</h2>
        <div class="img-box my-5">
            <img src="pics/service01.jpeg">
            <i class="fas fa-tools"></i>
        </div>
        <div class="row">
            <div class="col-lg-5 my-2">
                <div class="left py-5 px-4">
                    <small class="text-muted mb-2 d-block">What We Provide</small>
                    <h3 class="span1 font-weight-bold mb-5">SERVICE <span class="red">FEATURES</span></h3>
                    <div class="feature-wrap d-flex align-items-center my-4">
                        <div class="icon mr-4">
                            <i class="fab fa-linux"></i>
                        </div>
                        <div class="icon-text">
                            <h5 class="span mb-3"><span class="span1">SUCCESSFUL</span> PROJECTS</h5>
                            <p class="text-muted">Aonsectetur pisici do eiusmod tempor em Ipsum is simply dummy text printing.</p>
                        </div>
                    </div>
                    <div class="feature-wrap d-flex align-items-center my-4">
                        <div class="icon mr-4">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="icon-text">
                            <h5 class="span mb-3"><span class="span1">SEO</span> OPTIMIZED</h5>
                            <p class="text-muted">Aonsectetur pisici do eiusmod tempor em Ipsum is simply dummy text printing.</p>
                        </div>
                    </div>
                    <div class="feature-wrap d-flex align-items-center my-4">
                        <div class="icon mr-4">
                            <i class="fas fa-headphones-alt"></i>
                        </div>
                        <div class="icon-text">
                            <h5 class="span mb-3"><span class="span1">PAGE</span> BUILDER</h5>
                            <p class="text-muted">Aonsectetur pisici do eiusmod tempor em Ipsum is simply dummy text printing.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 my-2 pl-5 right">
                <h6>Quis autem velum iure reprehe nderit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sapien neque, bibendum in sagittis. Duis varius tellus egetmassa pulvinar eu aliquet nibh dapibus.<br><br>  
                      Quis autem velum iure reprehe nderit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sapien neque, bibendum in sagittis. Duisvarius tellus egetmassa pulvinar eu aliquet nibh dapibus. Aenean eros erat, tincidunt vitae fringila nec, fermentum et quam. Class aptent tacitsocio squ ad litora torquent peribia nostra, per inceptos himenaeos. Aenean eros erat, tincidunt vitae fringilla nec, fermentum et quam. Quisautem velum iure reprehe nderit. Lorem ipsum </h6>
                <div class="row no-gutters mt-5">
                    <div class="col-lg-5 image">
                        <a data-lightbox="service" href="pics/service-bg.jpeg" ><img src="pics/service-bg.jpeg"></a>
                        <a data-lightbox="serv" href="pics/service-bg.jpeg" ><i class="fas fa-search-plus"></i></a>
                    </div>
                    <div class="col-lg-7 image">
                        <a data-lightbox="service" href="pics/service02.jpeg"><img src="pics/service02.jpeg"></a>
                        <a data-lightbox="serv" href="pics/service02.jpeg"><i class="fas fa-search-plus"></i></a>
                    </div>
                    <div class="col-lg-7 image">
                        <a data-lightbox="service" href="pics/service03.jpeg"><img src="pics/service03.jpeg"></a>
                        <a data-lightbox="serv" href="pics/service03.jpeg"><i class="fas fa-search-plus"></i></a>
                    </div>
                    <div class="col-lg-5 image">
                        <a data-lightbox="service" href="pics/service04.jpeg"><img src="pics/service04.jpeg"></a>
                        <a data-lightbox="serv" href="pics/service04.jpeg"><i class="fas fa-search-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection