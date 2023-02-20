
$(document).ready(function() {
    let loadData = (param) => {
        $.ajax({
            url: 'controller.php',
            dataType: 'json',
            method: 'POST',
            data:{tablename:"list", search: param},
            beforeSend: function() {
                $("#loading-image").show();
             },
            success: function(data) {
                console.log(data);
                let content = $('#objects').empty() 
                let dataItems = JSON.parse(JSON.stringify(data))
                dataItems = dataItems.map((item) => {
                    return $(`
                    <div class="col-lg-3 col-md-5 col-sm-5 mb-4">
      <div class="card">
        <div class="card-header img-atas" style="background-image: url('https://picsum.photos/300/100'); background-position: 50% 10%;">
        </div>
        <div class="card-body">
          <div class="row">
            <h5>${item.product_name}</h5>
          </div>
          <div class="row">
            <h6 class="text-secondary">${catergories[item.category_id]}</h6>
          </div>
          <div class="row">
            <div class="d-flex justify-content-between">
              <p class="text-primary">${item.product_description.substring(0, 29)}</p>
              <p class="text-warning">
		<input class="btn btn-primary" id="add_tolist" type="button" value="Dodaj" data-product-id="${item.id_product}" data-product-name="${item.product_name}" data-product-quantity="1">
		</p>
            </div>
          </div>
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
    $("#search").on("keyup change",function(){
        let inputVal = $(this).val();
        if (inputVal.length != "") {
            loadData(param = inputVal)
        }else{
            loadData()
        }
    })
})