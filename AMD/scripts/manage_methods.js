define([
    'jquery',
    'datatables_JSZip',
    'datatables_settings',
    'datatables',
    'datatables_Buttons_print',
    'datatables_Buttons_html5',
    'datatables_Buttons_Bootstrap4',
], function($, jszip, dtSettings) {

    let manage_methods = {};

    manage_methods.manageTableAJAX = function () {

        let contractorid = $('#contractorid').val();

        let datatableAjaxSettings = {

            processing: true,
            responsive: true,
            ajax: {
                url: "/faceid/AJAX/AJAX.php",
                type: "POST",
                data: {
                    method: "getContractorUsers",
                    contractorid: contractorid,
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

                        return '<a href="/faceid/manage/profile/' + row.id + '" class="text-info" id="profilelink' + row.id + '">' + fullname + '</a>';
                    }
                },
                {
                    data: "postname",
                    render: function (data, type, row, meta) {
                        return row.postname;
                    }
                },
                {
                    data: "img",
                    render: function (data, type, row, meta) {
                         if (row.img == 1) {
                            return '<i class="fa fa-check" aria-hidden="true"></i>';
                        } else {
                            return '<i class="fa fa-times" aria-hidden="true"></i>';
                        }
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
        let datatable = $('#contractortable').DataTable(dtFullSettings);
    };





    manage_methods.editUser = function () {
        $(document).ready(function() {
            // If user click some link in table
            $('#contractortable tbody').on('click', 'a', function () {

                // Get link id
                let linkid = $(this).attr('id');

                // If link responsible for edit
                if (linkid.includes("editlink") === true) {

                    // Get user id, cuz link id refer userid. Id index = userid
                    let userid = linkid.replace('editlink', '');

                    // Show modal window for edit user info
                    $('#modaledit').modal('show');

                    // Get user info from AJAX and set to modal form
                    $.ajax({
                        url: "/faceid/AJAX/AJAX.php",
                        type: "POST",
                        data: {
                            method: "getManageUserInfo",
                            userid: userid
                        },
                        dataType: "JSON",
                        success: function (data) {

                            $('#firstnamemodal').val(data[0].firstname);
                            $('#lastnamemodal').val(data[0].lastname);
                            $('#patronymicmodal').val(data[0].patronymic);
                            $('#loginmodal').val(data[0].login);
                            $('#passwordmodal').val(data[0].password);
                            $('div.postselect select').val(data[0].postid).change();
                        }
                    });

                    $('#modaleditconfirm').on('click', function () {

                        let firstname = $('#firstnamemodal').val();
                        let lastname = $('#lastnamemodal').val();
                        let patronymic = $('#patronymicmodal').val();
                        let login = $('#loginmodal').val();
                        let password = $('#passwordmodal').val();
                        let postid = $('#postmodal').val();

                        $.ajax({
                            url: "/faceid/AJAX/AJAX.php",
                            type: "POST",
                            data: {
                                method: "editManageUser",
                                userid: userid,
                                firstname: firstname,
                                lastname: lastname,
                                patronymic: patronymic,
                                login: login,
                                password: password,
                                postid: postid
                            },
                            dataType: "JSON",
                            success: function () {
                                $('#modaleditconfirm').off();
                                $('#modaledit').modal('hide');
                                $('#contractortable').DataTable().ajax.reload();
                            }
                        });
                    });
                }
            });
        });
    }





    manage_methods.deleteUser = function () {
        $('#contractortable tbody').on('click', 'a', function () {
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
                            $('#contractortable').DataTable().ajax.reload();
                        }
                    });
                });
            };
        });
    }





    manage_methods.searchPost = function () {
        $(document).ready(function() {
            $('.select-post-show-manage').on('click', function () {
                if ($("#input_searchpost").length) {
                    $("#input_searchpost").remove();
                    $("#div_postedit").append('<input type="text" class="w-100 border border-info rounded shadow-none search-input-hide ml-5" id="input_searchpost" style="outline: none;">');
                } else {
                    $("#div_postedit").append('<input type="text" class="w-100 border border-info rounded shadow-none search-input-hide ml-5" id="input_searchpost" style="outline: none;">');
                }

                let input_searchpost = $('#input_searchpost');
                input_searchpost.focus();

                // If user starting search
                input_searchpost.on('input', function(){
                    //Getting search str
                    let input_search = input_searchpost.val();
                    // Send search str to ajax query
                    $.ajax({
                        url: "/faceid/AJAX/AJAX.php",
                        type: "POST",
                        data: {
                            method: "getPostSearch",
                            input_search: input_search
                        },
                        dataType: "JSON",
                        success: function (posts) {

                            // Get select
                            let adduser_post = $("#adduser_post");

                            //Remove all select options
                            adduser_post.find('option').remove();

                            // For each search results, add option
                            posts.forEach(post => (
                                adduser_post.append('<option class="postoption" value="' + post['id'] + '">' + post['name'] + '</option>')
                            ));

                            // Add multiple property to select
                            adduser_post.prop('multiple', true);
                        }
                    });
                });

                $(document).mouseup(function (e){
                    let input = $('.search-input-hide');
                    if (!input.is(e.target)){
                        input.hide();
                        $("#adduser_post").removeAttr("multiple");
                    }
                });

            });
        });
    }





    manage_methods.searchPostEdit = function () {
        $(document).ready(function() {
            $('.select-post-show').on('click', function () {
                if ($("#input_searchpost").length) {
                    $("#input_searchpost").remove();
                    $("#div_postedit_manage").append('<input type="text" class="w-100 border border-info rounded shadow-none search-input-hide" id="input_searchpost" style="outline: none;">');
                } else {
                    $("#div_postedit_manage").append('<input type="text" class="w-100 border border-info rounded shadow-none search-input-hide" id="input_searchpost" style="outline: none;">');
                }

                let input_searchpost = $('#input_searchpost');
                input_searchpost.focus();

                // If user starting search
                input_searchpost.on('input', function(){
                    //Getting search str
                    let input_search = input_searchpost.val();
                    // Send search str to ajax query
                    $.ajax({
                        url: "/faceid/AJAX/AJAX.php",
                        type: "POST",
                        data: {
                            method: "getPostSearch",
                            input_search: input_search
                        },
                        dataType: "JSON",
                        success: function (posts) {

                            // Get select
                            let input_post_edit = $("#input_post_edit");

                            //Remove all select options
                            input_post_edit.find('option').remove();

                            // For each search results, add option
                            posts.forEach(post => (
                                input_post_edit.append('<option class="postoption" value="' + post['id'] + '">' + post['name'] + '</option>')
                            ));

                            // Add multiple property to select
                            input_post_edit.prop('multiple', true);
                        }
                    });
                });

                $(document).mouseup(function (e){
                    let input = $('.search-input-hide');
                    if (!input.is(e.target)){
                        input.hide();
                        $("#input_post_edit").removeAttr("multiple");
                    }
                });

            });
        });
    }





    return manage_methods;
});