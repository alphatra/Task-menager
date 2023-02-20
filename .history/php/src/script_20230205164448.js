
$(document).ready(function() {
    let loadData = (param) => {
        $.ajax({
            url: 'controller.php',
            dataType: 'json',
            method: 'GET',
            data:{search: param},
            beforeSend: function() {
                $("#loading-image").show();
             },
            success: function(data) {
                console.log(data);
                let content = $('#objects').empty() 
                let dataItems = JSON.parse(JSON.stringify(data))
                dataItems = dataItems.map((item) => {
                    return $(`
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="badge bg-success">${item.name}</span>
                                <h3 class="card-title">javascript</h3>
                                <h6 class="card-subtitle mb-2 text-muted">Programming language</h6>
                                <p class="card-text">JavaScript, often abbreviated as JS</p>
                            </div>
                        </div>
                    </div>
                    `)
                })
                content.append(dataItems)
            },
            error: function (jqXHR, exception){
                console.log(jqXHR, exception);

            }
        })
        
    }
    loadData()
    $("#search").keyup(function(){
        let inputVal = $(this).val();
        if (inputVal.length >= 3) {
            console.log(inputVal);
        }else{
            console.log(inputVal);
        }
    })
})