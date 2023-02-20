$(document).ready(function() {

    function loadData(param) {
        $.ajax({
            url: 'php/src/getData.php',
            dataType: 'json',
            method: 'GET',
            data:{search: param},
            success: function(data) {
                $.each(data, function (i, list) {
                    console.log(list);
                })
            }
        })
    }
})

$(document).ready(function() {
        loadData()
});