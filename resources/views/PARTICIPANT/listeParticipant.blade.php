@extends('layout/app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h6>Participation des activités par chaque membre</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <form action="">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="client-select">Participant</label>
                            <select class="form-select" id="client-select" name="numClient">
                              <option value="" selected>Veuillez sélectionner le numéro du membre</option>
                              @foreach ($listeDesMembre as $item)                                    
                                <option class="numCli" value="{{ $item->id }}">{{ $item->id }}</option>
                              @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col"></div>
            </div>
            
        </div>
    </div>
</div>
@endsection