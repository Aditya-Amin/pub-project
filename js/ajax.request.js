$(document).ready(function () {
    // create courses

    $('#create').click(function () {
        var courseName = $('#recipient-name').val().trim();
        var courseTitle = $('#recipient-title').val().trim();
        if( courseName == '' || courseTitle == ''){
            $('#error').html('<span class="text-danger">Filed must not be empty!</span>');
        }else{
            var obj = { create: "create", name: courseName, title: courseTitle}
            ajax(obj, 'POST', 'ajax/create.course.php', '#error');
            setTimeout(function(){
                window.location.reload();
            },3000);
        }
    })
})