$(document).ready(function() {
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
            data:{sql: param},
            beforeSend: function() {
                $("#loading-image").show();
             },
            success: function(data) {
                console.log(data);
                const output = groupByList(data);
                console.log(output);
                let content = $('#objects').empty() 
                $.each(output, function(index, list) {
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

    $("#search").on("keyup change",function(){
        let inputVal = $(this).val();
        console.log(inputVal);
        if (inputVal.length != "") {
            loadData(inputVal)
        }else{
            loadData()
        }
    })
    $("button").on("click",function(){
        alert("asd");
    })
    $("#Edit").on("click",function(){
        alert("asd");
    })

    $("#Delete_list").on("click",function(){
        console.log("asd");
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