$(document).ready(function() {
    var Data;
    /*const groupByList = (data) => {
        const result = data.reduce((acc, { name, idl, product_name, quantity, created_date, end_date, priority }) => ({
        ...acc,
        [name]: {
        name,
        created_date,
        end_date,
        priority,
        idl,
        products: [...(acc[name]?.products || []), { product_name, quantity,idl }],
        },
        }), {});
        const output = Object.values(result);
        return output;
        };*/
        
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
                let content = $('#objects').empty()
                Data = data; 
                $.each(data, function(index, list) {
                    console.log(list);
                    let div = $('<div>').addClass('col-lg-3 col-md-5 col-sm-5 mb-4 block_list ').attr('data-priority', list.priority);
                    let tittle = $('<h4>').addClass('mt-3 ms-3').text(list.name);
                    let hr = $('<hr>').addClass('');
                    let elements = $('<ul>').addClass('');
                    $.each(list.products, function(key, product) {
                        let listItem = $('<li>').addClass('').text(product.name + ' - ' + product.quantity);
                        elements.append(listItem);
                    });
                    let deleteButton = $('<button>').addClass('').attr('data-property', 'Delete').attr('data-listid', list.id).text('Usuń');
                    let editButton = $('<button>').addClass('').attr('data-property', 'Edit').attr('data-product-id', index).text('Edytuj');
                    div.append(tittle, hr, elements, deleteButton, editButton);
                    content.append(div);
                });
                // ukrycie animacji ładowania
                $("#loading-image").hide();
            },
            error: function (xhr, status, error){
                console.log(xhr);
                console.log('Status: ' + status + ', Error: ' + error);
            }
        })
    }

    loadData()
    $(document).on("click", "button[data-property='Edit']", function() {
        var productId = $(this).data('product-id');
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
    
        // dodanie istniejących rekordów
        $.each(Data[productId].products, function(index, product) {
            var row = $('<tr>');
            let input_name = $('<input>').attr('type', 'text');
            let input_quantity = $('<input>').attr('type', 'number').attr('pattern','[0-9]+').attr('min', '1').attr('max', '100').attr('inputmode', 'numeric');
            let deleteButton = $('<button>').text('Usuń').attr('data-property', 'Delete-item').attr('data-index', product.id);
            let setButton = $('<button>').text('Ustaw').attr('data-property', 'Set-item').attr('data-index', product.id);
            $('<td>').text(index).appendTo(row);
            $('<td>').append(input_name.attr('value',product.name).attr('org-name', 'name')).attr('index',index).appendTo(row);
            $('<td>').append(input_quantity.attr('value', product.quantity).attr('org-name', 'quantity')).appendTo(row);
            $('<td>').append(setButton,deleteButton).appendTo(row);
            table.append(row);
            /*====== USUWANIE REKORDU UI ======*/
            //usuwanie rekordu z tabeli na bieżąco
            deleteButton.on('click', function() {
                $(this).closest('tr').remove();
                updateRowIndexes();
            });
            //aktualizacja jego numerka
            function updateRowIndexes() {
                table.find('tr').each(function(index, row) {
                    $(row).find('td').eq(0).text(index);
                });
            }
            /*=================================*/
        });
        // dodanie wiersza z polami do wypełnienia i przyciskiem "Dodaj"

        var newRow = $('<tr>');
        let input_name = $('<input>').attr('type', 'text').attr('name', 'name').attr('placeholder', 'Dodaj nowy produkt');
        let input_quantity = $('<input>').attr('type', 'number').attr('name','quantity').attr('value','1').attr('pattern','[0-9]+').attr('min', '1').attr('max', '100').attr('inputmode', 'numeric');
        let addButton = $('<button>').text('Dodaj').attr('data-property', 'Add').attr('data-product-id', Data[productId].products.length).attr('data-list-name', Data[productId].name);
        $('<td>').text(Data[productId].products.length).appendTo(newRow);
        $('<td>').append(input_name).appendTo(newRow);
        $('<td>').append(input_quantity).appendTo(newRow);
        $('<td>').append(addButton).appendTo(newRow);
        table.append(newRow);
        

        $(".modal-body").empty().append(table);
        myModal.show();
        $(document).on("click", ".btn-secondary, .btn-close", function() {
            myModal.hide();
        });
    });
    

    $(document).on("click", "Button[data-property=Delete]", function() {
        let listId = $(this).data('listid');
        console.log(listId);
        $.ajax({
            url: "delete_list.php",
            type: "post",
            data: {id: listId},
            success: function(result) {
                console.log(result);
                loadData()
            }
        });
    });

    $(document).on("click", "Button[data-property=Delete-item]", function() {
        let idItem = $(this).data('index');
        console.log(idItem);
        $.ajax({
            url: "deleteItem_list.php",
            type: "post",
            data: {id: idItem},
            success: function(result) {
                console.log(result);
                loadData()
            }
        });
    });

    $(document).on("click", "button[data-property=Set-item]", function() {
        var index = $('td:nth-child(2)', $(this).closest('tr')).attr('index');
        // pobieranie wartości z inputów w wierszu
        var productId = $(this).data('index');
        var name = $('input[org-name=name]', $(this).closest('tr')).val();
        var quantity = $('input[org-name=quantity]', $(this).closest('tr')).val();
        console.log(productId, name, +quantity);
        $.ajax({
            url: "updateItem_list.php",
            type: "post",
            data: {id: productId, name: name, quantity: quantity},
            success: function(result) {
                console.log(result);
                loadData()
            }
        }); 
    });

    $(document).on("click", "Button[data-property=Add]", function() {
        const list_name = $(this).data('list-name');
        const id = $(this).data('product-id');
        const name = $('input[name=name]').val();
        const qty = $('input[name=quantity]').val();
      
        console.log(list_name, name, qty);
        $.ajax({
          url: "addTo_list.php",
          type: "post",
          data: { list: list_name, product_name: name, quantity: qty },
          success: function(result) {
            
            let table = $('table');
            let row = $('<tr>');
            $('<td>').text(id).appendTo(row);
            $('<td>').text(name).appendTo(row);
            $('<td>').text(qty).appendTo(row);
            $('<td>').text('').appendTo(row);
            row.appendTo(table);
            loadData(); 
          }
        });
      });
      

    $("#search").on("keyup change",function(){
        let inputVal = $(this).val();
        console.log(inputVal);
        if (inputVal.length != "") {
            loadData(param = inputVal)
        }else{
            loadData()
        }
    })
});