<script id="azienda-template" type="text/x-handlebars-template">

    
            
                <tr>
                    <td>
                        @{{name}}
                    </td>
                    <td>
                        @{{pec}}
                    </td>
                    <td>
                        @{{ragione_sociale}}
                    </td>
                    <td>
                        @{{indirizzo}}
                    </td>
                    <td>
                        @{{telefono}}
                    </td>
                    <td>
                        @{{partita_iva}}
                    </td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#edit@{{id}}" class="btn btn-secondary">Modifica dati</button>
                        <!-- Button trigger modal -->

                        
                        <!-- Modal edit  -->
                        <div class="modal fade" id="edit@{{id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Modifica dati</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <form action="http://localhost:8000/admin/editData/@{{id}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="modal-body">

                                  <div class="form-group row">
                                    <label for="pec" class="col-md-4 col-form-label text-md-right">PEC registrata</label>
        
                                    <div class="col-md-6">
                                        <input id="@{{id}}pec" type="email" class="pers-required form-control " name="pec" value="@{{pec}}"  >
        
                                       
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="telefono" class="col-md-4 col-form-label text-md-right">Numero di telefono</label>
        
                                    <div class="col-md-6">
                                        <input id="@{{id}}telefono" type="text" class="pers-required form-control " name="telefono" value="@{{pec}}"  >
        
                                     
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="indirizzo" class="col-md-4 col-form-label text-md-right">Indirizzo completo</label>
        
                                    <div class="col-md-6">
                                        <input id="@{{id}}indirizzo" type="text" class="pers-required form-control " name="indirizzo" value="@{{pec}}"  >
        
                                      
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="codice_fiscale" class="col-md-4 col-form-label text-md-right">Codice fiscale</label>
        
                                    <div class="col-md-6">
                                        <input id="@{{id}}codice_fiscale" type="text" class=" pers-required form-control " name="codice_fiscale" value="@{{pec}}" >
        
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="citta" class="col-md-4 col-form-label text-md-right">Città</label>
        
                                    <div class="col-md-6">
                                        <input id="@{{id}}citta" type="text" class=" pers-required form-control " name="citta"  value="@{{pec}}" >
        
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="cap" class="col-md-4 col-form-label text-md-right">CAP</label>
        
                                    <div class="col-md-6">
                                        <input id="@{{id}}cap" type="number" class="pers-required form-control " name="cap" value="" >
        
                                        
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="comune" class="col-md-4 col-form-label text-md-right">Comune</label>
        
                                    <div class="col-md-6">
                                        <input id="@{{id}}comune" type="text" class="pers-required form-control " name="comune" value="" >
        
                                       
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="provincia" class="col-md-4 col-form-label text-md-right">Provincia</label>
        
                                    <div class="col-md-6">
                                        <input id="@{{id}}provincia" type="text" class="pers-required form-control " name="provincia" value="" >
        
                  
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="partita_iva" class="col-md-4 col-form-label text-md-right">Partita iva</label>
        
                                    <div class="col-md-6">
                                        <input id="@{{id}}partita_iva" type="text" class="pers-required form-control " name="partita_iva" value="" >
        
                                     
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="ragione_sociale" class="col-md-4 col-form-label text-md-right">Ragione sociale</label>
        
                                    <div class="col-md-6">
                                        <input id="@{{id}}ragione_sociale" type="text" class="pers-required form-control " name="ragione_sociale" value="" >
        
                                      
                                    </div>
                                  </div>
                                  
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- Modal edit  -->
                    </td>
                </tr>



















</script>