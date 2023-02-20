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
            data:{query: param},
            beforeSend: function() {
                $("#loading-image").show();
             },
            success: function(data) {
                console.log(data);
                let _data = groupByList(data);
                console.log(_data);
                let content = $('#objects').empty() 
                $.each(_data, function(key, value) {
                    console.log(key, value);
                    $.each(value, function(index, item) {
                        console.log(index, item);
                        let div = $('<div>').addClass('col-lg-3 col-md-5 col-sm-5 mb-4').attr('data-priority', index);
                        let tittle = $('<h4>').text(index);
                        let list = $('<ul>').addClass('');
                        $.each(item, function(key, value) {
                            let listItem = $('<li>').addClass('').text(value.product_name + ' - ' + value.quantity);
                            list.append(listItem);
                        });
                        let editButton = $('<button>').addClass('').attr('id', 'Edit_list').attr('data-product-id', index).text('Edytuj');
                        let deleteButton = $('<button>').addClass('').attr('id', 'Delete_list').attr('data-product-id', index).text('Usuń');
                        div.append(tittle, list, editButton, deleteButton);
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

    $("#Edit_list").on("click",function(){

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