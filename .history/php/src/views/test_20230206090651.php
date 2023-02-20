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
    <table>
        <td>
            <tr>1</tr>
            <tr>2</tr>
        </td>
        <td>
            <tr>1</tr>
            <tr>2</tr>
        </td>
    </table>
    <script>
        
        let tabliczka = (a,b) =>{
            console.log(a,b);
            //pętla for do tworzenia tablczki mnozenia
            for(let i = 1; i <= a; i++){
                let row = document.createElement("div");
                row.classList.add("row");
                for(let j = 1; j <= b; j++){
                    let col = document.createElement("div");
                    col.classList.add("col");
                    col.innerHTML = i*j;
                    row.appendChild(col);
                }
                document.body.appendChild(row);
            }
        }
        tabliczka(6,6)
    </script>
    <style>
        .row{
            display: flex;
            flex-direction: row;
        }
        .col{
            width: 50px;
            height: 50px;
            border: 1px solid black;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</body>
</html>