@extends('layout/app')

@section('content')
    
<div class="container">
    <div class="card mt-4">
        <div class="card-header">Les participants de l'activite</div>
        <div class="card-body">

           
      

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Liste des membres
                        </div>
                        <div class="card-body">
                            <div class="order">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($participer as $item)
                                        <tr>
                                            <td>
                                                {{$item->membre_id}}
                                            </td>
                                            <td>
                                                {{$item->membress->Nom}}
                                            </td>
                                            <td>{{$item->membress->Prenom}}</td>
                                            <td class="stat">
                                                @if ($item->Status_payement == "NON PAYER" )
                                                 <span class="status lost">Non payer</span>
                                                @elseif ($item->Status_payement == "PAYER" )
                                                 <span class="status completed">Payer</span>
                                                @else
                                                  <span class="status process">Engager</span>
                                                @endif  
                                               
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm controlePayement" id="{{$item->activite_id}}/{{$item->membre_id}}" ><i class="fa-solid fa-paperclip "></i></a> 
                                            </td>
                                        </tr>
                                       
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col">
                    
                    <div class="card">
                        <div class="card-header">Détail de l'activité</div>
                        <div class="card-body">  
                                <ul class="list-group mb-3 list-group-flush">
                                  <li class="list-group-item px-0 d-flex justify-content-between">
                                      <span>Nom</span>
                                      <strong style=" font-weight: lighter;">{{$activite->Nom_activite}}</strong>
                                  </li>
                                  <li class="list-group-item px-0 d-flex justify-content-between">
                                      <span>Lieu</span>
                                      <strong  style=" font-weight: lighter;">{{$activite->Lieux}}</strong>
                                  </li>
                                  <li class="list-group-item px-0 d-flex justify-content-between">
                                      <span>Responsable</span>
                                      <strong  style=" font-weight: lighter;">{{$activite->Responsable}}</strong>
                                  </li>
                                  <li class="list-group-item px-0 d-flex justify-content-between">
                                      <span>Debut de l'activite</span>
                                      <strong  style=" font-weight: lighter;">{{ $activite->Date_debut}}</strong>
                                  </li>
                                  <li class="list-group-item px-0  d-flex justify-content-between">
                                    <span>Fin de l'activite</span>
                                    <strong  style=" font-weight: lighter;">{{ $activite->Date_fin  }} </strong>
                                  </li>
                                  <li class="list-group-item px-0 ">
                                    <span>Description</span>
                                    <p  style=" font-weight: lighter;">{{$activite->Description}}</p>
                                  </li>
                                </ul>                     
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <div class=""><h6>Coût de l'activité</h6></div>
                                <div class="">{{ $activite->Cout  }} Ariary</div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle right offcanvas</button> --}}
{{-- CANVAS --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasRightLabel">Contrôle</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="card">
        <div class="card-header">
            <h6>{{$activite->Nom_activite}}</h6>
        </div>
        <div class="card-body">
                <ul class="list-group mb-3 list-group-flush">
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span>Nom</span>
                        <strong class="affContr nom" style=" font-weight: lighter;"></strong>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span>Prénom</span>
                        <strong class="affContr prenom" style=" font-weight: lighter;"></strong>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span>Fillière</span>
                        <strong class="affContr filli"  style=" font-weight: lighter;"></strong>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span>Adresse</span>
                        <strong class="affContr adres"  style=" font-weight: lighter;"></strong>
                    </li>
                    <li class="list-group-item px-0  d-flex justify-content-between">
                        <span>Promotion</span>
                        <strong class="affContr promot"  style=" font-weight: lighter;"></strong>
                    </li>
                    <li class="list-group-item px-0  ">
                        <form id="formPayement" action="{{ route('infoActivite.modifActivite') }}" method="POST">
                            @csrf
                            @method('POST')

                                <input type="hidden" class="identParticiper" name="identParticiper">
                                <div>Status de payement</div>
                                <div class="d-flex justify-content-between mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioPayement" value="payer" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Payer
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioPayement" value="non_payer" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Non payer
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioPayement" value="engager" id="flexRadioDefault3" >
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        Engager
                                    </label>
                                </div>                          
                                </div>
                                <div class="input-group flex-nowrap mt-3" id="montantEngage" style="display: none">
                                    <input type="text" name="reste" class="form-control engageMontant" placeholder="Montant d'engagement" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Ar</span>
                                </div>
                              
                                <button type="submit" class="btn btn-success mt-4" style="width: 100%">Enregistrer</button>
                        </form>  
                    </li>
                     

                </ul>     
        </div>

    </div>
    
   
  </div>
</div>

<style>
    .order{
    flex-grow: 1;
	flex-basis: 500px;
    }
    .order table{
    width: 100%;
	border-collapse: collapse;
    text-align: center;
    }

    .order table th{
    padding-bottom: 12px;
	font-size: 14px;
	text-align: center;
	border-bottom: 1px solid #eee;
    }

    .order table td {
    padding: 16px 0;
    font-size: 14px;
    max-width: 100px;
    }

    .order table tr td:first-child{
    display: flex;
	align-items: center;
	grid-gap: 12px;
	padding-left: 6px;
    }

    .order table td img {
	width: 36px;
	height: 36px;
	border-radius: 50%;
	object-fit: cover;
    }

    .order table tbody tr:hover {
	background: #eee;
    }

    .order table tr td .status {
	font-size: 10px;
	padding: 6px 16px;
	color: white;
	border-radius: 20px;
	font-weight: 700;
    }

    .order table tr td .status.completed {
	background: rgb(15, 141, 65)
    }

    .order table tr td .status.process {
	background: rgb(0, 136, 255)
    }

    .order table tr td .status.lost {
	background: rgb(231, 19, 19)
    }


    .stat span{
        width: 50px;
    }




</style>
@endsection