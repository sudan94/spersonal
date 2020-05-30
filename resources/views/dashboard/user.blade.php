@extends('dashboard/master')
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Credintials</th>
                    <th scope="col">value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Name</td>
                    <td>{{$user->name}}</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Email</td>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Image</td>
                    <td><img class="img-fluid" alt="Responsive image" style="height:80px;width:80px;"src="{{asset('/uploads/user/'.$user->image.'')}}"></img></td>
                    <td>
                        <form method="POST" id="imageform" enctype="multipart/form-data" action="/user/image">
                        {{csrf_field() }}
                            <input type="file" id="fileToUpload" name="image">
                            <input type="submit" value="Upload Image" form="imageform" name="submit">
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection