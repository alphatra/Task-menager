$(document).ready(function() {

    function loadData(param) {
        $.ajax({
            url: 'controller.php',
            dataType: 'json',
            method: 'GET',
            data:{search: param},
            beforeSend: function() {
                $("#loading-image").show();
             },
            success: function(data) {
                $.each(data, function (i, list) {
                    console.log(i, list);
                })
            }
        })
    }
})

$(document).ready(function() {
        loadData()
});