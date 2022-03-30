
$(document).ready(function () {
    var namePort = "localhost/StudentDetailsApplication";

    //Fetch All Records
    function loadTable() {
        $("#load-table").html("");
        $.ajax({
            url: 'http://' + namePort + '/api_fetch_all.php',
            type: "GET",
            dataType: "json",
            success: function (data) {
                // console.log(data);
                if (data.status == false) {
                    $("#load-table").append("<tr><td colspan='8'><h2>" + data.message + "</h2></td></tr>")
                } else {
                    $.each(data, function (key, value) {
                        $("#load-table").append("<tr>"
                            + "<td>" + value.id + "</td>"
                            + "<td>" + value.student_name + "</td>"
                            + "<td>" + value.address + "</td>"
                            + "<td>" + value.dob + "</td>"
                            + "<td>" + value.phone + "</td>"
                            + "<td>" + value.course + "</td>"
                            + "<td><button type='button' class='btn btn-primary edit-btn' data-bs-toggle='modal' data-bs-target='#exampleModal' data-eid='" + value.id + "'>Edit</button></td>"
                            + "<td><button type='button' class='btn btn-danger delete-btn' data-bs-toggle='modal' data-id='" + value.id + "'>Delete</button></td>"
                            + "</tr>")
                    });
                }
            }
        });
    }

    loadTable();

    //Show message for success or error
    function message(message, status) {
        if (status == true) {
            $("#success-message").html(message);
            $("#success-alert").slideDown();
            $("#error-alert").slideUp();
            setTimeout(() => {
                $("#success-alert").slideUp();
            }, 5000);
        } else if (status == false) {
            $("#error-message").html(message);
            $("#error-alert").slideDown();
            $("#success-alert").slideUp();
            setTimeout(() => {
                $("#error-alert").slideUp();
            }, 5000);
        }

    }

    //Function for form data to json format
    function jsonFormate(targetForm) {
        var arr = $(targetForm).serializeArray();
        // console.log(arr);
        var obj = {};
        for (let i = 0; i < arr.length; i++) {
            if (arr[i].value == "") {
                return false;
            }
            obj[arr[i].name] = arr[i].value;
        }
        // console.log(obj);
        var json_string = JSON.stringify(obj);
        // console.log(json_string);
        return json_string;
    }

    //Insert New Record
    $("#save-btn").on("click", function (e) {
        e.preventDefault();

        var jsonData = jsonFormate("#addForm");
        // console.log(jsonData);

        if (jsonData == false) {
            message("All fields are required!", false);
        } else {
            $.ajax({
                url: 'http://' + namePort + '/api_insert.php',
                type: "POST",
                dataType: "json",
                data: jsonData,
                success: function (data) {
                    message(data.message, data.status);

                    if (data.status == true) {
                        loadTable();
                        $("#addForm").trigger("reset");
                    }
                }
            });
        }
    });

    //Delete Record
    $(document).on("click", ".delete-btn", function () {
        if (confirm("Do you really want to delete this record?")) {
            var studentId = $(this).data("id");
            var obj = { sid: studentId };
            var myJSON = JSON.stringify(obj);

            var row = this;

            $.ajax({
                url: 'http://' + namePort + '/api_delete.php',
                type: "POST",
                dataType: "json",
                data: myJSON,
                success: function (data) {
                    // console.log(data);
                    message(data.message, data.status);

                    if (data.status == true) {
                        $(row).closest("tr").fadeOut();
                    }
                }
            });
        }
    });

    //Fetch Single Record : Show in Model Box
    $(document).on("click", ".edit-btn", function () {
        $(".modal-backdrop").show();
        $("#exampleModal").show();
        var studentId = $(this).data("eid");
        var obj = { sid: studentId };
        var myJSON = JSON.stringify(obj);

        $.ajax({
            url: 'http://' + namePort + '/api_fetch_single.php',
            type: "POST",
            dataType: "json",
            data: myJSON,
            success: function (data) {
                // console.log(data);
                $("#edit-id").val(data[0].id);
                $("#edit-name").val(data[0].student_name);
                $("#edit-address").val(data[0].address);
                $("#edit-dob").val(data[0].dob);
                $("#edit-phone").val(data[0].phone);
                $("#edit-course").val(data[0].course);
            }
        });
    });

    //Hide Model Box
    $(".btn-close").on("click", function () {
        $("#exampleModal").hide();
        $(".modal-backdrop").hide();
    });

    //Update Record
    $("#update-edit-btn").on("click", function (e) {
        e.preventDefault();

        var jsonData = jsonFormate("#edit-form");
        // console.log(jsonData);

        if (jsonData == false) {
            message("All fields are required!", false);
        } else {
            $.ajax({
                url: 'http://' + namePort + '/api_update.php',
                type: "PUT",
                dataType: "json",
                data: jsonData,
                success: function (data) {
                    message(data.message, data.status);

                    if (data.status == true) {
                        $("#exampleModal").hide();
                        $(".modal-backdrop").hide();
                        loadTable();
                    }
                }
            });
        }
    });

    //Search Record when you press on search button
    $("#search-btn").on("click", function (e) {
        e.preventDefault();
        // var arr = $("#searchForm").serializeArray();

        // if (arr[0].value != "") {
        //     for (let i = 0; i < arr.length; i++) {
        //         searchValue = arr[i].value;
        //     }
        // }
        var searchValue = $("#searchForm").find('input[name="key"]').val();

        $("#load-table").html("");

        $.ajax({
            url: 'http://' + namePort + '/api_search.php?key=' + searchValue,
            type: "POST",
            dataType: "json",
            success: function (data) {
                // console.log(data);
                if (data.status == false) {
                    $("#load-table").append("<tr><td colspan='6'><h2>" + data.message + "</h2></td></tr>")
                } else {
                    $.each(data, function (key, value) {
                        $("#load-table").append("<tr>"
                            + "<td>" + value.id + "</td>"
                            + "<td>" + value.student_name + "</td>"
                            + "<td>" + value.address + "</td>"
                            + "<td>" + value.dob + "</td>"
                            + "<td>" + value.phone + "</td>"
                            + "<td>" + value.course + "</td>"
                            + "<td><button type='button' class='btn btn-primary edit-btn' data-bs-toggle='modal' data-bs-target='#exampleModal' data-eid='" + value.id + "'>Edit</button></td>"
                            + "<td><button type='button' class='btn btn-danger delete-btn' data-bs-toggle='modal' data-id='" + value.id + "'>Delete</button></td>"
                            + "</tr>")
                    });
                }
            }
        });
    });

    //Search Record when you enter keywords
    $(document).on("keyup", "#search-key", function () {
        searchTerm = $(this).val();

        $("#load-table").html("");

        $.ajax({
            url: 'http://' + namePort + '/api_search.php?key=' + searchTerm,
            type: "POST",
            dataType: "json",
            success: function (data) {
                // console.log(data);
                if (data.status == false) {
                    $("#load-table").append("<tr><td colspan='6'><h2>" + data.message + "</h2></td></tr>")
                } else {
                    $.each(data, function (key, value) {
                        $("#load-table").append("<tr>"
                            + "<td>" + value.id + "</td>"
                            + "<td>" + value.student_name + "</td>"
                            + "<td>" + value.age + "</td>"
                            + "<td>" + value.city + "</td>"
                            + "<td><button type='button' class='btn btn-primary edit-btn' data-bs-toggle='modal' data-bs-target='#exampleModal' data-eid='" + value.id + "'>Edit</button></td>"
                            + "<td><button type='button' class='btn btn-danger delete-btn' data-bs-toggle='modal' data-id='" + value.id + "'>Delete</button></td>"
                            + "</tr>")
                    });
                }
            }
        });
    });

});