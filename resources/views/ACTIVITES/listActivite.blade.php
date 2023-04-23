@extends('layout/app')

@section('content')

<div class="container">
    <div class="card mt-4">
        <div class="card-header align-items-center d-flex justify-content-between">
            <div>
                <h6>Liste des activités</h6>
            </div>
            <div>
            <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Nouvelle activité
                    </button>
            </div>           
        </div>
        <div class="card-body">
            <table class="table table-striped" style="text-align: center;">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Activité</th>
                    <th scope="col">Lieux</th>
                    <th scope="col">Responsable</th>
                    <th scope="col">Payer</th>
                    <th scope="col">Non payer</th>
                    <th scope="col">Disponibilté</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($activiteList as $item)
                    @php
                        $participant = DB::table('participers')
                                        ->where('activite_id', $item->id )
                                        ->count('*');

                        $NbrPaye = DB::table('participers')
                                        ->where('activite_id', $item->id )
                                        ->where('Status_payement','PAYER')
                                        ->count('*');

                        $NbrNonPaye = DB::table('participers')
                                        ->where('activite_id', $item->id )
                                        ->where('Status_payement','NON PAYER')
                                        ->count('*');

                        $dateExpiration = $item->Date_fin;
                        $dateNow = date('Y-m-d');
                        
                        $status= null;

                        if($dateExpiration < $dateNow ){
                            $status = 'expirer';
                        }else {
                            $status = 'disponible';
                        }

                        
                    @endphp

                        <tr class="listActTabl">
                            <th>{{ $item->id }}</th>
                            <td>{{ $item->Nom_activite }}</td>
                            <td>{{ $item->Lieux }}</td>
                            <td>{{ $item->Responsable }}</td>
                            <td>{{ $NbrPaye }}/{{ $participant }}</td>
                            <td>{{ $NbrNonPaye }}/{{ $participant }}</td>
                            @if ( $status == 'expirer')
                               <td><i class="fa-solid fa-circle-xmark fa-lg" style="color: #782121;"></i></td>
                            @else
                                <td><i class="fa-solid fa-circle-check fa-lg" style="color: #006625;"></i></td>
                            @endif
                            
                            <td>
                                <a href="#" class="btn btn-primary btn-sm"><i class="fa-sharp fa-solid fa-circle-info"></i></a>
                                <a href="#" class="btn btn-warning btn-sm" style="color: white"><i class="fa-solid fa-marker"></i></a>
                                <a href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-broom"></i></a>
                            </td>
                        </tr>
                    @endforeach
                                              
                
                </tbody>
              </table>
        </div>
    </div>

<style>
    tr.listActTabl th,td{
        vertical-align: middle;
    }
</style>


  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('activite.store') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="Nom" class="form-label">Nom</label>
                            <input type="text" placeholder="Nom d'activité" name="Nom" class="form-control" id="Nom" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="col"> 
                        <label for="Description" class="form-label">Description</label>                      
                        <div class="form-floating">       
                            <textarea class="form-control" id="Description" name="Description" placeholder="" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Description d'activité</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="Debut" class="form-label">Debut d'activité</label>
                            <input type="datetime-local" name="Debut" class="form-control" id="Debut">
                        </div>
                    </div>
                    <div class="col">                       
                        <div class="mb-3">
                            <label for="Fin" class="form-label">Fin d'activité</label>
                            <input type="date" name="Fin" class="form-control" id="Fin">
                        </div>
                    </div>
                </div>

                
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="Lieux" class="form-label">Lieux</label>
                            <input placeholder="Lieux d'activité" type="text" name="Lieux" class="form-control" id="Lieux">
                        </div>
                    </div>
                    <div class="col">                       
                        <div class="mb-3">
                            <label for="Responsable" class="form-label">Responsable</label>
                            <input placeholder="Responsable d'activité" type="text" name="Responsable" class="form-control" id="Responsable">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="Cout" class="form-label">Coût</label>
                            <input placeholder="Coût d'activité" type="text" name="Cout" class="form-control" id="Cout">
                        </div>
                    </div>
                    <div class="col">                       
                    </div>
                </div>

                <input type="submit" class="btn btn-success" value="Sauvegarder" style="width: 100%">
            </form>
        </div>
        <div class="modal-footer">
         <h6>Veuillez remplir le formulaire ci-dessus</h6>
        </div>
      </div>
    </div>
  </div>
</div>

   
@endsection