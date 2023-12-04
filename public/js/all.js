$(document).ready(function () {

    //START OF CUSTOMER CRUD//

    //CUSTOMER INDEX//

    $("#ctable").DataTable({
        ajax: {
            url: "/api/customer/all",
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        buttons: [{
                extend: 'pdf',
                className: 'btn btn-success glyphicon glyphicon-file'
            },
            {
                extend: 'excel',
                className: 'btn btn-success glyphicon glyphicon-list-alt'
            },
            {
                text: "ADD CUSTOMER",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#cform").trigger("reset");
                    $("#cModal").modal("show");
                    $('#cUpdate').hide();
                    $('#cSubmit').show();
                    $('#labels').show();
                    $('#ilabels').hide();

                    $('#email').show();
                    $('#password').show();
                    $('#lemail').show();
                    $('#lpassword').show();
                    $('#llpassword').show();
                    $('#password-confirm').show();
                },
            },
        ],
        columns: [

            {
                data: "id",
            },
            
            {
                data: "name",
            },

            {
                data: "gender",
            },

            {
                data: "phone",
            },

            {
                data: "address",
            },

            {
                data: "birthdate",
            },

            {
                data: "email",
            },

            {
                data: null,
                render: function (data, type, row) {
                    return "<a href='#' class='editBtn' id='editbtn' data-id=" +
                        data.id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
                },
            },
        ],
    });

    //CUSTOMER CREATE//

    $("#cSubmit").on("click", function (e) {
        e.preventDefault();
        var data = $('#cform')[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ',' + pair[1]);
        }


        $.ajax({
            type: "POST",
            url: "/api/customer",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#cModal').modal("hide");
                var $ctable = $('#ctable').DataTable();
                // $itable.row.add(data.item).draw(false);
                bootbox.alert("NEW CUSTOMER ADDED!");
                $ctable.ajax.reload();
            },
            error: function (error) {
                console.log(error)
            }
        })

    });

    //CUSTOMER DELETE//

    $("#ctable tbody").on("click", 'a.deletebtn', function (e) {

        var table = $('#ctable').DataTable();
        var id = $(this).data("id");
        var $row = $(this).closest("tr");

        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "DO YOU WANT TO DELETE THIS CUSTOMER",
            buttons: {
                confirm: {
                    label: "YES",
                    className: "btn-success",
                },
                cancel: {
                    label: "NO",
                    className: "btn-danger",
                },
            },
            callback: function (result) {
                console.log(result);
                if (result)
                    $.ajax({
                        type: "DELETE",
                        url: "/api/customer/" + id,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            // bootbox.alert('success');
                            $row.fadeOut(4000, function () {
                                table.row($row).remove().draw(false);
                            });
                            bootbox.alert(data.success);
                        },
                        error: function (error) {
                            console.log("error");
                        },
                    });
            },
        });
    });

    //CUSTOMER EDIT//

    $("#ctable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        $('#cModal').modal('show');
        var id = $(this).data("id");
        // var $save = $('#itemSubmit').detach();

        $('#labels').hide();
        $('#ilabels').show();

        $('#cUpdate').show();
        $('#cSubmit').hide();
        $('#email').hide();
        $('#password').hide();
        $('#lemail').hide();
        $('#lpassword').hide();
        $('#llpassword').hide();
        $('#password-confirm').hide();
        // $('#btnss').append('<button id="itemupdate" type="submit" class="btn btn-primary">Update</button>');

        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/api/customer/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#cid').val(data.id);
                $('#name').val(data.name);
                $('#gender').val(data.gender);
                $('#phone').val(data.phone);
                $('#address').val(data.address);
                $('#birthdate').val(data.birthdate);
                // $("#imagepath").html(
                //     `<img src="/storage/${data.imagePath}" width="100" class="img-fluid img-thumbnail">`);
                // $('#itemimage').val(data.imagePath);
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //CUSTOMER UPDATE//

    $("#cUpdate").on("click", function (e) {
        var id = $("#cid").val();
        var data = $("#cform").serialize();
        console.log(data);
        $.ajax({
            type: "PUT",
            url: "/api/customer/" + id,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#cModal").each(function () {
                    $(this).modal("hide");
                    var $ctable = $('#ctable').DataTable();
                // $itable.row.add(data.item).draw(false);
                    bootbox.alert("CUSTOMER UPDATED SUCCESSFULLY!");
                    $ctable.ajax.reload();
                });
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //END OF CUSTOMER CRUD

    //START OF EMPLOYEE CRUD//

    //EMPLOYEE INDEX//

    $("#etable").DataTable({
        ajax: {
            url: "/api/employee/all",
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        buttons: [{
                extend: 'pdf',
                className: 'btn btn-success glyphicon glyphicon-file'
            },
            {
                extend: 'excel',
                className: 'btn btn-success glyphicon glyphicon-list-alt'
            },
            {
                text: "ADD EMPLOYEE",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#eform").trigger("reset");
                    $("#eModal").modal("show");
                    $('#eUpdate').hide();
                    $('#eSubmit').show();
                    $('#labels').show();
                    $('#ilabels').hide();

                    $('#email').show();
                    $('#password').show();
                    $('#image').show();
                    $('#lemail').show();
                    $('#lpassword').show();
                    $('#llpassword').show();
                    $('#password-confirm').show();
                    $('#limage').show();
                },
            },
        ],
        columns: [
            {
                data: "id",
            },

            {
                data: "name",
            },
        
            {
                data: "gender",
            },
            
            {
                data: "phone",
            },

            {
                data: "address",
            },

            {
                data: "birthdate",
            },

            {
                data: "email",
            },

            {
                data: null,
                render: function (data, type, JsonResultRow, row) {
                    return '<img src="/storage/' + data.image + '" height="100px" width="100px">';
                }
            },

            {
                data: null,
                render: function (data, type, row) {
                    console.log(data);
                    return "<a href='#' class='editBtn' id='editbtn' data-id=" +
                        data.id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
                },
            },
        ],
    });

    //EMPLOYEE CREATE

    $("#eSubmit").on("click", function (e) {
        e.preventDefault();
        var data = $('#eform')[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ',' + pair[1]);
        }


        $.ajax({
            type: "POST",
            url: "/api/employee",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#eModal').modal("hide");
                var $ctable = $('#etable').DataTable();
                // $itable.row.add(data.item).draw(false);
                bootbox.alert("NEW EMPLOYEE ADDED!");
                $ctable.ajax.reload();
            },
            error: function (error) {
                console.log(error)
            }
        })

    });

    //EMPLOYEE DELETE

    $("#etable tbody").on("click", 'a.deletebtn', function (e) {

        var table = $('#etable').DataTable();
        var id = $(this).data("id");
        var $row = $(this).closest("tr");

        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "DO YOU WANT TO DELETE THIS CUSTOMER",
            buttons: {
                confirm: {
                    label: "YES",
                    className: "btn-success",
                },
                cancel: {
                    label: "NO",
                    className: "btn-danger",
                },
            },
            callback: function (result) {
                console.log(result);
                if (result)
                    $.ajax({
                        type: "DELETE",
                        url: "/api/employee/" + id,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            // bootbox.alert('success');
                            $row.fadeOut(4000, function () {
                                table.row($row).remove().draw(false);
                            });
                            bootbox.alert(data.success);
                        },
                        error: function (error) {
                            console.log("error");
                        },
                    });
            },
        });
    });

    //EMPLOYEE EDIT

    $("#etable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        $('#eModal').modal('show');
        var id = $(this).data("id");
        // var $save = $('#itemSubmit').detach();

        $('#labels').hide();
        $('#ilabels').show();

        $('#eUpdate').show();
        $('#eSubmit').hide();
        $('#email').hide();
        $('#password').hide();
        $('#image').hide();
        $('#lemail').hide();
        $('#lpassword').hide();
        $('#llpassword').hide();
        $('#password-confirm').hide();
        $('#limage').hide();
        // $('#btnss').append('<button id="itemupdate" type="submit" class="btn btn-primary">Update</button>');

        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/api/employee/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#eid').val(data.id);
                $('#name').val(data.name);
                $('#gender').val(data.gender);
                $('#phone').val(data.phone);
                $('#address').val(data.address);
                $('#birthdate').val(data.birthdate);
                // $("#imagepath").html(
                //     `<img src="/storage/${data.imagePath}" width="100" class="img-fluid img-thumbnail">`);
                // $('#itemimage').val(data.imagePath);
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //EMPLOYEE UPDATE

    $("#eUpdate").on("click", function (e) {
        var id = $("#eid").val();
        var data = $("#eform").serialize();
        console.log(data);
        $.ajax({
            type: "PUT",
            url: "/api/employee/" + id,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#eModal").each(function () {
                    $(this).modal("hide");
                    var $ctable = $('#etable').DataTable();
                // $itable.row.add(data.item).draw(false);
                    bootbox.alert("EMPLOYEE UPDATED SUCCESSFULLY!");
                    $ctable.ajax.reload();
                });
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //END OF EMPLOYEE CRUD

    //START OF VOUCHER CRUD//

    //VOUCHER INDEX//

    $("#vtable").DataTable({
        ajax: {
            url: "/api/voucher/all",
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        buttons: [{
                extend: 'pdf',
                className: 'btn btn-success glyphicon glyphicon-file'
            },
            {
                extend: 'excel',
                className: 'btn btn-success glyphicon glyphicon-list-alt'
            },
            {
                text: "ADD VOUCHER",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#vform").trigger("reset");
                    $("#vModal").modal("show");
                    $('#vUpdate').hide();
                    $('#vSubmit').show();
                    $('#labels').show();
                    $('#ilabels').hide();

                    $('#stocks').show();
                    $('#value').show();
                    // $('#password').show();
                    $('#image').show();
                    $('#lstocks').show();
                    // $('#lpassword').show();
                    // $('#llpassword').show();
                    // $('#password-confirm').show();
                    $('#limage').show();
                },
            },
        ],
        columns: [
            {
                data: "id",
            },

            {
                data: "name",
            },
        
            {
                data: "description",
            },

            {
                data: "value",
            },
            {
                data: "limit",
            },
            {
                data: "status",
            },

            {
                data: null,
                render: function (data, type, JsonResultRow, row) {
                    return '<img src="/storage/' + data.image + '" height="200px" width="400px">';
                }
            },

            {
                data: null,
                render: function (data, type, row) {
                    console.log(data);
                    return "<a href='#' class='editBtn' id='editbtn' data-id=" +
                        data.id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
                },
            },
        ],
    });

    //VOUCHER CREATE

    $("#vSubmit").on("click", function (e) {
        e.preventDefault();
        var data = $('#vform')[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ',' + pair[1]);
        }


        $.ajax({
            type: "POST",
            url: "/api/voucher",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#vModal').modal("hide");
                var $ctable = $('#vtable').DataTable();
                // $itable.row.add(data.item).draw(false);
                bootbox.alert("NEW VOUCHER ADDED!");
                $ctable.ajax.reload();
            },
            error: function (error) {
                console.log(error)
            }
        })

    });

    //VOUCHER DELETE

    $("#vtable tbody").on("click", 'a.deletebtn', function (e) {

        var table = $('#vtable').DataTable();
        var id = $(this).data("id");
        var $row = $(this).closest("tr");

        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "DO YOU WANT TO DELETE THIS VOUCHER",
            buttons: {
                confirm: {
                    label: "YES",
                    className: "btn-success",
                },
                cancel: {
                    label: "NO",
                    className: "btn-danger",
                },
            },
            callback: function (result) {
                console.log(result);
                if (result)
                    $.ajax({
                        type: "DELETE",
                        url: "/api/voucher/" + id,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            // bootbox.alert('success');
                            $row.fadeOut(4000, function () {
                                table.row($row).remove().draw(false);
                            });
                            bootbox.alert(data.success);
                        },
                        error: function (error) {
                            console.log("error");
                        },
                    });
            },
        });
    });

    //VOUCHER EDIT

    $("#vtable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        $('#vModal').modal('show');
        var id = $(this).data("id");
        // var $save = $('#itemSubmit').detach();

        $('#labels').hide();
        $('#ilabels').show();

        $('#vUpdate').show();
        $('#vSubmit').hide();
        $('#stocks').show();
        $('#value').show();
        // $('#password').hide();
        $('#image').hide();
        $('#lstocks').show();
        $('#lvalue').show();
        $('#llimit').show();
        // $('#lpassword').hide();
        // $('#llpassword').hide();
        // $('#password-confirm').hide();
        $('#limage').hide();
        // $('#btnss').append('<button id="itemupdate" type="submit" class="btn btn-primary">Update</button>');

        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/api/voucher/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#vid').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#value').val(data.value);
                $('#stocks').val(data.stocks);
                $('#limit').val(data.limit);
                // $('#phone').val(data.phone);
                // $('#address').val(data.address);
                // $('#birthdate').val(data.birthdate);
                // $("#imagepath").html(
                //     `<img src="/storage/${data.imagePath}" width="100" class="img-fluid img-thumbnail">`);
                // $('#itemimage').val(data.imagePath);
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //VOUCHER UPDATE

    $("#vUpdate").on("click", function (e) {
        var id = $("#vid").val();
        var data = $("#vform").serialize();
        console.log(data);
        $.ajax({
            type: "PUT",
            url: "/api/voucher/" + id,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#vModal").each(function () {
                    $(this).modal("hide");
                    var $vtable = $('#vtable').DataTable();
                // $itable.row.add(data.item).draw(false);
                    bootbox.alert("VOUCHER UPDATED SUCCESSFULLY!");
                    $vtable.ajax.reload();
                });
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //END OF VOUCHER CRUD

    //START OF PIZZA CRUD//

    //PIZZA INDEX//

    $("#ptable").DataTable({
        ajax: {
            url: "/api/pizza/all",
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        buttons: [{
                extend: 'pdf',
                className: 'btn btn-success glyphicon glyphicon-file'
            },
            {
                extend: 'excel',
                className: 'btn btn-success glyphicon glyphicon-list-alt'
            },
            {
                text: "ADD PIZZA",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#pform").trigger("reset");
                    $("#pModal").modal("show");
                    $('#pUpdate').hide();
                    $('#pSubmit').show();
                    $('#labels').show();
                    $('#ilabels').hide();

                    // $('#stocks').show();
                    // $('#value').show();
                    // $('#password').show();
                    $('#image').show();
                    // $('#lstocks').show();
                    // $('#lpassword').show();
                    // $('#llpassword').show();
                    // $('#password-confirm').show();
                    $('#limage').show();
                },
            },
        ],
        columns: [
            {
                data: "id",
            },

            {
                data: "name",
            },
        
            {
                data: "description",
            },

            {
                data: "fee",
            },

            {
                data: null,
                render: function (data, type, JsonResultRow, row) {
                    return '<img src="/storage/' + data.image + '" height="200px" width="400px">';
                }
            },

            {
                data: null,
                render: function (data, type, row) {
                    console.log(data);
                    return "<a href='#' class='editBtn' id='editbtn' data-id=" +
                        data.id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
                },
            },
        ],
    });

    //PIZZA CREATE

    $("#pSubmit").on("click", function (e) {
        e.preventDefault();
        var data = $('#pform')[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ',' + pair[1]);
        }


        $.ajax({
            type: "POST",
            url: "/api/pizza",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#pModal').modal("hide");
                var $ptable = $('#ptable').DataTable();
                // $itable.row.add(data.item).draw(false);
                bootbox.alert("NEW PIZZA ADDED!");
                $ptable.ajax.reload();
            },
            error: function (error) {
                console.log(error)
            }
        })

    });

    //VOUCHER DELETE

    $("#ptable tbody").on("click", 'a.deletebtn', function (e) {

        var table = $('#ptable').DataTable();
        var id = $(this).data("id");
        var $row = $(this).closest("tr");

        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "DO YOU WANT TO DELETE THIS PIZZA",
            buttons: {
                confirm: {
                    label: "YES",
                    className: "btn-success",
                },
                cancel: {
                    label: "NO",
                    className: "btn-danger",
                },
            },
            callback: function (result) {
                console.log(result);
                if (result)
                    $.ajax({
                        type: "DELETE",
                        url: "/api/pizza/" + id,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            // bootbox.alert('success');
                            $row.fadeOut(4000, function () {
                                table.row($row).remove().draw(false);
                            });
                            bootbox.alert(data.success);
                        },
                        error: function (error) {
                            console.log("error");
                        },
                    });
            },
        });
    });

    //VOUCHER EDIT

    $("#ptable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        $('#pModal').modal('show');
        var id = $(this).data("id");
        // var $save = $('#itemSubmit').detach();

        $('#labels').hide();
        $('#ilabels').show();

        $('#pUpdate').show();
        $('#pSubmit').hide();
        // $('#stocks').show();
        // $('#value').show();
        // $('#password').hide();
        $('#image').hide();
        // $('#lstocks').show();
        // $('#lvalue').show();
        // $('#lpassword').hide();
        // $('#llpassword').hide();
        // $('#password-confirm').hide();
        $('#limage').hide();
        // $('#btnss').append('<button id="itemupdate" type="submit" class="btn btn-primary">Update</button>');

        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/api/pizza/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#pid').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#fee').val(data.fee);
                // $('#stocks').val(data.stocks);
                // $('#phone').val(data.phone);
                // $('#address').val(data.address);
                // $('#birthdate').val(data.birthdate);
                // $("#imagepath").html(
                //     `<img src="/storage/${data.imagePath}" width="100" class="img-fluid img-thumbnail">`);
                // $('#itemimage').val(data.imagePath);
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //VOUCHER UPDATE

    $("#pUpdate").on("click", function (e) {
        var id = $("#pid").val();
        var data = $("#pform").serialize();
        console.log(data);
        $.ajax({
            type: "PUT",
            url: "/api/pizza/" + id,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#pModal").each(function () {
                    $(this).modal("hide");
                    var $ptable = $('#ptable').DataTable();
                // $itable.row.add(data.item).draw(false);
                    bootbox.alert("PIZZA UPDATED SUCCESSFULLY!");
                    $ptable.ajax.reload();
                });
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //END OF PIZZA CRUD

    //START OF ANNOUNCEMENT CRUD//

    //ANNOUNCEMENT INDEX//

    $("#atable").DataTable({
        ajax: {
            url: "/api/announcement/all",
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        buttons: [{
                extend: 'pdf',
                className: 'btn btn-success glyphicon glyphicon-file'
            },
            {
                extend: 'excel',
                className: 'btn btn-success glyphicon glyphicon-list-alt'
            },
            {
                text: "ADD ANNOUNCEMENT",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#aform").trigger("reset");
                    $("#aModal").modal("show");
                    $('#aUpdate').hide();
                    $('#aSubmit').show();
                    $('#labels').show();
                    $('#ilabels').hide();

                    // $('#email').show();
                    // $('#password').show();
                    $('#image').show();
                    // $('#lemail').show();
                    // $('#lpassword').show();
                    // $('#llpassword').show();
                    // $('#password-confirm').show();
                    $('#limage').show();
                },
            },
        ],
        columns: [
            {
                data: "id",
            },

            {
                data: "title",
            },
        
            {
                data: "info",
            },

            {
                data: null,
                render: function (data, type, JsonResultRow, row) {
                    return '<img src="/storage/' + data.image + '" height="100px" width="100px">';
                }
            },

            {
                data: null,
                render: function (data, type, row) {
                    console.log(data);
                    return "<a href='#' class='editBtn' id='editbtn' data-id=" +
                        data.id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
                },
            },
        ],
    });

    //ANNOUNCEMENT CREATE

    $("#aSubmit").on("click", function (e) {
        e.preventDefault();
        var data = $('#aform')[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ',' + pair[1]);
        }


        $.ajax({
            type: "POST",
            url: "/api/announcement",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#aModal').modal("hide");
                var $atable = $('#atable').DataTable();
                // $itable.row.add(data.item).draw(false);
                bootbox.alert("NEW ANNOUNCEMENT ADDED!");
                $atable.ajax.reload();
            },
            error: function (error) {
                console.log(error)
            }
        })

    });

    //ANNOUNCEMENT DELETE

    $("#atable tbody").on("click", 'a.deletebtn', function (e) {

        var table = $('#atable').DataTable();
        var id = $(this).data("id");
        var $row = $(this).closest("tr");

        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "DO YOU WANT TO DELETE THIS ANNOUNCEMENT",
            buttons: {
                confirm: {
                    label: "YES",
                    className: "btn-success",
                },
                cancel: {
                    label: "NO",
                    className: "btn-danger",
                },
            },
            callback: function (result) {
                console.log(result);
                if (result)
                    $.ajax({
                        type: "DELETE",
                        url: "/api/announcement/" + id,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            // bootbox.alert('success');
                            $row.fadeOut(4000, function () {
                                table.row($row).remove().draw(false);
                            });
                            bootbox.alert(data.success);
                        },
                        error: function (error) {
                            console.log("error");
                        },
                    });
            },
        });
    });

    //ANNOUNCEMENT EDIT

    $("#atable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        $('#aModal').modal('show');
        var id = $(this).data("id");
        // var $save = $('#itemSubmit').detach();

        $('#labels').hide();
        $('#ilabels').show();

        $('#aUpdate').show();
        $('#aSubmit').hide();
        // $('#email').hide();
        // $('#password').hide();
        $('#image').hide();
        // $('#lemail').hide();
        // $('#lpassword').hide();
        // $('#llpassword').hide();
        // $('#password-confirm').hide();
        $('#limage').hide();
        // $('#btnss').append('<button id="itemupdate" type="submit" class="btn btn-primary">Update</button>');

        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/api/announcement/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#aid').val(data.id);
                $('#title').val(data.title);
                $('#info').val(data.info);
                // $("#imagepath").html(
                //     `<img src="/storage/${data.imagePath}" width="100" class="img-fluid img-thumbnail">`);
                // $('#itemimage').val(data.imagePath);
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //EMPLOYEE UPDATE

    $("#aUpdate").on("click", function (e) {
        var id = $("#aid").val();
        var data = $("#aform").serialize();
        console.log(data);
        $.ajax({
            type: "PUT",
            url: "/api/announcement/" + id,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#aModal").each(function () {
                    $(this).modal("hide");
                    var $atable = $('#atable').DataTable();
                // $itable.row.add(data.item).draw(false);
                    bootbox.alert("ANNOUNCEMENT UPDATED SUCCESSFULLY!");
                    $atable.ajax.reload();
                });
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //END OF ANNOUNCEMENT CRUD

    //START OF PIZZACRUST CRUD

    $("#pctable").DataTable({
        ajax: {
            url: "/api/pizzacrust/all",
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        buttons: [{
                extend: 'pdf',
                className: 'btn btn-success glyphicon glyphicon-file'
            },
            {
                extend: 'excel',
                className: 'btn btn-success glyphicon glyphicon-list-alt'
            },
            {
                text: "ADD PIZZA CRUST",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#pcform").trigger("reset");
                    $("#pcModal").modal("show");
                    $('#pcUpdate').hide();
                    $('#pcSubmit').show();
                    $('#clabels').show();
                    $('#elabels').hide();

                },
            },
        ],
        columns: [

            {
                data: "id",
            },
            
            {
                data: "name",
            },

            {
                data: "description",
            },

            {
                data: "fee",
            },

            {
                data: null,
                render: function (data, type, JsonResultRow, row) {
                    return '<img src="/storage/' + data.image + '" height="200px" width="400px">';
                }
            },

            {
                data: null,
                render: function (data, type, row) {
                    return "<a href='#' class='editBtn' id='editbtn' data-id=" +
                        data.id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
                },
            },
        ],
    });

    //CREATE PIZZA CRUST
    $("#pcSubmit").on("click", function (e) {
        e.preventDefault();
        var data = $('#pcform')[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ',' + pair[1]);
        }


        $.ajax({
            type: "POST",
            url: "/api/pizzacrust",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#pcModal').modal("hide");
                var $pctable = $('#pctable').DataTable();
                // $itable.row.add(data.item).draw(false);
                bootbox.alert("NEW PIZZA CRUST ADDED!");
                $pctable.ajax.reload();
            },
            error: function (error) {
                console.log(error)
            }
        })

    });

    //EDIT PIZZA CRUST
    $("#pctable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        $('#pcModal').modal('show');
        var id = $(this).data("id");

        $('#clabels').hide();
        $('#elabels').show();

        $('#pcUpdate').show();
        $('#pcSubmit').hide();

        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/api/pizzacrust/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#fee').val(data.fee);
               
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //PIZZA CRUST UPDATE
    $("#pcUpdate").on("click", function (e) {
        var id = $("#id").val();
        var data = $("#pcform").serialize();
        console.log(data);
        $.ajax({
            type: "PUT",
            url: "/api/pizzacrust/" + id,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#pcModal").each(function () {
                    $(this).modal("hide");
                    var $pctable = $('#pctable').DataTable();
                // $itable.row.add(data.item).draw(false);
                    bootbox.alert("PIZZA CRUST UPDATED SUCCESSFULLY!");
                    $pctable.ajax.reload();
                });
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //PIZZA CRUST DELETE
    $("#pctable tbody").on("click", 'a.deletebtn', function (e) {

        var table = $('#pctable').DataTable();
        var id = $(this).data("id");
        var $row = $(this).closest("tr");

        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "DO YOU WANT TO DELETE THIS PIZZA CRUST",
            buttons: {
                confirm: {
                    label: "YES",
                    className: "btn-success",
                },
                cancel: {
                    label: "NO",
                    className: "btn-danger",
                },
            },
            callback: function (result) {
                console.log(result);
                if (result)
                    $.ajax({
                        type: "DELETE",
                        url: "/api/pizzacrust/" + id,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            // bootbox.alert('success');
                            $row.fadeOut(4000, function () {
                                table.row($row).remove().draw(false);
                            });
                            bootbox.alert(data.success);
                        },
                        error: function (error) {
                            console.log("error");
                        },
                    });
            },
        });
    });

    //END OF PIZZACRUST CRUD
    
    //START OF PIZZATOPPINGS CRUD

    $("#pttable").DataTable({
        ajax: {
            url: "/api/pizzatoppings/all",
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        buttons: [{
                extend: 'pdf',
                className: 'btn btn-success glyphicon glyphicon-file'
            },
            {
                extend: 'excel',
                className: 'btn btn-success glyphicon glyphicon-list-alt'
            },
            {
                text: "ADD PIZZA TOPPINGS",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#ptform").trigger("reset");
                    $("#ptModal").modal("show");
                    $('#ptUpdate').hide();
                    $('#ptSubmit').show();
                    $('#clabels').show();
                    $('#elabels').hide();

                },
            },
        ],
        columns: [

            {
                data: "id",
            },
            
            {
                data: "name",
            },

            {
                data: "description",
            },

            {
                data: "fee",
            },

            {
                data: null,
                render: function (data, type, JsonResultRow, row) {
                    return '<img src="/storage/' + data.img_path + '" height="200px" width="400px">';
                }
            },

            {
                data: null,
                render: function (data, type, row) {
                    return "<a href='#' class='editBtn' id='editbtn' data-id=" +
                        data.id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
                },
            },
        ],
    });

    //PIZZA TOPPINGS CREATE
    $("#ptSubmit").on("click", function (e) {
        e.preventDefault();
        var data = $('#ptform')[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ',' + pair[1]);
        }


        $.ajax({
            type: "POST",
            url: "/api/pizzatoppings",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#ptModal').modal("hide");
                var $pctable = $('#pttable').DataTable();
                // $itable.row.add(data.item).draw(false);
                bootbox.alert("NEW PIZZA TOPPINGS ADDED!");
                $pctable.ajax.reload();
            },
            error: function (error) {
                console.log(error)
            }
        })

    });

    //PIZZA TOPPINGS EDIT
    $("#pttable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        $('#ptModal').modal('show');
        var id = $(this).data("id");

        $('#clabels').hide();
        $('#elabels').show();

        $('#ptUpdate').show();
        $('#ptSubmit').hide();

        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/api/pizzatoppings/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#fee').val(data.fee);
               
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //PIZZA TOPPINGS UPDATE
    $("#ptUpdate").on("click", function (e) {
        var id = $("#id").val();
        var data = $("#ptform").serialize();
        console.log(data);
        $.ajax({
            type: "PUT",
            url: "/api/pizzatoppings/" + id,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#ptModal").each(function () {
                    $(this).modal("hide");
                    var $pctable = $('#pttable').DataTable();
                // $itable.row.add(data.item).draw(false);
                    bootbox.alert("PIZZA TOPPINGS UPDATED SUCCESSFULLY!");
                    $pctable.ajax.reload();
                });
            },
            error: function (error) {
                console.log("error");
            },
        });
    });

    //PIZZA TOPPINGS DELETE
    $("#pttable tbody").on("click", 'a.deletebtn', function (e) {

        var table = $('#pttable').DataTable();
        var id = $(this).data("id");
        var $row = $(this).closest("tr");

        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "DO YOU WANT TO DELETE THIS PIZZA TOPPINGS",
            buttons: {
                confirm: {
                    label: "YES",
                    className: "btn-success",
                },
                cancel: {
                    label: "NO",
                    className: "btn-danger",
                },
            },
            callback: function (result) {
                console.log(result);
                if (result)
                    $.ajax({
                        type: "DELETE",
                        url: "/api/pizzatoppings/" + id,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            // bootbox.alert('success');
                            $row.fadeOut(4000, function () {
                                table.row($row).remove().draw(false);
                            });
                            bootbox.alert(data.success);
                        },
                        error: function (error) {
                            console.log("error");
                        },
                    });
            },
        });
    });

    //END OF PIZZATOPPINGS CRUD

});