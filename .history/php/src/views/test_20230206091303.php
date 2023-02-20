<?php
echo "asd"."asd";
?>
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
            for(let i = 1; i <= a; i++){
                table.appendChild("asd")
                let row = document.createElement("tr");
                for(let j = 1; j <= b; j++){
                    let col = document.createElement("td");
                    col.innerHTML = i*j;
                    row.appendChild(col);
                }
                document.body.appendChild(row);
            }
        }
        tabliczka(6,6)
    </script>
    <style>
        table{
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</body>
</html>