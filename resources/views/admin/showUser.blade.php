@extends('layouts.side')

@section('content')



<div class="container-sm bg-light shadow border p-1 px-lg-5 rounded overflow-auto">
  {{-- Crea AZIENDE  --}}

  <section>
    <button type="button" data-toggle="modal" data-target="#create" class="btn btn-secondary">Crea Azienda/lavoratore</button>
    <!-- Button trigger modal -->


    <!-- Modal create  -->
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modifica dati</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form action="{{route('admin.create')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="modal-body">

              <div class="alert alert-warning" role="alert">
                La password sarà preimpostata è sara <strong>PasswordDefault</strong>
              </div>

              <div class="custom-control custom-switch">
                <input name="is_worker" type="checkbox" class="custom-control-input" id="lavoratoreCreate">
                <label class="custom-control-label" for="lavoratoreCreate"> Utente lavoratore? </label>
              </div>

              <div class="form-group row">
                <label for="create-name" class="col-md-4 col-form-label text-md-right">{{ __('Nome di riferimento') }}</label>

                <div class="col-md-6">
                    <input id="create-name" type="text" class="pers-required form-control @error('name') is-invalid @enderror" name="name" value="{{old("name")}}"  >

                    @error('pec')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>


              <div class="form-group row">
                <label for="create-email" class="col-md-4 col-form-label text-md-right">{{ __('Mail di riferimento') }}</label>

                <div class="col-md-6">
                    <input id="create-email" type="email" class="pers-required form-control @error('email') is-invalid @enderror" name="email" value="{{old("email")}}"  >

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>

              <div id="aziendeCreate">
                <div class="form-group row">
                  <label for="create-pec" class="col-md-4 col-form-label text-md-right">{{ __('PEC registrata') }}</label>

                  <div class="col-md-6">
                      <input id="create-pec" type="email" class="pers-required form-control @error('pec') is-invalid @enderror" name="pec" value="{{old("pec")}}"  >

                      @error('pec')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="create-telefono" class="col-md-4 col-form-label text-md-right">{{ __('Numero di telefono') }}</label>

                  <div class="col-md-6">
                      <input id="create-telefono" type="text" class="pers-required form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{old("telefono")}}"  >

                      @error('telefono')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="create-indirizzo" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo completo') }}</label>

                  <div class="col-md-6">
                      <input id="create-indirizzo" type="text" class="pers-required form-control @error('indirizzo') is-invalid @enderror" name="indirizzo" value="{{old("indirizzo")}}"  >

                      @error('indirizzo')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="create-codice_fiscale" class="col-md-4 col-form-label text-md-right">{{ __('Codice fiscale') }}</label>

                  <div class="col-md-6">
                      <input id="create-codice_fiscale" type="text" class=" pers-required form-control @error('codice_fiscale') is-invalid @enderror" name="codice_fiscale" value="{{old("codice_fiscale")}}" >

                      @error('codice_fiscale')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="create-citta" class="col-md-4 col-form-label text-md-right">{{ __('Città') }}</label>

                  <div class="col-md-6">
                      <input id="create-citta" type="text" class=" pers-required form-control @error('citta') is-invalid @enderror" name="citta"  value="{{old("citta")}}" >

                      @error('citta')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="create-cap" class="col-md-4 col-form-label text-md-right">{{ __('CAP') }}</label>

                  <div class="col-md-6">
                      <input id="create-cap" type="number" class="pers-required form-control @error('cap') is-invalid @enderror" name="cap" value="{{old("cap")}}" >

                      @error('cap')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="create-comune" class="col-md-4 col-form-label text-md-right">{{ __('Comune') }}</label>

                  <div class="col-md-6">
                      <input id="create-comune" type="text" class="pers-required form-control @error('comune') is-invalid @enderror" name="comune" value="{{old("comune")}}" >

                      @error('comune')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="create-provincia" class="col-md-4 col-form-label text-md-right">{{ __('Provincia') }}</label>

                  <div class="col-md-6">
                      <input id="create-provincia" type="text" class="pers-required form-control @error('provincia') is-invalid @enderror" name="provincia" value="{{old("provincia")}}" >

                      @error('provincia')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="create-partita_iva" class="col-md-4 col-form-label text-md-right">{{ __('Partita iva') }}</label>

                  <div class="col-md-6">
                      <input id="create-partita_iva" type="text" class="pers-required form-control @error('partita_iva') is-invalid @enderror" name="partita_iva" value="{{old("partita_iva")}}" >

                      @error('partita_iva')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="create-num_documento" class="col-md-4 col-form-label text-md-right">{{ __('N° documento') }}</label>

                  <div class="col-md-6">
                      <input id="create-num_documento" type="text" class="pers-required form-control @error('num_documento') is-invalid @enderror" name="num_documento" value="{{old("num_documento")}}" >

                      @error('num_documento')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="create-ragione_sociale" class="col-md-4 col-form-label text-md-right">{{ __('Ragione sociale') }}</label>

                  <div class="col-md-6">
                      <input id="create-ragione_sociale" type="text" class="pers-required form-control @error('ragione_sociale') is-invalid @enderror" name="ragione_sociale" value="{{old("ragione_sociale")}}" >

                      @error('ragione_sociale')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
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
    <!-- Modal create  -->

  </section>
  {{-- Crea AZIENDE  --}}


  {{-- AZIENDE  --}}
  <section>



    <h2 class="py-2"> Aziende</h2>
    <div class="d-flex flex-column ">
      <label class="ml-auto form-label" for="filterAzienda">Cerca il nome dell' azienda</label>
      <input id="filterAzienda" class="ml-auto form-control offset-10 col-6 col-md-2" type="text" placeholder="Cerca">
      <a class="ml-auto btn btn-primary my-1" id="cercaAziende">Search</a>
    </div>
    <table class="table border shadow table-bordered table-hover  rounded" >
        <thead class="thead-dark rounded">
            <tr>
                <th scope="col">@sortablelink('name', 'Nome di riferimento')</th>
                <th class="d-none d-md-table-cell" scope="col">@sortablelink('pec', 'Email-pec')</th>
                <th scope="col">@sortablelink('ragione_sociale', 'Nome azienda')</th>
                <th scope="col">@sortablelink('indirizzo', 'Indirizzo')</th>
                <th scope="col">@sortablelink('telefono', 'Telefono di riferimento')</th>
                <th class="d-none d-md-table-cell" scope="col">@sortablelink('partita_iva', 'Partita Iva')</th>




                <th>Azioni</th>

            </tr>

        </thead>

        <tbody  class="azienda-wrapper">
            @foreach ($aziende as $item )
                <tr>
                    <td>{{$item->name}}</td>
                    <td class="d-none d-md-table-cell">{{$item->pec}}</td>
                    <td>{{$item->ragione_sociale}}</td>
                    <td>{{$item->indirizzo}}</td>
                    <td>{{$item->telefono}}</td>
                    <td class="d-none d-md-table-cell">{{$item->partita_iva}}</td>

                    <td>

                        <button type="button" data-toggle="modal" data-target="#editAziende{{$item->id}}" class="btn btn-secondary">Modifica dati</button>
                        <!-- Button trigger modal -->


                        <!-- Modal edit  -->
                        <div class="modal fade" id="editAziende{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Modifica dati</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <form action="{{route('admin.data', $item->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="modal-body">

                                  <div class="form-group row">
                                    <label for="pec-{{$item->id}}-pec" class="col-md-4 col-form-label text-md-right">{{ __('PEC registrata') }}</label>

                                    <div class="col-md-6">
                                        <input id="azienda-{{$item->id}}-pec" type="email" class="pers-required form-control @error('pec') is-invalid @enderror" name="pec" value="{{old("pec") ? old("pec") : $item->pec}}"  >

                                        @error('pec')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="telefono-{{$item->id}}-telefono" class="col-md-4 col-form-label text-md-right">{{ __('Numero di telefono') }}</label>

                                    <div class="col-md-6">
                                        <input id="azienda-{{$item->id}}-telefono" type="text" class="pers-required form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{old("telefono") ? old("telefono") : $item->telefono}}"  >

                                        @error('telefono')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="indirizzo-{{$item->id}}-indirizzo" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo completo') }}</label>

                                    <div class="col-md-6">
                                        <input id="azienda-{{$item->id}}-indirizzo" type="text" class="pers-required form-control @error('indirizzo') is-invalid @enderror" name="indirizzo" value="{{old("indirizzo") ? old("indirizzo") : $item->indirizzo}}"  >

                                        @error('indirizzo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="codice_fiscale-{{$item->id}}-codice_fiscale" class="col-md-4 col-form-label text-md-right">{{ __('Codice fiscale') }}</label>

                                    <div class="col-md-6">
                                        <input id="azienda-{{$item->id}}-codice_fiscale" type="text" class=" pers-required form-control @error('codice_fiscale') is-invalid @enderror" name="codice_fiscale" value="{{old("codice_fiscale") ? old("codice_fiscale") : $item->codice_fiscale}}" >

                                        @error('codice_fiscale')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="citta-{{$item->id}}-citta" class="col-md-4 col-form-label text-md-right">{{ __('Città') }}</label>

                                    <div class="col-md-6">
                                        <input id="azienda-{{$item->id}}-citta" type="text" class=" pers-required form-control @error('citta') is-invalid @enderror" name="citta"  value="{{old("citta") ? old("citta") : $item->citta}}" >

                                        @error('citta')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="cap-{{$item->id}}-cap" class="col-md-4 col-form-label text-md-right">{{ __('CAP') }}</label>

                                    <div class="col-md-6">
                                        <input id="azienda-{{$item->id}}-cap" type="number" class="pers-required form-control @error('cap') is-invalid @enderror" name="cap" value="{{old("cap") ? old("cap") : $item->cap}}" >

                                        @error('cap')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="comune-{{$item->id}}-comune" class="col-md-4 col-form-label text-md-right">{{ __('Comune') }}</label>

                                    <div class="col-md-6">
                                        <input id="azienda-{{$item->id}}-comune" type="text" class="pers-required form-control @error('comune') is-invalid @enderror" name="comune" value="{{old("comune") ? old("comune") : $item->comune}}" >

                                        @error('comune')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="provincia-{{$item->id}}-provincia" class="col-md-4 col-form-label text-md-right">{{ __('Provincia') }}</label>

                                    <div class="col-md-6">
                                        <input id="azienda-{{$item->id}}-provincia" type="text" class="pers-required form-control @error('provincia') is-invalid @enderror" name="provincia" value="{{old("provincia") ? old("provincia") : $item->provincia}}" >

                                        @error('provincia')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="partita_iva-{{$item->id}}-partita_iva" class="col-md-4 col-form-label text-md-right">{{ __('Partita iva') }}</label>

                                    <div class="col-md-6">
                                        <input id="azienda-{{$item->id}}-partita_iva" type="text" class="pers-required form-control @error('partita_iva') is-invalid @enderror" name="partita_iva" value="{{old("partita_iva") ? old("partita_iva") : $item->partita_iva}}" >

                                        @error('partita_iva')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="azienda-{{$item->id}}-num_documento" class="col-md-4 col-form-label text-md-right">{{ __('N° documento') }}</label>

                                    <div class="col-md-6">
                                        <input id="azienda-{{$item->id}}-num_documento" type="text" class="pers-required form-control @error('num_documento') is-invalid @enderror" name="num_documento" value="{{old("num_documento") ? old("num_documento") : $item->num_documento}}" >

                                        @error('num_documento')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="ragione_sociale-{{$item->id}}-ragione_sociale" class="col-md-4 col-form-label text-md-right">{{ __('Ragione sociale') }}</label>

                                    <div class="col-md-6">
                                        <input id="azienda-{{$item->id}}-ragione_sociale" type="text" class="pers-required form-control @error('ragione_sociale') is-invalid @enderror" name="ragione_sociale" value="{{old("ragione_sociale") ? old("ragione_sociale") : $item->ragione_sociale}}" >

                                        @error('ragione_sociale')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
            @endforeach
        </tbody>

    </table>
    {!! $aziende->appends(Request::except('page'))->render() !!}
    <p>
        Mostra {{$aziende->count()}} di {{ $aziende->total() }} Aziende registrati.
    </p>
  </section>
  {{-- AZIENDE  --}}

  {{-- UTENTI REGISTRATI  --}}
  <section>


      <h2 class="py-2"> Utenti registrati</h2>

      <div class="d-flex flex-column ">
        <label class="ml-auto form-label" for="filterUtente">Cerca l'email dell'utente</label>
        <input id="filterUtente" class="ml-auto form-control offset-10 col-6 col-md-2" type="text" placeholder="Cerca">
        <a class="ml-auto btn btn-primary my-1" id="cercaUtente">Search</a>
      </div>

    <table class="table border shadow table-bordered table-hover  rounded" >
        <thead class="thead-dark rounded">
            <tr>
                <th scope="col">@sortablelink('name', 'Nome')</th>
                <th scope="col">@sortablelink('email', 'Email')</th>
                <th class="d-none d-md-table-cell" scope="col">ID</th>
                <th>Azioni</th>

            </tr>

        </thead>

        <tbody class="utente-wrapper">
            @foreach ($users as $item )
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td class="d-none d-md-table-cell">{{$item->id}}</td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#worker{{$item->id}}" class="btn btn-primary">Rendi Lavoratore</button>
                        {{-- MODAL RENDI LAVORATORE  --}}
                        <div class="modal fade" id="worker{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Sei sicuro?</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="{{route('admin.role', $item->id)}}" method="post" enctype="multipart/form-data">
                                  @csrf
                                  @method('put')
                                  <div class="modal-body">

                                    <p>
                                        Attiva lo switch per far diventare un lavoratore questo utente.
                                    </p>
                                    <div class="custom-control custom-switch">
                                      <input name="is_worker" type="checkbox" class="custom-control-input" id="is_worker{{$item->id}}">
                                      <label class="custom-control-label" for="is_worker{{$item->id}}"> Utente lavoratore? </label>
                                    </div>

                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        {{-- MODAL RENDI LAVORATORE  --}}

                        <button type="button" data-toggle="modal" data-target="#edit{{$item->id}}" class="btn btn-secondary">Rendi azienda</button>
                        <!-- Button trigger modal -->


                        <!-- Modal edit  -->
                        <div class="modal fade" id="edit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Rendi azienda</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <form action="{{route('admin.data', $item->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="modal-body">

                                  <div class="form-group row">
                                    <label for="{{$item->id}}pec" class="col-md-4 col-form-label text-md-right">{{ __('PEC registrata') }}</label>

                                    <div class="col-md-6">
                                        <input id="{{$item->id}}pec" type="email" class="pers-required form-control @error('pec') is-invalid @enderror" name="pec" value="{{ old('pec') }}"  >

                                        @error('pec')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="{{$item->id}}telefono" class="col-md-4 col-form-label text-md-right">{{ __('Numero di telefono') }}</label>

                                    <div class="col-md-6">
                                        <input id="{{$item->id}}telefono" type="text" class="pers-required form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}"  >

                                        @error('telefono')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="{{$item->id}}indirizzo" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo completo') }}</label>

                                    <div class="col-md-6">
                                        <input id="{{$item->id}}indirizzo" type="text" class="pers-required form-control @error('indirizzo') is-invalid @enderror" name="indirizzo" value="{{ old('indirizzo') }}"  >

                                        @error('indirizzo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="{{$item->id}}codice_fiscale" class="col-md-4 col-form-label text-md-right">{{ __('Codice fiscale') }}</label>

                                    <div class="col-md-6">
                                        <input id="{{$item->id}}codice_fiscale" type="text" class=" pers-required form-control @error('codice_fiscale') is-invalid @enderror" name="codice_fiscale" value="{{ old('codice_fiscale') }}" >

                                        @error('codice_fiscale')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="{{$item->id}}citta" class="col-md-4 col-form-label text-md-right">{{ __('Città') }}</label>

                                    <div class="col-md-6">
                                        <input id="{{$item->id}}citta" type="text" class=" pers-required form-control @error('citta') is-invalid @enderror" name="citta"  value="{{ old('citta') }}" >

                                        @error('citta')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="{{$item->id}}cap" class="col-md-4 col-form-label text-md-right">{{ __('CAP') }}</label>

                                    <div class="col-md-6">
                                        <input id="{{$item->id}}cap" type="number" class="pers-required form-control @error('cap') is-invalid @enderror" name="cap" value="{{ old('cap') }}" >

                                        @error('cap')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="{{$item->id}}comune" class="col-md-4 col-form-label text-md-right">{{ __('Comune') }}</label>

                                    <div class="col-md-6">
                                        <input id="{{$item->id}}comune" type="text" class="pers-required form-control @error('comune') is-invalid @enderror" name="comune" value="{{ old('comune') }}" >

                                        @error('comune')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="{{$item->id}}provincia" class="col-md-4 col-form-label text-md-right">{{ __('Provincia') }}</label>

                                    <div class="col-md-6">
                                        <input id="{{$item->id}}provincia" type="text" class="pers-required form-control @error('provincia') is-invalid @enderror" name="provincia" value="{{ old('provincia') }}" >

                                        @error('provincia')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="{{$item->id}}partita_iva" class="col-md-4 col-form-label text-md-right">{{ __('Partita iva') }}</label>

                                    <div class="col-md-6">
                                        <input id="{{$item->id}}partita_iva" type="text" class="pers-required form-control @error('partita_iva') is-invalid @enderror" name="partita_iva" value="{{ old('partita_iva') }}" >

                                        @error('partita_iva')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="{{$item->id}}num_documento" class="col-md-4 col-form-label text-md-right">{{ __('N° documento') }}</label>

                                    <div class="col-md-6">
                                        <input id="{{$item->id}}num_documento" type="text" class="pers-required form-control @error('num_documento') is-invalid @enderror" name="num_documento" value="{{ old('num_documento') }}" >

                                        @error('num_documento')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="{{$item->id}}ragione_sociale" class="col-md-4 col-form-label text-md-right">{{ __('Ragione sociale') }}</label>

                                    <div class="col-md-6">
                                        <input id="{{$item->id}}ragione_sociale" type="text" class="pers-required form-control @error('ragione_sociale') is-invalid @enderror" name="ragione_sociale" value="{{ old('ragione_sociale') }}" >

                                        @error('ragione_sociale')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
            @endforeach
        </tbody>

    </table>
    {!! $users->appends(Request::except('page'))->render() !!}
    <p>
        Mostra {{$users->count()}} di {{ $users->total() }} Utenti registrati.
    </p>
  </section>
  {{-- UTENTI REGISTRATI  --}}

  {{-- Lavoratori --}}
<section>
  <h2 class="py-2"> Utenti Lavoratori</h2>
  <table class="table border shadow table-bordered table-hover  rounded" >
      <thead class="thead-dark rounded">
          <tr>
              <th scope="col">@sortablelink('name', 'Nome')</th>
              <th scope="col">@sortablelink('email', 'Email')</th>
              <th class="d-none d-md-table-cell" scope="col">ID</th>
              <th scope="col">Azioni</th>

          </tr>

      </thead>

      <tbody>
          @foreach ($worker as $item )
              <tr>
                  <td>{{$item->name}}</td>
                  <td>{{$item->email}}</td>
                  <td class="d-none d-md-table-cell">{{$item->id}}</td>
                  <td class="d-flex">


                      <button type="button" data-toggle="modal" data-target="#edit{{$item->id}}" class="btn btn-secondary ml-auto">Modifica dati</button>
                      <!-- Button trigger modal -->


                      <!-- Modal edit  -->
                      <div class="modal fade" id="edit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Modifica dati</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('admin.data', $item->id)}}" method="post" enctype="multipart/form-data">
                              @csrf
                              @method('put')
                              <div class="modal-body">

                                <div class="form-group row">
                                  <label for="{{$item->id}}pec" class="col-md-4 col-form-label text-md-right">{{ __('PEC registrata') }}</label>

                                  <div class="col-md-6">
                                      <input id="{{$item->id}}pec" type="email" class="pers-required form-control @error('pec') is-invalid @enderror" name="pec" value="{{ old('pec') }}"  >

                                      @error('pec')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="{{$item->id}}telefono" class="col-md-4 col-form-label text-md-right">{{ __('Numero di telefono') }}</label>

                                  <div class="col-md-6">
                                      <input id="{{$item->id}}telefono" type="text" class="pers-required form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}"  >

                                      @error('telefono')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="{{$item->id}}indirizzo" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo completo') }}</label>

                                  <div class="col-md-6">
                                      <input id="{{$item->id}}indirizzo" type="text" class="pers-required form-control @error('indirizzo') is-invalid @enderror" name="indirizzo" value="{{ old('indirizzo') }}"  >

                                      @error('indirizzo')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="{{$item->id}}codice_fiscale" class="col-md-4 col-form-label text-md-right">{{ __('Codice fiscale') }}</label>

                                  <div class="col-md-6">
                                      <input id="{{$item->id}}codice_fiscale" type="text" class=" pers-required form-control @error('codice_fiscale') is-invalid @enderror" name="codice_fiscale" value="{{ old('codice_fiscale') }}" >

                                      @error('codice_fiscale')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="{{$item->id}}citta" class="col-md-4 col-form-label text-md-right">{{ __('Città') }}</label>

                                  <div class="col-md-6">
                                      <input id="{{$item->id}}citta" type="text" class=" pers-required form-control @error('citta') is-invalid @enderror" name="citta"  value="{{ old('citta') }}" >

                                      @error('citta')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="{{$item->id}}cap" class="col-md-4 col-form-label text-md-right">{{ __('CAP') }}</label>

                                  <div class="col-md-6">
                                      <input id="{{$item->id}}cap" type="number" class="pers-required form-control @error('cap') is-invalid @enderror" name="cap" value="{{ old('cap') }}" >

                                      @error('cap')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="{{$item->id}}comune" class="col-md-4 col-form-label text-md-right">{{ __('Comune') }}</label>

                                  <div class="col-md-6">
                                      <input id="{{$item->id}}comune" type="text" class="pers-required form-control @error('comune') is-invalid @enderror" name="comune" value="{{ old('comune') }}" >

                                      @error('comune')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="{{$item->id}}provincia" class="col-md-4 col-form-label text-md-right">{{ __('Provincia') }}</label>

                                  <div class="col-md-6">
                                      <input id="{{$item->id}}provincia" type="text" class="pers-required form-control @error('provincia') is-invalid @enderror" name="provincia" value="{{ old('provincia') }}" >

                                      @error('provincia')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="{{$item->id}}partita_iva" class="col-md-4 col-form-label text-md-right">{{ __('Partita iva') }}</label>

                                  <div class="col-md-6">
                                      <input id="{{$item->id}}partita_iva" type="text" class="pers-required form-control @error('partita_iva') is-invalid @enderror" name="partita_iva" value="{{ old('partita_iva') }}" >

                                      @error('partita_iva')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="{{$item->id}}num_documento" class="col-md-4 col-form-label text-md-right">{{ __('N° documento') }}</label>

                                  <div class="col-md-6">
                                      <input id="{{$item->id}}num_documento" type="text" class="pers-required form-control @error('num_documento') is-invalid @enderror" name="num_documento" value="{{ old('num_documento') }}" >

                                      @error('num_documento')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="{{$item->id}}ragione_sociale" class="col-md-4 col-form-label text-md-right">{{ __('Ragione sociale') }}</label>

                                  <div class="col-md-6">
                                      <input id="{{$item->id}}ragione_sociale" type="text" class="pers-required form-control @error('ragione_sociale') is-invalid @enderror" name="ragione_sociale" value="{{ old('ragione_sociale') }}" >

                                      @error('ragione_sociale')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
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
          @endforeach
      </tbody>

  </table>
  {!! $users->appends(Request::except('page'))->render() !!}
  <p>
      Mostra {{$users->count()}} di {{ $users->total() }} Utenti registrati.
  </p>
</section>
  {{-- Lavoratori --}}

  @include('layouts.handlebars_layout.aziendaHandle')
  @include('layouts.handlebars_layout.userHandle')

@endsection
