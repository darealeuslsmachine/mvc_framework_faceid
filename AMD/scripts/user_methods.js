define([
    'jquery',
    'jquery_mask'
], function($,jquery_mask) {

    let user_methods = {};





    user_methods.showPassUserProfile = function () {

        $('#chkshowpass_profile').on('click', function () {

            let inputPass = $('#inputpass_profile');

            (inputPass.attr('type') === "password") ? inputPass.prop("type", "text") : inputPass.prop("type", "password");
        });
    };





    user_methods.phoneMask = function () {
        $('#input_phone_edit').mask('+7 (000) 000-00-00');
    };





    user_methods.showPassUserEdit = function () {

        $('#chk_showpass_edit').on('click', function () {

            let inputPass = $('#input_pass_edit');

            (inputPass.attr('type') === "password") ? inputPass.prop("type", "text") : inputPass.prop("type", "password");
        });
    };





    user_methods.showUploadedPhoto = function () {
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





    user_methods.searchPostParent = function () {
        $(document).ready(function() {
            // If parents select on click
            $('.select-postedit-show').on('click', function () {

                let elementid = $(this).attr('id'); //Getting select id
                let id = elementid.replace('edit_selectpost', ''); //Post id

                // If parents already searched
                if ($("#input_searchpost").length) {
                    $("#input_searchpost").remove();
                    $('#div_postedit' + id).append('<input type="text" class="w-100 border border-info rounded shadow-none search-input-hide" id="input_searchpost" style="outline: none;">');
                } else {
                    $('#div_postedit' + id).append('<input type="text" class="w-100 border border-info rounded shadow-none search-input-hide" id="input_searchpost" style="outline: none;">');
                }

                //Get search input
                let input_searchpost = $('#input_searchpost');
                input_searchpost.focus();

                // If user starting search
                input_searchpost.on('input', function(){
                    //Getting search str
                    let input_search = $('#input_searchpost').val();
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
                            let edit_selectpost = $('#edit_selectpost' + id);

                            //Remove all select options
                            edit_selectpost.find('option').remove();

                            // For each search results, add option
                            posts.forEach(post => (
                                edit_selectpost.append('<option class="postoption" value="' + post['id'] + '">' + post['name'] + '</option>')
                            ));

                            // Add multiple property to select
                            edit_selectpost.prop('multiple', true);
                        }
                    });
                });

                // If user click behind div - hide the search input and options
                $(document).mouseup(function (e){
                    let input = $('.search-input-hide');
                    if (!input.is(e.target)){
                        input.hide();
                        $('#edit_selectpost' + id).removeAttr("multiple");
                    }
                });
            });


            // If parents select on click
            $('.select-parentedit-show').on('click', function () {

                let elementid = $(this).attr('id'); //Getting select id
                let id = elementid.replace('edit_selectparent', ''); //Post id

                // If posts already searched
                if ($("#input_searchparent").length) {
                    $("#input_searchparent").remove();
                    $('#div_parentedit' + id).append('<input type="text" class="w-100 border border-info rounded shadow-none search-input-hide" id="input_searchparent" style="outline: none;">');
                } else {
                    $('#div_parentedit' + id).append('<input type="text" class="w-100 border border-info rounded shadow-none search-input-hide" id="input_searchparent" style="outline: none;">');
                }

                //Get search input
                let input_searchparent = $('#input_searchparent');
                input_searchparent.focus();

                // If user starting search
                input_searchparent.on('input', function(){
                    //Getting search str
                    let input_search = $('#input_searchparent').val();
                    // Send search str to ajax query
                    $.ajax({
                        url: "/faceid/AJAX/AJAX.php",
                        type: "POST",
                        data: {
                            method: "getParentSearch",
                            input_search: input_search
                        },
                        dataType: "JSON",
                        success: function (parents) {

                            // Get select
                            let edit_selectparent = $('#edit_selectparent' + id);

                            //Remove all select options
                            edit_selectparent.find('option').remove();

                            // For each search results, add option
                            parents.forEach(parent => (
                                edit_selectparent.append('<option class="parentoption" value="' + parent['id'] + '">' + parent['fullname'] + '</option>')
                            ));

                            // Add multiple property to select
                            edit_selectparent.prop('multiple', true);
                        }
                    });
                });

                // If user click behind div - hide the search input and options
                $(document).mouseup(function (e){
                    let input = $('.search-input-hide');
                    if (!input.is(e.target)){
                        input.hide();
                        $('#edit_selectparent' + id).removeAttr("multiple");
                    }
                });
            });
        });
    };


    user_methods.deleteSubordination = function () {
        $(document).ready(function() {
            $('.delete-subordination').on('click', function (){

                let elementid = $(this).attr('id'); //Getting select id
                let id = elementid.replace('delete_subordination', ''); //Post id

                result = confirm('Удалить связь?');
                if (result === true) {
                    $.ajax({
                        url: "/faceid/AJAX/AJAX.php",
                        type: "POST",
                        data: {
                            method: "deleteParent",
                            subordination: id
                        },
                        dataType: "JSON",
                        complete: function (data) {
                            console.log(data);
                            $('#subordination' + id).remove();
                        }
                    });
                }
            });
        });
    };





    user_methods.saveSubordination = function () {
        $(document).ready(function() {
            $('.save-subordination').on('click', function (){

                let elementid = $(this).attr('id'); //Getting select id
                let id = elementid.replace('save_subordination', ''); //Post id

                result = confirm('Сохранить связь?');
                if (result === true) {

                    let subid =  $('#inputhidden_subid').val();
                    let postid = $('#edit_selectpost' + id).val();
                    let parentid = $('#edit_selectparent' + id).val();
                    let userid = $('#inputhidden_userid').val();

                    $.ajax({
                        url: "/faceid/AJAX/AJAX.php",
                        type: "POST",
                        data: {
                            method: "editSubordination",
                            subid: subid,
                            userid: userid,
                            parentid: parentid,
                            postid: postid
                        },
                        dataType: "JSON",
                        complete: function () {
                            alert('Специальность отредактирована!');
                            location.reload();
                        }
                    });
                }
            });
        });
    };





    user_methods.addSubordination = function () {
        $(document).ready(function() {

            // Select post
            $('#select_addPost').on('click', function () {
                if ($("#input_searchpost").length) {
                    $("#input_searchpost").remove();
                    $('#div_addPost').append('<input type="text" class="w-100 border border-info rounded shadow-none search-input-hide" id="input_searchpost" style="outline: none;">');
                } else {
                    $('#div_addPost').append('<input type="text" class="w-100 border border-info rounded shadow-none search-input-hide" id="input_searchpost" style="outline: none;">');
                }

                let input_searchpost = $('#input_searchpost');
                input_searchpost.focus();

                // If user starting search
                input_searchpost.on('input', function(){
                    //Getting search str
                    let input_search = $('#input_searchpost').val();
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
                            let select_addPost = $('#select_addPost');

                            //Remove all select options
                            select_addPost.find('option').remove();

                            // For each search results, add option
                            posts.forEach(post => (
                                select_addPost.append('<option class="postoption" value="' + post['id'] + '">' + post['name'] + '</option>')
                            ));

                            // Add multiple property to select
                            select_addPost.prop('multiple', true);
                        }
                    });
                });

                // If user click behind div - hide the search input and options
                $(document).mouseup(function (e){
                    let input = $('.search-input-hide');
                    if (!input.is(e.target)){
                        input.hide();
                        $('#select_addPost').removeAttr("multiple");
                    }
                });
            });

            // Select parent
            $('#select_addParent').on('click', function () {
                if ($("#input_searchparent").length) {
                    $("#input_searchparent").remove();
                    $('#div_addParent').append('<input type="text" class="w-100 border border-info rounded shadow-none search-input-hide" id="input_searchparent" style="outline: none;">');
                } else {
                    $('#div_addParent').append('<input type="text" class="w-100 border border-info rounded shadow-none search-input-hide" id="input_searchparent" style="outline: none;">');
                }

                let input_searchparent = $('#input_searchparent');
                input_searchparent.focus();

                // If user starting search
                input_searchparent.on('input', function(){
                    //Getting search str
                    let input_search = $('#input_searchparent').val();
                    // Send search str to ajax query
                    $.ajax({
                        url: "/faceid/AJAX/AJAX.php",
                        type: "POST",
                        data: {
                            method: "getParentSearch",
                            input_search: input_search
                        },
                        dataType: "JSON",
                        success: function (parents) {
                            // Get select
                            let select_addParent = $('#select_addParent');

                            //Remove all select options
                            select_addParent.find('option').remove();

                            // For each search results, add option
                            parents.forEach(parent => (
                                select_addParent.append('<option class="parentoption" value="' + parent['id'] + '">' + parent['fullname'] + '</option>')
                            ));

                            // Add multiple property to select
                            select_addParent.prop('multiple', true);
                        }
                    });
                });

                // If user click behind div - hide the search input and options
                $(document).mouseup(function (e){
                    let input = $('.search-input-hide');
                    if (!input.is(e.target)){
                        input.hide();
                        $('#select_addPost').removeAttr("multiple");
                        $('#select_addParent').removeAttr("multiple");
                    }
                });
            });

            // If user click on link add subordination
            $('#add_SubordinationLink').on('click', function (){
                let postid = $('#select_addPost').val();
                let parentid = $('#select_addParent').val();
                let userid = $('#inputhidden_userid').val();

                if ((postid) && (parentid)) {

                    $.ajax({
                        url: "/faceid/AJAX/AJAX.php",
                        type: "POST",
                        data: {
                            method: "addParent",
                            userid: userid,
                            parentid: parentid,
                            postid: postid
                        },
                        dataType: "JSON",
                        success: function () {
                            alert('Специальность добавлена!');
                            location.reload();
                        }
                    });
                } else {
                    alert('Выберите специальность и руководителя!');
                }
            });
        });
    };




    return user_methods;
});