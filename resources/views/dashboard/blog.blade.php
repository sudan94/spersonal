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
                <table id="blogTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Date</th>
                            <th scope="col">status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <form action="/blog/insert" method="POST" id="blogform" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Title" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" id="category" placeholder="category" name="category" required>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="image">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="summernote">Description</label>
                            <textarea class="form-control" id="summernote" rows="3" name="description" required></textarea>
                        </div>
                    </div>
                    <button type="submit" form="blogform" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
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
                <form action="/blog/update" method="POST" id="editblogform">
                    {{ csrf_field() }}
                    <input type="hidden" name="blogId" id="blogId">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">Title</label>
                            <input type="text" name="edit_title" class="form-control" id="edit_title" placeholder="Title" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" id="edit_category" placeholder="category" name="edit_category" required>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="edit_image" aria-describedby="inputGroupFileAddon01" name="edit_image">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="summernote">Description</label>
                            <textarea class="form-control" id="summernote1" rows="3" name="edit_description" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="updateBlog()" value="Submit">Submit</button>
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
        $('#summernote').summernote({
            height: 300, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            // focus: true // set focus to editable area after initializing summernote
        });
        $('#blogTable').DataTable({
            "ajax": "/getblog",
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "title"
                },
                {
                    "data": "category"
                },
                {
                    "data": "date"
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
            "url": "/blog/status",
            "data": {
                "_token": "<?php echo csrf_token() ?>",
                "Id": id
            },
            success: function(data) {
                $("#skillTable").DataTable().ajax.reload();
            },
        });
    }

    function deleteBlog(id) {
        var result = confirm("Are you Sure want to delete?");
        if (result) {
            $.ajax({
                "method": "get",
                "url": "/blog/delete/" + id,
                "data": {
                    // "id": id
                },
                success: function(data) {
                    $("#skillTable").DataTable().ajax.reload();
                },
            });
        }
    }

    function editBlog(id) {
        $.ajax({
            "method": "get",
            "url": "/blog/edit/" + id,
            success: function(data) {
                var Data = JSON.parse(data);
                $("#edit_title").val(Data.title);
                $("#edit_category").val(Data.category);
                $("edit_image").val(Data.file);
                $("#summernote1").val(Data.description);
                $("#blogId").val(Data.id);
            }
        });
        $('#editModal').modal('show');
        // $('#summernote1').summernote({
        //     height: 300, // set editor height
        //     minHeight: null, // set minimum height of editor
        //     maxHeight: null, // set maximum height of editor
        //     // focus: true // set focus to editable area after initializing summernote
        // });
    }

    function updateBlog() {
        var title = $("#edit_title").val();
        var category = $("#edit_category").val();
        var file = $("#edit_image").val();
        var description = $("#summernote1").val();
        var id = $("#blogId").val();
        $.ajax({
            "method": "post",
            "url": "/blog/update/",
            "data": {
                "_token" : "<?php echo csrf_token(); ?>",
                "id": id,
                "title": title,
                "image": file,
                "category": category,
                "des": description
            },
            success: function(data) {
                $("#skillTable").DataTable().ajax.reload();
            }
        });
    }
</script>