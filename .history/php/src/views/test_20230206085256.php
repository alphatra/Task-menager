<?php
echo "asd";
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
    <div></div>
    <div></div>
    <div></div>
    <div><p></p><p></p></div>
    <script>
        
        let tabliczka = (a,b) =>{
            console.log(a,b);
            //pętla for
            for(let i=0;i<a;i++){
                let div = document.createElement('div');
                for(let j=0;j<b;j++){
                    let p = document.createElement('p');
                    p.innerHTML = i + " " + j;
                    div.appendChild(p);
                }
                document.body.appendChild(div);
            }
        }
        tabliczka(6,6)
    </script>
    <style>
        
    </style>
</body>
</html>