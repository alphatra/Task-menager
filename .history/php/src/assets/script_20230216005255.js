
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
            url: 'group_by_list.php',
            dataType: 'json',
            method: 'POST',
            data:{search: param},
            beforeSend: function() {
                $("#loading-image").show();
             },
            success: function(data) {
                
                let _data = groupByList(data);
                console.log(_data);
                let content = $('#objects').empty() 
                $.each(_data, function(listName, items) {
                    let table = $('<table>').addClass('table');
                    let caption = $('<caption>').text(items);
                    table.append(caption);
                    let thead = $('<thead>').append($('<tr>').append($('<th>').text('Product Name'), $('<th>').text('Quantity')));
                    table.append(thead);
                    let tbody = $('<tbody>');
                    $.each(items, function(index, item) {
                        let tr = $('<tr>');
                        let productName = item.product_name || '';
                        let quantity = item.quantity || '';
                        tr.append($('<td>').text(productName), $('<td>').text(quantity));
                        tbody.append(tr);
                    });
                    table.append(tbody);
                    content.append(table);
                });
                // ukrycie animacji ładowania
                $("#loading-image").hide();
                let dataItems = _data.map((item) => {
                    //console.log(Object.keys(item),item);
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
            <h6 class="text-secondary">Data utowrzenia: ${item.created_date}</h6>
          </div>
          <div class="row">
            <input class="btn btn-primary" id="Edit_list" type="button" value="Edytuj">
            <input class="btn btn-secondary" id="Delete_list" type="button" value="Usuń" data-product-id="${item.id}">
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
    $("#Edit_list").on("click",function(){
    })
    $("#Delete_list").on("click",function(){
        console.log("asd");
    })
})

let groupByList = (data) => {
    const result = data.reduce((acc, { name, product_name, quantity }) => ({
        ...acc,
        [name]: [...(acc[name] || []), { product_name, quantity }],
    }), {});
    const output = Object.entries(result).map(([name, values]) => ({ [name]: values }));
    return output;
}

$(document).on("click", "#Edit_list", function() {
    var productId = $(this).data('product-id');
    var myModal = new bootstrap.Modal(document.getElementById("exampleModal"))
    myModal.show();

    $(document).on("click", ".btn-secondary", function() {
        myModal.hide()
    })
    $.ajax({
        url: 'edit_list.php',
        dataType: 'json',
        method: 'POST',
        data:{list_id: productId},
        beforeSend: function() {
            $("#loading-image").show();
         },
        success: function(data) {
            console.log(data);
            let content = $('#objects').empty() 
            let dataItems = JSON.parse(JSON.stringify(data))
            console.log(dataItems);}
        })
});

$(document).on("click", "#Delete_list", function() {
    var productId = $(this).data('product-id');
    console.log(productId);
    $.ajax({
        url: "delete_list.php",
        type: "post",
        data: {list_id: productId},
        success: function(result) {
            // wykonaj kod po usunięciu listy
        }
    });
}); 