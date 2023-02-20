
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
                $.each(_data, function(key, value) {
                    $.each(value, function(index, item) {
                        console.log(index, item);
                        let div = $('<div>').addClass('col-lg-3 col-md-5 col-sm-5 mb-4');
                        let tittle = $('<h4>').text(index);
                        let list = $('<ul>').addClass('list-group');
                        $.each(item, function(key, value) {
                            let listItem = $('<li>').addClass('list-group-item').text(value.product_name + ' - ' + value.quantity);
                            list.append(listItem);
                        });
                        div.append(tittle, list);
                        content.append(div);
                    });
                });
                // ukrycie animacji ładowania
                $("#loading-image").hide();
            },
            error: function (jqXHR, exception){
                console.log(jqXHR, exception);

            }
        })
        
    }
    loadData('h')
    $("#search").on("keyup change",function(){
        let inputVal = $(this).val();
        console.log(inputVal);
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