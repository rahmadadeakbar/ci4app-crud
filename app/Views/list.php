<!DOCTYPE html>
<html lang="en">

<head>
    <title>Codeigniter 4 CRUD Operation With Ajax Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-11">
                <h2>Codeigniter 4 Ajax CRUD Example</h2>
            </div>
            <div class="col-lg-1">
                <a class="btn btn-success" href="#" data-toggle="modal" data-target="#addModal">Add</a>
            </div>
        </div>

        <table class="table table-bordered" id="studentTable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($students_detail as $row) {
                ?>
                    <tr id="<?php echo $row['id']; ?>">
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td>
                            <a data-id="<?php echo $row['id']; ?>" class="btn btn-primary btnEdit">Edit</a>
                            <a data-id="<?php echo $row['id']; ?>" class="btn btn-danger btnDelete">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <!-- Add Student Modal -->
        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- User Student content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add New Student</h4>
                    </div>
                    <div class="modal-body">
                        <form id="addStudent" name="addStudent" action="<?php echo site_url('student/store'); ?>" method="post">
                            <div class="form-group">
                                <label for="txtFirstName">First Name:</label>
                                <input type="text" class="form-control" id="txtFirstName" placeholder="Enter First Name" name="txtFirstName">
                            </div>
                            <div class="form-group">
                                <label for="txtLastName">Last Name:</label>
                                <input type="text" class="form-control" id="txtLastName" placeholder="Enter Last Name" name="txtLastName">
                            </div>
                            <div class="form-group">
                                <label for="txtAddress">Address:</label>
                                <textarea class="form-control" id="txtAddress" name="txtAddress" rows="10" placeholder="Enter Address"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Update User Modal -->
        <div id="updateModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- User Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Student</h4>
                    </div>
                    <div class="modal-body">
                        <form id="updateStudent" name="updateStudent" action="<?php echo site_url('student/update'); ?>" method="post">
                            <input type="hidden" name="hdnStudentId" id="hdnStudentId" />
                            <div class="form-group">
                                <label for="txtFirstName">First Name:</label>
                                <input type="text" class="form-control" id="txtFirstName" placeholder="Enter First Name" name="txtFirstName">
                            </div>
                            <div class="form-group">
                                <label for="txtLastName">Last Name:</label>
                                <input type="text" class="form-control" id="txtLastName" placeholder="Enter Last Name" name="txtLastName">
                            </div>
                            <div class="form-group">
                                <label for="txtAddress">Address:</label>
                                <textarea class="form-control" id="txtAddress" name="txtAddress" rows="10" placeholder="Enter Address"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                //Add the Student  
                $("#addStudent").validate({
                    rules: {
                        txtFirstName: "required",
                        txtLastName: "required",
                        txtAddress: "required"
                    },
                    messages: {},

                    submitHandler: function(form) {
                        var form_action = $("#addStudent").attr("action");
                        $.ajax({
                            data: $('#addStudent').serialize(),
                            url: form_action,
                            type: "POST",
                            dataType: 'json',
                            success: function(res) {
                                var student = '<tr id="' + res.data.id + '">';
                                student += '<td>' + res.data.id + '</td>';
                                student += '<td>' + res.data.first_name + '</td>';
                                student += '<td>' + res.data.last_name + '</td>';
                                student += '<td>' + res.data.address + '</td>';
                                student += '<td><a data-id="' + res.data.id + '" class="btn btn-primary btnEdit">Edit</a>&nbsp;&nbsp;<a data-id="' + res.data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
                                student += '</tr>';
                                $('#studentTable tbody').prepend(student);
                                $('#addStudent')[0].reset();
                                $('#addModal').modal('hide');
                            },
                            error: function(data) {}
                        });
                    }
                });


                //When click edit Student
                $('body').on('click', '.btnEdit', function() {
                    var student_id = $(this).attr('data-id');
                    $.ajax({
                        url: 'student/edit/' + student_id,
                        type: "GET",
                        dataType: 'json',
                        success: function(res) {
                            $('#updateModal').modal('show');
                            $('#updateStudent #hdnStudentId').val(res.data.id);
                            $('#updateStudent #txtFirstName').val(res.data.first_name);
                            $('#updateStudent #txtLastName').val(res.data.last_name);
                            $('#updateStudent #txtAddress').val(res.data.address);
                        },
                        error: function(data) {}
                    });
                });
                // Update the Student
                $("#updateStudent").validate({
                    rules: {
                        txtFirstName: "required",
                        txtLastName: "required",
                        txtAddress: "required"
                    },
                    messages: {},
                    submitHandler: function(form) {
                        var form_action = $("#updateStudent").attr("action");
                        $.ajax({
                            data: $('#updateStudent').serialize(),
                            url: form_action,
                            type: "POST",
                            dataType: 'json',
                            success: function(res) {
                                var student = '<td>' + res.data.id + '</td>';
                                student += '<td>' + res.data.first_name + '</td>';
                                student += '<td>' + res.data.last_name + '</td>';
                                student += '<td>' + res.data.address + '</td>';
                                student += '<td><a data-id="' + res.data.id + '" class="btn btn-primary btnEdit">Edit</a>&nbsp;&nbsp;<a data-id="' + res.data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
                                $('#studentTable tbody #' + res.data.id).html(student);
                                $('#updateStudent')[0].reset();
                                $('#updateModal').modal('hide');
                            },
                            error: function(data) {}
                        });
                    }
                });

                //delete student
                $('body').on('click', '.btnDelete', function() {
                    var student_id = $(this).attr('data-id');
                    $.get('student/delete/' + student_id, function(data) {
                        $('#studentTable tbody #' + student_id).remove();
                    })
                });

            });
        </script>
    </div>
</body>

</html>