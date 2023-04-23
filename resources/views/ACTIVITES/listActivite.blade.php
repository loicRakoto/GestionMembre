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
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($activiteList as $item)
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                    @endforeach
                
                </tbody>
              </table>
        </div>
    </div>




  
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