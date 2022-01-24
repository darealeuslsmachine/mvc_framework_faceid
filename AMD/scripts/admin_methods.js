define([
    'jquery',
    'datatables_JSZip',
    'datatables_settings',
    'datatables',
    'datatables_Buttons_print',
    'datatables_Buttons_html5',
    'datatables_Buttons_Bootstrap4',
], function($, jszip, dtSettings) {

    let admin_methods = {};

    admin_methods.admintableAJAX = function () {

        let datatableAjaxSettings = {

            //serverSide: true,
            processing: true,
            responsive: true,
            ajax: {
                url: "/faceid/AJAX/AJAX.php",
                type: "POST",
                data: {
                    method: "getAdminUsers",
                },
                dataSrc: ""
            },
            columns: [
                {
                    data: "fullname",
                    render: function (data, type, row, meta) {

                        let patronymic = row.patronymic;

                        if (patronymic == null) {
                            patronymic = '';
                        }

                        let fullname = row.lastname + ' ' + row.firstname + ' ' + patronymic;

                        return '<a href="/faceid/user/profile/' + row.id + '" class="text-info" id="profilelink' + row.id + '">' + fullname + '</a>';
                    }
                },
                {
                    data: "login"
                },
                {
                    data: "password",
                    render: function (data, type, row, meta) {
                        return  '<input type="password" value="' + row.password + '" id="inputpass' + row.id + '" name="inputpass' + row.id + '" readonly>' +
                                '<div class="custom-control custom-checkbox custom-control-inline">&nbsp' +
                                    '<input type="checkbox" class="custom-control-input" id="chkshowpass' + row.id + '" name="chkshowpass' + row.id + '">' +
                                    '<label for="chkshowpass' + row.id + '" class="custom-control-label text-sm">Показать пароль</label>' +
                                '</div>';
                    },
                },
                {
                    data: "roleid",
                    render: function (data, type, row, meta) {
                        return row.role;
                    }
                },
                {
                    render: function (data, type, row, meta) {
                        return '<a href="#" id="editlink' + row.id + '"><i class="fas fa-edit"></i></a>&nbsp' +
                            '<a href="#" id="deletelink' + row.id + '"><i class="fas fa-trash"></i></a>';
                    }
                }
            ],
        };

        window.JSZip = jszip;

        let dtFullSettings = Object.assign(dtSettings, datatableAjaxSettings);
        let datatable = $('#admintable').DataTable(dtFullSettings);
    };





    admin_methods.editUserAdmin = function () {
        $(document).ready(function() {
        // If user click some link in table
        $('#admintable tbody').on('click', 'a', function () {

            // Get link id
            let linkid = $(this).attr('id');

            // If link responsible for edit
            if (linkid.includes("editlink") === true) {

                // Get user id, cuz link id refer userid. Id index = userid
                let userid = linkid.replace('editlink', '');

                // Show modal window for edit user info
                $('#modaledit').modal('show');

                //$('#modaledit').on('shown.bs.modal', function () {

                // Get user info from AJAX and set to modal form
                $.ajax({
                    url: "/faceid/AJAX/AJAX.php",
                    type: "POST",
                    data: {
                        method: "getUserInfo",
                        userid: userid
                    },
                    dataType: "JSON",
                    success: function (data) {

                        $('#firstnamemodal').val(data[0].firstname);
                        $('#lastnamemodal').val(data[0].lastname);
                        $('#patronymicmodal').val(data[0].patronymic);
                        $('#loginmodal').val(data[0].login);
                        $('#passwordmodal').val(data[0].password);
                        $('div.roleselect select').val(data[0].roleid).change();
                    }
                });

                $('#modaleditconfirm').on('click', function () {

                    let firstname = $('#firstnamemodal').val();
                    let lastname = $('#lastnamemodal').val();
                    let patronymic = $('#patronymicmodal').val();
                    let login = $('#loginmodal').val();
                    let password = $('#passwordmodal').val();
                    let roleid = $('#rolemodal').val();

                    $.ajax({
                        url: "/faceid/AJAX/AJAX.php",
                        type: "POST",
                        data: {
                            method: "editAdminUser",
                            userid: userid,
                            firstname: firstname,
                            lastname: lastname,
                            patronymic: patronymic,
                            login: login,
                            password: password,
                            roleid: roleid
                        },
                        dataType: "JSON",
                        success: function () {
                            $('#modaleditconfirm').off();
                            $('#modaledit').modal('hide');
                            $('#admintable').DataTable().ajax.reload();
                        }
                    });
                });
            }
        });
        });
    }





    admin_methods.deleteUserAdmin = function () {
        $('#admintable tbody').on('click', 'a', function () {
            let linkid = $(this).attr('id');
            if (linkid.includes("deletelink") === true) {

                $('#modaldelete').modal('show');
                let userid = linkid.replace('deletelink', '');

                $('#modaldeleteconfirm').on('click', function () {

                    $.ajax({
                        url: "/faceid/AJAX/AJAX.php",
                        type: "POST",
                        data: {
                            method: "deleteUser",
                            userid: userid
                        },
                        dataType: "JSON",
                        success: function () {
                            $('#modaldeleteconfirm').off();
                            $('#modaldelete').modal('hide');
                            $('#admintable').DataTable().ajax.reload();
                        }
                    });
                });
            };
        });
    }





    admin_methods.showPassAdmin = function () {
        $('#admintable tbody').on('click', 'input', function () {

            let checkboxPass = $(this).attr('name');

            if (checkboxPass.includes('chkshowpass') === true) {

                let index = checkboxPass.replace('chkshowpass', '');
                let inputPass = $('#inputpass' + index);

                (inputPass.attr('type') === "password") ? inputPass.prop("type", "text") : inputPass.prop("type", "password");
            }
        });
    }





    admin_methods.showUploadedPhoto = function () {
        $(document).on("click", ".browse", function() {
            var file = $(this).parents().find(".file");
            file.trigger("click");
        });
        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
    };





    admin_methods.posttableAJAX = function () {

        let posttableSettings = {

            //bPaginate: false,
            //sDom: "ltipr",

            bFilter: true,
            bInfo:false,
            sScrollY: true,
            iDisplayLength: 5,
            dom: '<"top"i>rt<"bottom"f><"clear">',
            bLengthChange: false,
            scrollCollapse: true,

            //serverSide: true,
            processing: true,
            responsive: true,

            language: {
                search: "",
                searchPlaceholder: "Поиск..."
            },

            ajax: {
                url: "/faceid/AJAX/AJAX.php",
                type: "POST",
                data: {
                    method: "getPostTable",
                },
                dataSrc: ""
            },
            columns: [
                {
                    data: "name",
                    render: function (data, type, row, meta) {
                        return '<a href="#" class="list-group-item-action"><div>' + row.name + '</div></a>';
                    }
                },
        ]};
        let post_datatable = $('#posttable').DataTable(posttableSettings);
        $('.dataTables_filter').addClass('admin-settings-post-div-search');
        $('.dataTables_filter input[type="search"]').css(
            {'width': '200%',
            'padding-right': '20px'}
        );

    };





    admin_methods.allposttableAJAX = function () {
        let allposttableSettings = {

            bFilter: true,
            sScrollY: true,
            processing: true,
            responsive: true,

            language: {
                search: "",
                searchPlaceholder: "Поиск..."
            },

            ajax: {
                url: "/faceid/AJAX/AJAX.php",
                type: "POST",
                data: {
                    method: "getAllPostTable",
                },
                dataSrc: "",
                complete: function (data) {
                    console.log(data);
                }
            },
            columns: [
                {
                    data: "name",
                    render: function (data, type, row, meta) {
                        return '<a href="#" class="list-group-item-action"><div>' + row.name + '</div></a>';
                    }
                },
            ]};

        let post_datatable = $('#allposttable').DataTable(allposttableSettings);
    }





    return admin_methods;
});