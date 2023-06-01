@extends('/layout/app')

@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h6>Liste des membres</h6> 
                <div class="afferror"></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">Formulaire</div>
                            <div class="card-body">

                                
                                <form id="formMembre" method="post" enctype="multipart/form-data">
                                    @csrf    
                                    
                                    <input type="hidden" name="idmember" value="">


                                    <div class="row">
                                      <div class="col">
                                        <div class="input-group mb-3">
                                          <span class="input-group-text" id="basic-addon1">Nom</span>
                                          <input name="nom" type="text" class="form-control" placeholder="Nom de la personne" aria-describedby="basic-addon1">
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="input-group mb-3">
                                          <span class="input-group-text" id="basic-addon1">Prénom</span>
                                          <input name="prenom" type="text" class="form-control" placeholder="Prénom de la personne" aria-describedby="basic-addon1">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col">
                                        <div class="input-group mb-3">
                                          <span class="input-group-text" id="basic-addon1">Fillière</span>
                                          <input name="filliere" type="text" class="form-control" placeholder="Nom du fillière" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                      </div>

                                      <div class="col">
                                        <div class="input-group mb-3">
                                          <span class="input-group-text" id="basic-addon1">Adresse</span>
                                          <input name="adresse" type="text" class="form-control" placeholder="Adresse de la personne" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                      </div>                   
                                    </div>

                               
                                    
                                    <div class="row">
                                      <div class="col">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Promotion</span>
                                            <input name="promotion" type="text" class="form-control" placeholder="Année de promotion" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="input-group mb-3">
                                          <input name="image" type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="input-group mt-3 d-flex justify-content-end">
                                        <input id="btn" type="submit" class="btn btn-success" style="width: 30%" value="Enregistrer">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                  <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Affichage
                        </div>
                        <div class="card-body">
                          <input type="text" id="search" placeholder="Recherche" ><i class="fa-solid fa-magnifying-glass"></i>
                            <table class="table table-striped" style="text-align: center;" id="exampless" class="table table-hover" >
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Fillière</th>
                                    <th scope="col">Adresse</th>
                                    <th scope="col">Promotion</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody id="bodyMembre">
                                  {{-- <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>
                                        <a href="#" class="modification"><i class="fa-solid fa-pencil" style="color: rgb(255, 240, 31)"></i></a> 
                                        <a href="#" class="delete" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-user-slash" style="color: rgb(219, 25, 25)"></i></a>
                                    </td>
                                  </tr> --}}
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>





        
    </div>


  
  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Êtes-vous sûr de vouloir supprimer cet élément ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <form>
              <input type="hidden" id="" class="idhide" name="item_id" value="item_id_here">
              <button id="delbtn" type="submit" class="btn btn-danger">Supprimer</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

