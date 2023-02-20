<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
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
        
        console.log(catergories);
        
            let _dataItems = [];
            let private_item = $(`<div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Nowy element</h3>
                                Nazwa: 
                                <input type="text" class="form-control mb-2" id="priv_item" placeholder="Nazwa przedmiotu">
                                Kategoria: <select id="privItem_category" class="form-select">
                                    <option selected>Wybierz kategorię</option>
                            
                                    </select>
                                <input class="btn btn-primary mt-2" id="add_tolist" type="button" value="Dodaj">
                            </div>
                        </div>
                    </div>`);
    let loadData = (param,_category) => {
        $.ajax({
            url: '../controller.php',
            dataType: 'json',
            method: 'POST',
            data:{tablename:"products", search: param, category:_category},
            beforeSend: function() {
                $("#loading-image").show();
             },
            success: function(data) {
                console.log(data);
                let content = $('#objects').empty()
                content.append(private_item)
                let dataItems = JSON.parse(JSON.stringify(data))
                _dataItems = data
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
    let createList_Ajax = (param) =>{
        $.ajax({
            url: '../controller_1.php',
            method: 'POST',
            data:{data: param},
            cache: false,
            success: function(data) {
                console.log(data);
            },
            error: function (xhr, status, error){
                console.log(status);

            }
        })
    }
    let createListItems_Ajax = (param) =>{
        $.ajax({
            url: '../controller_1.php',
            method: 'POST',
            data:{data: param},
            cache: false,
            success: function(data) {
                console.log(data);
            },
            error: function (xhr, status, error){
                console.log(status);

            }
        })
    }

    loadData()
    let makecategoris = () => {
        $.each(catergories, function(i, item) {
                $('#categorySelect').append($("<option>", {
                    value: i,
                    text: item
                }))
                $('#privItem_category').append($("<option>", {
                    value: item,
                    text: item
                }))})
    }
    makecategoris()
    $("#searchItem, #categorySelect").on("keyup change", function() {
        let inputVal = $("#searchItem").val();
        //console.log(inputVal);
        let selectVal = $("#categorySelect").val();
        console.log(selectVal);
        if (inputVal.length > 0 || selectVal > 0) {
            inputVal = inputVal.length == 0 ? '' : inputVal;
            selectVal = selectVal == 0 ? '' : selectVal;
            loadData(inputVal, selectVal);
        } else {
            loadData();
        }
    });
    let products = {product_id:[],product_title:[],qty:[]};
    let list = {
            list_name: '',
            end_date: '',
            products: [products]
        };

    let add_products = (id, title, quantity) => {
        if (!checkIfExists(id)) {
            products.product_id.push(id);
            products.product_title.push(title);
            products.qty.push(quantity);
        }
    }

    let checkIfExists = (id) => {
        for (let i = 0; i < products.product_id.length; i++) {
            if (products.product_id[i] === id) {
                return true;
            }
        }
        return false;
    }

    let searchedProduct = (_id) =>{
        let found =  _dataItems.find(e => e.id_product == _id)
        return found.product_name
    }

    let generateContent = (_item,_qty) => {
        let content = $('#list_elements')
        content.empty()
        console.log(_qty);
        let listItems = _item.map((item) => { 
            return $(`
            <h5>${searchedProduct(+item)}</h5>
            <input type="number" id="qty" value="1" class="form-control form-icon-trailing" />
            `)})
        content.append(listItems)
    }

    let crateList = () => {
        if(list.list_name != '' || list.end_date != '' || products.product_id.length != 0){
            console.log(list);
            createList_Ajax(list)
        }
    }
    $(document).on("click", "#add_tolist", function() {
        //console.log(list);
        //console.log(+this.name);
        //console.log(searchedProduct(+this.name));
        var productId = $(this).data('product-id');
        var productName = $(this).data('product-name');
        var productQuantity = $(this).data('product-quantity');
    
        console.log("Id produktu: " + productId);
        console.log("Nazwa produktu: " + productName);
        console.log("Ilość produktu: " + productQuantity);
        // Obsługa okienka modalnego z bootstrapa
        var myModal = new bootstrap.Modal(document.getElementById("exampleModal"))
        if(list.list_name == '' || list.end_date == ''){
            myModal.show()
            $(document).on("click", ".btn-secondary", function() {
                myModal.hide()
            })
            if (list.list_name == '') {
                $("#listName").addClass("is-invalid")
            }else{
                $("#listName").removeClass("is-invalid")
            }
            if (list.end_date == '') {
                $("#endDate").addClass("is-invalid")
            }else{
                $("#endDate").removeClass("is-invalid")
            }
            //console.log("Nie",list)
        }else{
            add_products(productId, productName, productQuantity);
            generateContent(list.products['product_id'],list.products['qty'])
            $("#listName, #endDate").removeClass("is-invalid")
            //console.log("Tak",list);
        }
    });
    $(document).on("click", "#crateList_button", function() {
        console.log(crateList());
    });
    $("#listName, #endDate").on("keyup change",function(){
        list = {
            list_name: $("#listName").val(),
            end_date: $("#endDate").val(),
            products: products
        }
        $("#list_name").text($("#listName").val());
        $("#end_date").text($("#endDate").val());
    });
})

    </script>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Uwaga!</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Zamknij"></button>
                </div>
                <div class="modal-body">
                    Nie wypełniłeś wszystkich pól!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="/">Listy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="views/createList.php">Kreator list</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="views/createProduct.php">Kreator produktów</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col-lg-9" style="background-color: #F4F4F4; border-top-right-radius: 1rem">
                <div class="container py-4 px-4">
                <form class="row g-3 needs-validation" novalidate>
                    <div id="listName_" class="col-md-3">
                        <label for="listName" class="form-label">Nazwa Listy</label>
                        <input type="text" class="form-control" id="listName" required>
                        <div class="invalid-feedback">
                            Podaj nazwę listy!
                        </div>
                    </div>
                    <div id="endDate_" class="col-md-3">
                        <label for="endDate" class="form-label">Data zakończenia</label>
                        <input type="date" class="form-control" id="endDate" required>
                        <div class="invalid-feedback">
                            Podaj nazwę listy!
                        </div>
                    </div>
                    <div id="searchItem_" class="col-md-4">
                        <label for="searchItem" class="form-label">Wyszukaj element z listy</label>
                        <input type="search" class="form-control" id="searchItem" aria-label="Search" placeholder="Wyszukaj po nazwie">
                    </div>
                    <div class="col-md-2">
                        <label for="categorySelect" class="form-label">Kategoria</label>
                        <select id="categorySelect" class="form-select">
                            <option selected value="0">Wszystkie</option>
                            
                        </select>
                    </div>
                </form>
                <div id="objects" class="row m-0 mt-5"></div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="container pt-4">
                <h3 id="list_name">Nazwa Listy</h3>
                <span id="end_date">Data zakończenia</span>
                <hr class="hr1" />
                <div id="list_elements" class="px-3 py-3" style="background-color:#D9D9D9"></div>
                <hr class="hr1" />
                <button type="submit" id="crateList_button" class="btn btn-primary">Uwtórz listę</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>