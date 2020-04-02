@extends('dashboard.dashboard')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#list" role="tab"
                           aria-controls="profile" aria-selected="false">List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab"
                           aria-controls="home" aria-selected="true">Add</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($resume as $resumes)

                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{$resumes->name}}</td>
                                <td></td>
                                <td>@mdo</td>
                            </tr>
                            @php($i++)
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form id="resume" action="/resume/insert" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col">
                                <select class="custom-select custom-select-m mb-3" name="type" required>
                                    <option>Type :</option>
                                    <option value="0">Experiance</option>
                                    <option value="1">Education</option>
                                </select>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="name"
                                       placeholder="Name of course or job position" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="started" id="started"
                                       data-select="datepicker"
                                       placeholder="Started Date" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="ended" id="ended" data-select="datepicker"
                                       placeholder="Ended Date" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="institution" class="form-control"
                                       placeholder="Company/Instituion" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <textarea class="form-control" name="description" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" form="resume" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .row {
            margin-bottom: 10px;
        }
    </style>
@endsection
