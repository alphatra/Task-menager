$(document).ready(function() {
    var path = window.location.pathname;
    var page = path.split("/").pop();
    
    if (page == "createList.html") {
        $("#main-section").load("../views/createList.html #products-section");
        $("#right-bar-section").load("../views/createList.html #list-view-section");
    } else {
        // Domyślna treść dla innych podstron
        $("#main-section").load("../views/listView.html #lists-section");
        $("#right-bar-section").load("../views/listView.html #activity-section");
    }
  });
