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
    "list_name": "hahaha",
    "end_date": "2023-02-22",
    "products": {
        "product_id": [
            "2",
            "3"
        ],
        "product_title": [
            "Samsung Galaxy S20",
            "Canon EOS R6"
        ],
        "qty": [
            1,
            1
        ]
    }
}';
require_once('../model/CRUD.php');
$db = new db();
$prod = json_decode($prod);
$products = $prod->products;
echo $prod->list_name."<br>";
foreach($products->product_id as $key => $value){
    //echo $products->product_title[$key]." ";
    //echo $value."<br>";
    //echo $db->createListItems($products->qty[$key], $prod->list_name, $products->product_id[$key]);
    echo "<br>";
}


//echo $db->getMaxId('list')."<br>";
//echo $db->searchData($_tablename="list_items",$search="");
//echo $db->createListItems($qty=1,$list_name=$prod->list_name,$id_product=13);
//echo $db->createList($prod->list_name, $prod->end_date);
//echo $db->getIdList($prod->list_name);

echo $db->getData('products',1);
echo $db->searchData('list','C','');
?>