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
    <div class="paragraf"><p>asdas</p><p>asdasd</p></div>
    <script>
        
        let tabliczka = (a,b) =>{
            console.log(a,b);
            //pętla for
            let div = document.createElement('div');
            for(let i=1;i<a;i++){
                
                for(let j=1;j<b;j++){
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
        .paragraf {
            display: inline-block;
            width: 50px;
            height: 50px;
            background-color: red;
            margin: 0;
            padding: 0;
        }
    </style>
</body>
</html>