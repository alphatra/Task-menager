
$(document).ready(function() {
    const catergories = {
        1: 'Elektronika',
        2: 'Meble',
        3: 'Kosmetyki',
        4: 'Jedzenie',
        5: 'Ubrania',
        6: 'Zabawki',
        7: 'Sport',
        8: 'Książki',
        9: 'Narzędzia',
        10: 'RTV'
    }
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
                console.log(dataItems);
                
                dataItems = dataItems.map((item) => {
                    console.log(item);
                    return $(`
                    <div class="col-lg-3 col-md-5 col-sm-5 mb-4">
      <div class="card">
        <div class="card-header img-atas" style="background-image: url('https://picsum.photos/300/100'); background-position: 50% 10%;">
        </div>
        <div class="card-body">
          <div class="row">
            <h5>${item.name}</h5>
          </div>
          <div class="row">
            <h6 class="text-secondary">${catergories[item.category_id]}</h6>
          </div>
          <div class="row">
            <div class="d-flex justify-content-between">
              <p class="text-primary">${item.product_description}</p>
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
    let loadDataExtended = (param) => {
        $.ajax({
            url: 'controller.php',
            dataType: 'json',
            method: 'POST',
            data:{tablename:"list", search: param, extended: true},
            beforeSend: function() {
                $("#loading-image").show();
             },
            success: function(data) {
                console.log(data);
                let content = $('#objects').empty() 
                let dataItems = JSON.parse(JSON.stringify(data))
                console.log(dataItems);
                
                dataItems = dataItems.map((item) => {
                    console.log(item);
                    return $(`
                    <div class="col-lg-3 col-md-5 col-sm-5 mb-4">
      <div class="card">
        <div class="card-header img-atas" style="background-image: url('https://picsum.photos/300/100'); background-position: 50% 10%;">
        </div>
        <div class="card-body">
          <div class="row">
            <h5>${item.name}</h5>
          </div>
          <div class="row">
            <h6 class="text-secondary">Data utworzenia: ${item.created_date}</h6>
          </div>
          <div class="row">
            <input class="btn btn-primary" id="Edit_list" type="button" value="Edytuj">
            <input class="btn btn-secondary" id="Delete_list" type="button" value="Usuń">
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
    loadDataExtended()
    $("#search").on("keyup change",function(){
        let inputVal = $(this).val();
        if (inputVal.length != "") {
            loadData(param = inputVal)
        }else{
            loadData()
        }
    })
})