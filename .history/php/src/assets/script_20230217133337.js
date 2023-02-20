$(document).ready(function() {
    var _output;
    const groupByList = (data) => {
        const result = data.reduce((acc, { name, product_name, quantity, created_date, end_date, priority }) => ({
        ...acc,
        [name]: {
        name,
        created_date,
        end_date,
        priority,
        products: [...(acc[name]?.products || []), { product_name, quantity }],
        },
        }), {});
        const output = Object.values(result);
        return output;
        };
    const loadData = (param) => {
        $.ajax({
            url: 'group_by_list.php',
            dataType: 'json',
            method: 'POST',
            data:{query: param},
            beforeSend: function() {
                $("#loading-image").show();
             },
            success: function(data) {
                console.log(data);
                _output = groupByList(data);
                console.log(_output);
                let content = $('#objects').empty() 
                $.each(_output, function(index, list) {
                    let div = $('<div>').addClass('col-lg-3 col-md-5 col-sm-5 mb-4 block_list ').attr('data-priority', list.priority);
                    let tittle = $('<h4>').addClass('mt-3 ms-3').text(list.name);
                    let hr = $('<hr>').addClass('');
                    let elements = $('<ul>').addClass('');
                    $.each(list.products, function(key, product) {
                        let listItem = $('<li>').addClass('').text(product.product_name + ' - ' + product.quantity);
                        elements.append(listItem);
                    });
                    let deleteButton = $('<button>').addClass('').attr('data-property', 'Delete').attr('data-product-id', index).text('Usuń');
                    let editButton = $('<button>').addClass('').attr('data-property', 'Edit').attr('data-product-id', index).text('Edytuj');
                    div.append(tittle, hr, elements, deleteButton, editButton);
                    content.append(div);
                });
                // ukrycie animacji ładowania
                $("#loading-image").hide();
            },
            error: function (jqXHR, exception){
                console.log(jqXHR, exception);
            }
        })
    }

    loadData()
    $(document).on("click", "Button[data-property=Edit]", function() {
        var productId = $(this).data('product-id');
        console.log(productId);
        var myModal = new bootstrap.Modal(document.getElementById("exampleModal"))
        // utworzenie tabeli
        var table = $('<table>').addClass('table');

  // utworzenie wiersza nagłówka
        var headerRow = $('<tr>');
        $('<th>').text('Id').appendTo(headerRow);
        $('<th>').text('Nazwa').appendTo(headerRow);
        $('<th>').text('Ilośc').appendTo(headerRow);
        $('<th>').text('Zdarzenie').appendTo(headerRow);
        table.append(headerRow);
        $.each(_output[productId].products, function(index, product) {
            console.log(index,product);
            var row = $('<tr>');
            $('<td>').text(index).appendTo(row);
            $('<td>').text(product.product_name).appendTo(row);
            $('<td>').text(product.quantity).appendTo(row);
            $('<td>').text('').appendTo(row);
            table.append(row);
        });

        var input_name = $('<input>').attr('type', 'text').attr('name', 'name');
        var input_quantity = $('<input>').attr('type', 'text').attr('name', 'quantity');
        var addButton = $('<button>').text('Add');
        $('<td>').appendTo(table);
        $('<td>').append(input).appendTo(table);
        $('<td>').append(input_quantity).appendTo(table)
        $('<td>').append(addButton).appendTo(table)
        $(".modal-body").empty().append(table);
    myModal.show();
    })

    $(document).on("click", "Button[data-property=Delete]", function() {
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
    $("#search").on("keyup change",function(){
        let inputVal = $(this).val();
        console.log(inputVal);
        if (inputVal.length != "") {
            loadData(inputVal)
        }else{
            loadData()
        }
    })
});

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
})

/*

$(document).on("click", "Button[data-property=Edit]", function() {
    console.log("asdas");
    var productId = $(this).data('product-id');
    var myModal = new bootstrap.Modal(document.getElementById("exampleModal"))
    let table = $('table').empty()
    $.each(_output, function(index, list) {
        let tr = $('<tr>').addClass('row');
        let td = $('<td>').addClass('col-3').text(list.name);
        let td2 = $('<td>').addClass('col-3').text(list.created_date);
        let td3 = $('<td>').addClass('col-3').text(list.end_date);
        let td4 = $('<td>').addClass('col-3').text(list.priority);
        tr.append(td, td2, td3, td4);
    });
    table.append(tr)
    $(".modal-body").html(table)
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


*/