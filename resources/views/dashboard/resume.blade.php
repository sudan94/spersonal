@extends('dashboard.dashboard')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
<div id="msg" class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<div class="card">
    <div class="card-body">
        <div class="row">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#list" role="tab" aria-controls="profile" aria-selected="false">List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Add</a>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="profile-tab">
                <table class="table" id="resume">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Started</th>
                            <th scope="col">Ended</th>
                            <th scope="col">Institution</th>
                            <th scope="col">Description</th>
                            <th scope="col">Type</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                <form id="resumeform" action="/resume/insert" method="POST">
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
                            <input type="text" class="form-control" name="name" placeholder="Name of course or job position" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="started" id="started" data-select="datepicker" placeholder="Started Date" required>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="ended" id="ended" data-select="datepicker" placeholder="Ended Date" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" name="institution" class="form-control" placeholder="Company/Instituion" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <textarea class="form-control" name="description" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" form="resumeform" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for edit start -->
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Resume</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editresumeform">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="editid">
                    <div class="row">
                        <div class="col">
                            <select id="editType" class="custom-select custom-select-m mb-3" name="type" required>
                                <option>Type :</option>
                                <option value="0">Experiance</option>
                                <option value="1">Education</option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" id="editName" class="form-control" name="name" placeholder="Name of course or job position" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="date" class="form-control" name="editStarted" id="editStarted" data-select="datepicker" placeholder="Started Date" required>
                        </div>
                        <div class="col">
                            <input type="date" id="editEnded" class="form-control" name="editEnded" data-select="datepicker" placeholder="Ended Date" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="editIns" name="institution" class="form-control" placeholder="Company/Instituion" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <textarea class="form-control" id="editDes" name="description" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="updateResume()" value="Submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for edit end -->
<style>
    .row {
        margin-bottom: 10px;
    }
</style>
@endsection
@include('dashboard.footer')

<script>
    $(document).ready(function() {
        $('#resume').DataTable({
            "ajax": "/getresume",
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "started"
                },
                {
                    "data": "ended"
                },
                {
                    "data": "institution"
                },
                {
                    "data": "description"
                },
                {
                    "data": "type"
                },
                {
                    "data": "action"
                }
            ]
        });
        // time out 
        setTimeout(function() {
            $("#msg").remove();
        }, 2000); // 2 secs
        // date picker inside modal
        $(function() {
            $("body").delegate("#editStarted", "focusin", function() {
                $(this).datepicker();
            });
        });
    });

    function edit(id) {
        $.ajax({
            type: 'POST',
            url: '/resume/edit',
            data: {
                _token: '<?php echo csrf_token() ?>',
                Id: id
            },
            success: function(data) {
                var Data = JSON.parse(data);
                $("#editid").val(Data.id);
                $("#editType").val(Data.type);
                $("#editName").val(Data.name);
                $("#editStarted").val(Data.started);
                $("#editEnded").val(Data.ended);
                $("#editIns").val(Data.institution);
                $("#editDes").val(Data.description);
                $("#editModal").modal('show');
            }
        });
    }

    function updateResume() {
        // var value = $("#editresumeform").serializeArray();
        // var parse = JSON.parse(value);

        // console.log(parse);
        var id = $("#editid").val();
        var type = $("#editType").val();
        var name = $("#editName").val();
        var started = $("#editStarted").val();
        var ended = $("#editEnded").val();
        var ins = $("#editIns").val();
        var des = $("#editDes").val();
        $.ajax({
            type: 'POST',
            url: '/resume/update/',
            data: {
                _token: '<?php echo csrf_token() ?>',
                Id: id,
                Type: type,
                Name: name,
                Started: started,
                Ended: ended,
                Ins: ins,
                Des: des
            },
            success: function(data) {
                $("#editModal").modal('hide');
                $("#msg").html(data);
                $("#resume").DataTable().ajax.reload();
            }
        });
    }


    function deleteresume(id) {
        var result = confirm("Want to delete?");
        if (result) {
            $.ajax({
                type: 'POST',
                url: '/resume/delete/',
                data: {
                    _token: '<?php echo csrf_token() ?>',
                    Id: id

                },
                success: function(data) {
                    // console.log(data);
                    $("#msg").html(data);
                    $("#resume").DataTable().ajax.reload();
                }
            });
        }
    }
</script>