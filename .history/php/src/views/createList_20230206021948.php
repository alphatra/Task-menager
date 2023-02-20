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
        $(document).ready(function() {
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
                dataItems = dataItems.map((item) => {
                    return $(`
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="badge bg-success">${item.product_name}</span>
                                <h3 class="card-title">javascript</h3>
                                <h6 class="card-subtitle mb-2 text-muted">Programming language</h6>
                                <p class="card-text">JavaScript, often abbreviated as JS</p>
                                <input class="btn btn-primary" type="button" id="product_id" value="Dodaj" onclick="add_products(${item.id_product})" name="${item.id_product}">
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
    $("#searchItem").on("keyup change",function(){
        let inputVal = $(this).val()
        console.log(inputVal)
        loadData(param = inputVal)
        if (inputVal.length != "") {
            loadData(param = inputVal)
        }else{
            loadData()
        }
    })
    let products = [];
    let list = {};
    let add_products = (id) => {
        if (!products.includes(id)) {
            products.push(id);
        }
    }
    $(document).on("click", ".btn .btn-primary", function() {
        console.log(this);
    });
    $("#product_id").on("click","input",function(){
        
        console.log(this);
    });
    $(document).on("keyup change","input",function(){
        
        list = {
            list_name: $("#listName").val(),
            end_date: $("#endDate").val(),
            products: products
        }
        
        $("#list_name").text($("#listName").val());
        
        console.log(list);
    });
})

    </script>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="d-sm-flex flex-column">
        <div class="black-border">
            <a href="/">Listy</a>
            <a href="views/createList.php">Stwórz Listę</a>
            <a href="views/createProduct.php">Stwórz Produkt</a>
        </div>
        <div class="d-sm-flex flex-row">
            <div class="black-border flex-fill">
                <form>
                    <div class="mb-3">
                        <label for="listName" class="form-label">Nazwa Listy</label>
                        <input type="text" class="form-control" id="listName">
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">Data Zakończenia</label>
                        <input type="date" class="form-control" id="endDate">
                    </div>
                    <div class="mb-3">
                        <label for="listItem">Wyszukaj element z listy</label>
                        <input type="search" class="form-control" id="searchItem">
                    </div>
                    <div id="objects" class="row m-0 mx-5 my-5"></div>
            </div>
            <div class="black-border flex-shrink-1 flex-grow-0">
                <h3 id="list_name">Nazwa Listy</h3>
                <hr class="hr" />
                <h6>Coca Cola</h6>
                <hr class="hr" />
                <button type="submit" class="btn btn-primary">Uwtórz listę</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>