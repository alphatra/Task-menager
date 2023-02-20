<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        
        let tabliczka = (a,b) =>{
            console.log(a,b);
            //pętla for do tworzenia tablczki mnozenia
            let table = document.createElement("table");
            table = document.body.appendChild(table);
            for(let i = 1; i <= a; i++){
                let row = document.createElement("tr");
                for(let j = 1; j <= b; j++){
                    let col = document.createElement("td");
                    col.innerHTML = i*j;
                    row.appendChild(col);
                }
                table.appendChild(row);
            }
        }
        tabliczka(6,6)
    </script>
    <style>
        table,tr,td{
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }
    </style>
</body>
</html>
<?php
$prod = '{
    "list_name": "asd",
    "end_date": "2023-02-23",
    "products": {
        "product_id": [
            "3",
            "8"
        ],
        "product_title": [
            "Canon EOS R6",
            "Loreal Paris Elvive"
        ],
        "qty": [
            1,
            1
        ]
    }
}';
$prod = json_decode($prod);
$products = $prod->products;
echo $prod->list_name."<br>";
$z = 10;
foreach($products->product_id as $key => $value){
    echo $products->product_title[$key];
    echo $value."<br>";
}
echo $z+11;
require_once('../model/CRUD.php');
$db = new db();
echo $db->getMaxId();
echo $db->createList($prod->list_name, null, $prod->end_date);
?>