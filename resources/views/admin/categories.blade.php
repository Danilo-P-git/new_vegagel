@extends('layouts.side')

@section('content')

<div class="container-sm  bg-light shadow p-1 px-lg-5 rounded">


    <div class="overflow-auto p-2">
        <h2>AGGIUNGI UNA CATEGORIA</h2>
        <form action="{{route('admin.categoriesCreate')}}" method="post">
            <div class="form-row">

                <div class="form-group col-md-5 col-7">
        
                    <label for="tipo">Nome Categoria</label>
                    <input name="tipo" type="text" id="tipo" class="form-control" value="" required>
                    @error('tipo')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group col-md-3 col-3  d-flex">
                    <div class="custom-control custom-switch align-self-end">
                        <input type="checkbox" class="custom-control-input" name="reperibile" id="reperibile">
                        <label class="custom-control-label" for="reperibile">Deteriorabile con il tempo ?</label>
                    </div>
                </div>

                <div class="form-group col-md-1 col-2  d-flex">
        
                    
                    <button class="btn btn-primary align-self-end" type="submit"><i class="fas fa-plus"></i></button>
                </div>
            </div>

        </form>
    
        <table class="table border shadow table-bordered table-hover" >
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                </tr>

            </thead>

            <tbody>
                @foreach ($categories  as $item )
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->tipo}}</td>


                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>
@endsection