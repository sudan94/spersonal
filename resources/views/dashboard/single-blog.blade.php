@extends('dashboard.master')
@section('content')

<div class="blog-page" data-simplebar>
    <div class="blog-image">
        <img src="{{asset('/uploads/'.$blog->file.'')}}" alt="blog-image" class="img-fluid">
    </div>
    <div class="row blog-container">
        <div class="col-md-10 offset-md-1">

            <!-- Heading -->
            <div class="blog-heading pt-70 pb-100">
                <h2>{{$blog->title}}</h2>
                <span><i class="fas fa-home"></i><a href="#">{{$blog->category}}</a></span>
                <span><i class="fas fa-comment"></i><a href="#">5 comments</a></span>
                <span><i class="fas fa-calendar-alt"></i>{{$blog->date}}</span>
            </div>

            <!-- Content -->
            <div class="blog-content">
                <p>{{$blog->description}}</p>
            </div>
        </div>
    </div>
</div>
@endsection