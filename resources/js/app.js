require('./bootstrap');
const Handlebars = require('handlebars/dist/cjs/handlebars');

if (screen.width < 980) {
    $("#admin-nav").addClass('active')
}
$(document).ready(function() {
    $('#sidebarCollapse').on('click', function () {
        $('#admin-nav').toggleClass('active');
    });
   
$("#cercaAziende").on('click', function() {
    var filter = $("#filterAzienda").val();
    console.log(filter);
    var protocol = window.location.protocol;
    var url = window.location.host;
    var webSite = protocol + '//' + url
    console.log(webSite);
    $.ajax({
        
        "url": "http://localhost:8000/api/admin/search",
        "data": {
            "filter": filter
        },
        "method": "GET",
        "success": function (response) {
            console.log(response);
            $(".azienda-wrapper").empty();

                renderAzienda(response);
           

        }
    });
})
    
    





function renderAzienda(data) {
    var source = $("#azienda-template").html();
    console.log(source);
    var template = Handlebars.compile(source);
    for (var i = 0; i < data.length; i++) {
        context = {
            "id": data[i].id,
            "name": data[i].name,
            "email": data[i].email,
            "pec": data[i].pec,
            "telefono": data[i].telefono,
            "indirizzo": data[i].indirizzo,
            "codice_fiscale": data[i].codice_fiscale,
            "citta": data[i].citta,
            "cap": data[i].cap,
            "comune": data[i].comune,
            "provincia": data[i].provincia,
            "partita_iva": data[i].partita_iva,
            "ragione_sociale": data[i].ragione_sociale,

        }
    
    
    var html = template(context)

    $(".azienda-wrapper").append(html);
}
  }
});
