@extends('dashboard.master')
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
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Add</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <table id="skillTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Skill</th>
                            <th scope="col">percentage</th>
                            <th scope="col">status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <form action="/skill/insert" method="POST" id="skillform">
                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="skill">Skill</label>
                            <input type="text" name="skill" class="form-control" id="skill" placeholder=" Skill Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="percentage">Percentage</label>
                            <input type="number" class="form-control" id="Percentage" placeholder="Percentage" name="Percentage" required>
                        </div>
                    </div>
                    <button type="submit" form="skillform" class="btn btn-primary">Submit</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Skill</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/skill/insert" method="POST" id="editskillform">
                    {{ csrf_field() }}
                    <input type="hidden" name="skillId" id="skillId">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editskill">Skill</label>
                            <input type="text" name="editskill" class="form-control" id="editskill" placeholder=" Skill Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editPercentage">Percentage</label>
                            <input type="number" class="form-control" id="editPercentage" placeholder="Percentage" name="editPercentage" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="updateSkill()" value="Submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for edit end -->

@endsection
@include('dashboard.footer')
<script>
    $(document).ready(function() {
        $('#skillTable').DataTable({
            "ajax": "/getskills",
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "name"
                },
                {
                    "data": "percentage"
                },
                {
                    "data": "status"
                },
                {
                    "data": "action"
                }
            ]
        });
    });

    function status(id) {
        $.ajax({
            "method": "post",
            url: "/skill/status",
            "data": {
                "_token": '<?php echo csrf_token() ?>',
                "skillId": id
            },
            success: function(data) {
                $("#skillTable").DataTable().ajax.reload();
            }
        });
    }

    function deleteSkill(id) {
        var result = confirm("Are you Sure want to delete?");
        if (result) {
            $.ajax({
                "method": "post",
                "url": "/skill/delete",
                "data": {
                    "_token": '<?php echo csrf_token() ?>',
                    "skillId": id
                },
                success: function(data) {
                    $("#skillTable").DataTable().ajax.reload();
                }
            });
        }
    }

    function editSkill(id) {
        $.ajax({
            "method": "post",
            "url": "/skill/edit/" + id,
            "data": {
                "_token": "<?php echo csrf_token() ?>",
            },
            success: function(data) {
                var Data = JSON.parse(data);
                $("#editModal").modal('show');
                $("#editskill").val(Data.name);
                $("#editPercentage").val(Data.percentage);
                $("#skillId").val(Data.id);
            }
        });
    }

    function updateSkill() {
        var id = $("#skillId").val();
        var name = $("#editskill").val();
       
        var percentage = $("#editPercentage").val();
        $.ajax({
            "method": "post",
            "url": "skill/update",
            "data": {
                "_token": "<?php echo csrf_token() ?>",
                "Id": id,
                "Name": name,
                "per": percentage
            },
            success: function(data) {
                $("#skillTable").DataTable().ajax.reload();
                $("#editModal").modal('hide');
            },
        });
    }
</script>