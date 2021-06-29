require('./bootstrap');
// utilizzo di handlebar e di chiamate api al controller API SearchController
const Handlebars = require('handlebars/dist/cjs/handlebars');

if (screen.width < 980) {
    $("#admin-nav").addClass('active')
}
// admin sidebar 
$(document).ready(function() {
    $('#sidebarCollapse').on('click', function () {
        $('#admin-nav').toggleClass('active');
    });
// /admin sidebar 
// stile
$("#lavoratoreCreate").on('change', function() {
    console.log('change');
    $("#aziendeCreate").toggle('fast');
})
$(".close").on('click', function(){
    $(".element-wrapper").empty();

})
// stile

// ajax ricerca azienda api 
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
// ajax ricerca azienda api 

// ajax ricerca utente ADMIN  api 

$("#cercaUtente").on('click', function() {
    var filter = $("#filterUtente").val();
    console.log(filter);
    var protocol = window.location.protocol;
    var url = window.location.host;
    var webSite = protocol + '//' + url
    console.log(webSite);
    $.ajax({

        "url": webSite + "/api/admin/searchUtente",
        "data": {
            "filter": filter
        },
        "method": "GET",
        "success": function (response) {
            console.log(response);
            $(".utente-wrapper").empty();

                renderUtente(response);


        }
    });
})
// ajax ricerca utente ADMIN  api 

// impostazione data e mese per date di scadenza in orderCreate lato ADMIN 

var d = new Date();

var month = d.getMonth()+1;
var day = d.getDate();

var today = d.getFullYear() + '-' + ((''+month).length<2 ? '0' : '') + month + '-' + ((''+day).length<2 ? '0' : '') + day;

var d2 = new Date();

var month2 = d.getMonth()+2;

var day2 = d.getDate();

var oneMonth = d.getFullYear() + '-' + ((''+month2).length<2 ? '0' : '') + month2 + '-' + ((''+day).length<2 ? '0' : '') + day;

// impostazione data e mese per date di scadenza in orderCreate lato ADMIN 

// Ricerca nei prodotti il singolo lotto 

    $(".products").on('click', function () {
        var codProdotto = $(this).val();
        var protocol = window.location.protocol;
        var url = window.location.host;
        var webSite = protocol + '//' + url
        $.ajax({

            "url": webSite + "/api/admin/searchProdotto",
            "data": {
                "codice_prodotto": codProdotto
            },
            "method": "GET",
            "success": function (response) {
                console.log(response);
                $(".element-wrapper").empty();

                renderProdotti(response);
                    for (let index = 0; index < response.length; index++) {
                        console.log(response[index].data_di_scadenza);
                        if (response[index].data_di_scadenza < today) {
                            $('.stato'+response[index].id).addClass('bg-danger');
                            $('.stato'+response[index].id).removeClass('d-none');

                            $('.scaduto'+response[index].id).removeClass('d-none');
                            console.log('scaduto');
    
                        } else if (response[index].data_di_scadenza>today && response[index].data_di_scadenza < oneMonth) {
                            $('.stato'+response[index].id).addClass('bg-warning');
                            $('.stato'+response[index].id).removeClass('d-none');

                            $('.quasi-scaduto'+response[index].id).removeClass('d-none');
                            console.log('quasi');
                        } 
                        
                    }
                


                // response.forEach(element => {
                   
                // });

            }
        });
    })

// Ricerca nei prodotti il singolo lotto 


// FUNZIONI
// stampa azienda 
function renderAzienda(data) {
    var source = $("#azienda-template").html();
    console.log(source);
    var template = Handlebars.compile(source);

    // for
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
    // for

  }
// stampa azienda 


// stampa utente handelbars 

  function renderUtente(data) {
    var source = $("#user-template").html();
    console.log(source);
    var template = Handlebars.compile(source);
        // for
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

        $(".utente-wrapper").append(html);

    }
    // for

    }
// stampa utente handelbars 

// stampa prodotti handlebars 

    function renderProdotti(data) {
        var source = $("#products-template").html();
        var template = Handlebars.compile(source);
        for(var i=0; i < data.length; i++){
            context = {
                "id": data[i].id,
                "codice_stock": data[i].codice_stock,
                "name": data[i].name,
                "data_di_scadenza": data[i].data_di_scadenza,
                "lotto": data[i].lotto,
                "settore": data[i].sector.settore,
                "area": data[i].sector.scaffale,
                "quantita": data[i].sector.quantita_rimanente,
                "quantita_bloccata": data[i].sector.quantita_bloccata,
                "quantita_dif": data[i].sector.quantita_rimanente - data[i].sector.quantita_bloccata,
                "data_di_scadenza":data[i].data_di_scadenza,
                "peso": data[i].peso,
                "prezzo_al_pezzo":data[i].prezzo_al_pezzo


            }
            var html = template(context);
            $(".element-wrapper").append(html);
        }
      }

// stampa prodotti handlebars 









});
