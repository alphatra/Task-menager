<?php
require_once('../model/CRUD.php');
if(isset($_POST['data'])){
    echo "ta";
    echo $_POST['data'];
    $data = $_POST['data'];
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jsql/3.6.1/jsql.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            let _dataItems = [];
    let loadData = (param) => {
        $.ajax({
            url: '../controller.php',
            dataType: 'json',
            method: 'POST',
            data:{tablename:"products", search: param},
            beforeSend: function() {
                $("#loading-image").show();
             },
            success: function(data) {
                console.log(data);
                let content = $('#objects').empty() 
                let dataItems = JSON.parse(JSON.stringify(data))
                _dataItems = data
                dataItems = dataItems.map((item) => {
                    return $(`
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="badge bg-success">${item.product_name}</span>
                                <h3 class="card-title">${item.product_name}</h3>
                                <h6 class="card-subtitle mb-2 text-muted">${item.category_id}</h6>
                                <p class="card-text">${item.product_description}</p>
                                <input class="btn btn-primary" id="add_tolist" type="button" value="Dodaj" name="${item.id_product}">
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

    $("#searchItem").on("keyup change",function(){
        let inputVal = $(this).val()
        console.log(inputVal)
        if (inputVal.length != "") {
            loadData(inputVal)
        }else{
            loadData()
        }
    })

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

    let generateContent = (_item) => {
        let content = $('#list_elements')
        content.empty()
        let listItems = _item.map((item) => { return $(`<h5>${searchedProduct(+item)}</h5>`)})
        content.append(listItems)
    }

    let crateList = () => {
        if(list.list_name != '' || list.end_date != '' || products.product_id.length != 0){
            console.log(list);
            createList_Ajax(list)
        }
    }
    let crateListItems = () => {
        
    }
    $(document).on("click", "#add_tolist", function() {
        //console.log(list);
        //console.log(+this.name);
        //console.log(searchedProduct(+this.name));
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
            add_products(this.name, searchedProduct(+this.name), 1);
            generateContent(list.products['product_id'])
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
        Nie wype??ni??e?? wszystkich p??l!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
      </div>
    </div>
  </div>
</div>

    <div class="d-sm-flex flex-column">
        <div class="black-border">
            <a href="/">Listy</a>
            <a href="views/createList.php">Stw??rz List??</a>
            <a href="views/createProduct.php">Stw??rz Produkt</a>
        </div>
        <div class="d-sm-flex flex-row">
            <div class="black-border">
                <form class="row g-3 needs-validation" novalidate>
                    <div id="listName_" class="col-md-3">
                        <label for="listName" class="form-label">Nazwa Listy</label>
                        <input type="text" class="form-control" id="listName" required>
                        <div class="invalid-feedback">
                            Podaj nazw?? listy!
                        </div>
                    </div>
                    <div id="endDate_" class="col-md-3">
                        <label for="endDate" class="form-label">Data zako??czenia</label>
                        <input type="date" class="form-control" id="endDate" required>
                        <div class="invalid-feedback">
                            Podaj nazw?? listy!
                        </div>
                    </div>
                    <div id="searchItem_" class="col-md-4">
                        <label for="searchItem" class="form-label">Wyszukaj element z listy</label>
                        <input type="search" class="form-control" id="searchItem" aria-label="Search" placeholder="Wyszukaj po nazwie">
                    </div>
                </form>
                    <div id="objects" class="row m-0 mx-5 my-5"></div>
            </div>
            <div class="black-border flex-shrink-1 flex-grow m-10">
                <h3 id="list_name">Nazwa Listy</h3>
                <span id="end_date">Data zako??czenia</span>
                <hr class="hr" />
                <div id="list_elements"></div>
                <hr class="hr" />
                <button type="submit" id="crateList_button" class="btn btn-primary mx-10 px-10">Uwt??rz list??</button>
                
            </div>
        </div>
    </div>
</body>
</html>