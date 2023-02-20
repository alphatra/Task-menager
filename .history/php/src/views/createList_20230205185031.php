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
    <script src="../assets/script.js"></script>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="d-sm-flex flex-column">
        <div class="black-border">
            <a href="/">Listy</a>
            <a href="views/createList.php">Stwórz nową</a>
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

            </div>
            <div class="black-border flex-shrink-1 flex-grow-0">
                <div class="d-flex align-items-center mx-3 my-3">
                    <h2 class="me-4">
                        <span class="fw-light">Witaj,</span>
                        <span><strong>Gracjan</strong></span>
                    </h2>
                    <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle" style="width: 144px;" alt="Avatar" />
                </div>
                <hr class="hr" />
                </form>
            </div>
        </div>
    </div>
</body>
</html>