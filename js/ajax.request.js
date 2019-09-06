$(document).ready(function () {
    // create courses

    $('#create').click(function () {
        var courseName = $('#recipient-name').val().trim();
        var courseTitle = $('#recipient-title').val().trim();
        if (courseName == '' || courseTitle == '') {
            $('#error').html('<span class="text-danger">Filed must not be empty!</span>');
        } else {
            var obj = {
                create: "create",
                name: courseName,
                title: courseTitle
            }
            ajax(obj, 'POST', 'ajax/create.course.php', '#error');
            setTimeout(function () {
                window.location.reload();
            }, 3000);
        }
    })

    // upload photo
    $('#file').on('change', function () {
        var file = document.getElementById('file').files[0];
        var fileExt = file.name.split('.').pop().toLowerCase();
        var fileSize = file.size;
        if ($.inArray(fileExt, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            $('#showErr').html(
                '<span class="alert alert-danger m-auto d-block text-center">Image is not valid!</span>');
        } else if (fileSize > 2000000) {
            $('#showErr').html(
                '<span class="alert alert-danger m-auto d-block text-center">Image is too large!</span>');
        } else {
            var formData = new FormData();
            formData.append('file', file);
            $.ajax({
                url: 'ajax/file.upload.php',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    $('.up-img').html(response);
                }
            })
        }
    })


    var file;
    var fileSize;

    $("#upload-file").on('change', function () {
        file = document.getElementById('upload-file').files[0];
        fileSize = file.size / 1000;
        fileName = file.name;
        $('#showFileName').text(fileName + '(' + fileSize + 'Kbs)');
    })

    $('#publish').click(function () {
        var courseCode = $('#course_code').val();
        var contents = $('#contents').val().trim();
        var shift = $('#selectShift').val();
        if (fileSize > 20000000) {
            $('#showErr').html(
                '<span class="alert alert-danger m-auto d-block text-center">File is too large!</span>');
        } else if (contents == '') {
            $('#showErr').html(
                '<span class="alert alert-danger m-auto d-block text-center">Field Must Not be Empty!</span>');
        } else {
            var formData = new FormData();
            formData.append('file', file);
            formData.append('contents', contents);
            formData.append('code', courseCode);
            formData.append('shift', shift);
            formData.append('post', "post");
            $.ajax({
                url: 'ajax/create.post.php',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    $('#show').html(response);
                    $('#exampleModal').modal('show');
                    setTimeout(function(){
                        window.location.reload();
                    },1000);
                }
            })
        }
    })

    $('#designation').on('keypress', function(e){
        if(e.which === 13){
            var designation = $(this).text().trim();
            var obj = { update:1, designation: designation}
            if(designation == ''){
                $('#showErr').html('<span class="alert alert-danger">Field Must Not Be Empty!</span>');
            }else{
                ajax(obj, 'POST', 'ajax/create.course.php', '#showErr');
                setTimeout(function(){
                    window.location.reload();
                },1000)
            }
        }
    })
})