$(document).ready(function(){
    $.ajax({
        type: 'POST',
        url: '/resume',
        data: '_token = <?php csrf_token(); ?>',
        success: function (data) {
            console.log("A");
        }
    });
});

