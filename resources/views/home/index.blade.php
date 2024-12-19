@extends('home.app')
@section('content')
@if(session('message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="bg landing-background">
    <h3 class="fw-bold" style="position: relative">Luyện tập trắc nghiệm</h3>
    <a href="/categories" class="btn btn-outline-success" style="position: relative">Khám phá ngay</a>
</div>
{{-- <div class="container">
    <div class="row">
        <div class="col">
            <div class="test py-5 text-center">
                <h1 class="section-heading">Limitless ABC</h1>
                <p>Phasellus sed nisi ac dui interdum semper. Etiam consequat fermentum sollicitudin. Fusce vulputate porta faucibus. Vivamus nulla tellus, accumsan non efficitur id, pretium quis ante</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 d-flex justify-content-center">
            <div class="card box-shadow" style="width: 18rem;">
                <a href="" class="text-reset text-decoration-none text-center">
                    <img src="https://nsm09.casimages.com/img/2021/06/26//21062602461725998217475200.jpg" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title">Card title</h5>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,192L48,197.3C96,203,192,213,288,192C384,171,480,117,576,90.7C672,64,768,64,864,85.3C960,107,1056,149,1152,186.7C1248,224,1344,256,1392,272L1440,288L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                </a>
            </div>
        </div>
        <div class="col-lg-4 d-flex justify-content-center">
            <div class="card box-shadow" style="width: 18rem;">
                <a href="" class="text-reset text-decoration-none text-center">
                    <img src="https://nsm09.casimages.com/img/2021/06/26//21062602461725998217475200.jpg" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title">Card title</h5>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,192L48,197.3C96,203,192,213,288,192C384,171,480,117,576,90.7C672,64,768,64,864,85.3C960,107,1056,149,1152,186.7C1248,224,1344,256,1392,272L1440,288L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                </a>
            </div>
        </div>
        <div class="col-lg-4 d-flex justify-content-center">
            <div class="card box-shadow" style="width: 18rem;">
                <a href="" class="text-reset text-decoration-none text-center">
                    <img src="https://nsm09.casimages.com/img/2021/06/26//21062602461725998217475200.jpg" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title">Card title</h5>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,192L48,197.3C96,203,192,213,288,192C384,171,480,117,576,90.7C672,64,768,64,864,85.3C960,107,1056,149,1152,186.7C1248,224,1344,256,1392,272L1440,288L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="test py-5 text-center">
                <h1 class="section-heading">Limitless ABC</h1>
                <p>Phasellus sed nisi ac dui interdum semper. Etiam consequat fermentum sollicitudin. Fusce vulputate porta faucibus. Vivamus nulla tellus, accumsan non efficitur id, pretium quis ante</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <img class="side-image rounded" src="https://cdn.pixabay.com/photo/2021/02/03/05/37/question-mark-5976736_1280.png" alt="">
        </div>
        <div class="col-6 text-center align-self-center">
            <h1>Play Quiz Now</h1>
            <p>Phasellus sed nisi ac dui interdum semper. Etiam consequat fermentum sollicitudin. Fusce vulputate porta faucibus. Vivamus nulla tellus, accumsan non efficitur id, pretium quis ante</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="py-5 text-center">
                <h1 class="section-heading">Limitless Options</h1>
                <p>Phasellus sed nisi ac dui interdum semper. Etiam consequat fermentum sollicitudin. Fusce vulputate porta faucibus. Vivamus nulla tellus, accumsan non efficitur id, pretium quis ante</p>
            </div>
        </div>
    </div>
    <div class="row pb-5">
        <div class="col-6 text-center align-self-center">
            <h1>Play Quiz Now</h1>
            <p>Phasellus sed nisi ac dui interdum semper. Etiam consequat fermentum sollicitudin. Fusce vulputate porta faucibus. Vivamus nulla tellus, accumsan non efficitur id, pretium quis ante</p>
        </div>
        <div class="col-6">
            <img class="side-image rounded" src="https://cdn.pixabay.com/photo/2021/02/03/05/37/question-mark-5976736_1280.png" alt="">
        </div>
    </div>
</div> --}}
@endsection


