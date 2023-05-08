const { split } = require("lodash");

$(document).ready(function () {



    fetchData();

    function fetchData() {
        $.ajax({
            url: '/fetchData',
            dataType: 'json',
            method: 'GET',
            success: function (fetching) {
                $('tbody#bodyMembre').html('');
                $.each(fetching, function (key, Item) {
                    $('tbody#bodyMembre').append('\
                    <tr>\
                        <th scope="row">'+ Item.id + '</th>\
                        <td>'+ Item.Nom + '</td>\
                        <td>'+ Item.Prenom + '</td>\
                        <td>'+ Item.Filliere + '</td>\
                        <td>'+ Item.Adresse + '</td>\
                        <td>'+ Item.Promotion + '</td>\
                        <td>\
                            <a href="#" id="'+ Item.id + '" class="btn btn-warning btn-sm modification"><i class="fa-solid fa-marker"></i></a> \
                            <a href="#" id="'+ Item.id + '" class="btn btn-danger btn-sm delete" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-broom"></i></a>\
                        </td>\
                    </tr > \
                  ');
                });
            }
        });
    }
    $('#search').keyup(function (e) {

        var value = $(this).val();
        // var data = value.serialize();

        $.ajax({
            url: 'membre/search',
            data: {
                "id": value
            },
            method: 'GET',
            dataType: 'JSON',
            success: function (e) {
                $('tbody').html('');
                $.each(e, function (key, Item) {
                    $('tbody#bodyMembre').append('\
                    <tr>\
                        <th scope="row">'+ Item.id + '</th>\
                        <td>'+ Item.Nom + '</td>\
                        <td>'+ Item.Prenom + '</td>\
                        <td>'+ Item.Filliere + '</td>\
                        <td>'+ Item.Adresse + '</td>\
                        <td>'+ Item.Promotion + '</td>\
                        <td>\
                            <a href="#" id="'+ Item.id + '" class="btn btn-warning btn-sm modification"><i class="fa-solid fa-marker"></i></a> \
                            <a href="#" id="'+ Item.id + '" class="btn btn-danger btn-sm delete" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-broom"></i></a>\
                        </td>\
                    </tr > \
                  ');
                });
            }

        });
    });


    $(document).on('click', '.modification', function (e) {
        e.preventDefault();
        var token = $("[name='_token']").val();
        var recup = $(this).attr('id');

        $.ajax({
            url: 'membre/edit',
            method: 'GET',
            data: {
                recup, token
            },
            dataType: 'json',
            success: function (ex) {
                $("[name='idmember']").val(ex.id);
                $("[name='nom']").val(ex.Nom);
                $("[name='prenom']").val(ex.Prenom);
                $("[name='filliere']").val(ex.Filliere);
                $("[name='adresse']").val(ex.Adresse);
                $("[name='promotion']").val(ex.Promotion);
                $('input#btn').val('Modifier');
            }
        });
    });

    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        var recup = $(this).attr('id');
        $('.idhide').attr('id', recup);
    });

    $(document).on('click', '#delbtn', function (e) {
        e.preventDefault();
        var token = $("[name='_token']").val();
        var id = $('.idhide').attr('id');

        $.ajax({
            url: 'membre/delete',
            method: 'GET',
            data: {
                id, token
            },
            dataType: 'json',
            success: function (ex) {
                fetchData();
                $('#deleteModal').modal('hide');
                $('.afferror').html('');
                $('.afferror').removeClass('alert alert-danger');
                $('.afferror').addClass('alert alert-success');
                $('.afferror').append('<li> Suppression effectuer </li>')
                fetchData();
                $('#formMembre')[0].reset();
                $("[name='idmember']").val('');
                $('input#btn').val('Enregistrer');
            }
        });
    });


    $('#formMembre').submit(function (e) {
        e.preventDefault();
        // var data = $(this).serializeArray();
        // var jsondata = JSON.stringify(data);

        var faire = $("[name='idmember']").val();

        if (faire == '') {
            //AJOUT

            var jsondata = {
                'nom': $("[name='nom']").val(),
                'prenom': $("[name='prenom']").val(),
                'filliere': $("[name='filliere']").val(),
                'adresse': $("[name='adresse']").val(),
                'promotion': $("[name='promotion']").val(),
            }


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json'
                }
            });


            $.ajax({
                url: '/membre/add',
                data: JSON.stringify(jsondata),
                dataType: 'json',
                contentType: 'application/json',
                type: 'POST',
                success: function (e) {
                    // console.log(e);

                    if (e.status == 400) {
                        $('.afferror').html('');
                        $('.afferror').removeClass('alert alert-success');
                        $('.afferror').addClass('alert alert-danger');
                        $.each(e.messageError, function (key, Err) {
                            $('.afferror').append('<li>' + Err + '</li>');
                        });

                    } else {
                        $('.afferror').html('');
                        $('.afferror').removeClass('alert alert-danger');
                        $('.afferror').addClass('alert alert-success');
                        $('.afferror').append('<li> Ajout réussie </li>')
                        fetchData();
                        $('#formMembre')[0].reset();
                        $("[name='idmember']").val('');

                    }

                }

            });
        } else {
            //MODIFICATION
            var id = $("[name='idmember']").val();
            var token = $("[name='_token']").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json'
                }
            });

            var value = {
                'id': id,
                'token': token,
                'nom': $("[name='nom']").val(),
                'prenom': $("[name='prenom']").val(),
                'filliere': $("[name='filliere']").val(),
                'adresse': $("[name='adresse']").val(),
                'promotion': $("[name='promotion']").val(),
            }

            $.ajax({
                url: 'membre/update',
                method: 'POST',
                data: JSON.stringify(value),
                dataType: 'json',
                success: function (e) {
                    if (e.status == 400) {
                        $('.afferror').html('');
                        $('.afferror').removeClass('alert alert-success');
                        $('.afferror').addClass('alert alert-danger');
                        $.each(e.messageError, function (key, Err) {
                            $('.afferror').append('<li>' + Err + '</li>');
                        });
                        $('input#btn').val('Enregistrer');
                    } else {
                        $('.afferror').html('');
                        $('.afferror').removeClass('alert alert-danger');
                        $('.afferror').addClass('alert alert-success');
                        $('.afferror').append('<li> Mise à jour réussie </li>')
                        fetchData();
                        $('#formMembre')[0].reset();
                        $('input#btn').val('Enregistrer');
                        $("[name='idmember']").val('');
                    }
                }
            });

        }

    });

    // ACTIVITE ===========================================================================================

    $(document).on('click', '.modifAct', function () {
        var ident = $(this).attr('id');
        $.ajax({
            method: "GET",
            url: "/activite/edit",
            data: {
                'id': ident
            },
            dataType: "json",
            success: function (response) {
                $('#identActModif').val(response.id);
                $('#NomModifAct').val(response.Nom_activite);
                $('#DescriptionModifAct').val(response.Description);
                $('#DebutModifAct').val(response.Date_debut);
                $('#FinModifAct').val(response.Date_fin);
                $('#LieuxModifAct').val(response.Lieux);
                $('#ResponsableModifAct').val(response.Responsable);
                $('#CoutModifAct').val(response.Cout);

                $('#formModifActiv').modal('show');
            }
        });
    });


    $(document).on('click', '.deleteAct', function (e) {
        e.preventDefault();
        var recup = $(this).attr('id');
        $('.idhide').val(recup);
        $('#deleteModal').modal('show');

    });

    // Activite info =================================================================================================================


    $(document).on('click', '.controlePayement', function () {

        $('form#formPayement')[0].reset();

        var id = $(this).attr('id');
        console.log(id);
        var splite = split(id, '/');
        var activiteId = splite[0];
        var membreId = splite[1];

        $.ajax({
            method: "GET",
            url: "/affichageBarPayement",
            data: {
                'activiteId': activiteId,
                'membreId': membreId

            },
            dataType: "JSON",
            success: function (response) {

                // console.log(response.infoPayement.id);
                var statusPaye = response.infoPayement.Status_payement;
                var resteEngagement = response.infoPayement.Reste;
                $('.identParticiper').val(response.infoPayement.id);
                $('strong.affContr.nom').html(response.membreInfo.Nom);
                $('strong.affContr.prenom').html(response.membreInfo.Prenom);
                $('strong.affContr.filli').html(response.membreInfo.Filliere);
                $('strong.affContr.adres').html(response.membreInfo.Adresse);
                $('strong.affContr.promot').html(response.membreInfo.Promotion);
                $('#offcanvasRight').offcanvas('show');

                if (statusPaye == "PAYER") {
                    $('#flexRadioDefault1').prop('checked', true);
                    $('#montantEngage').hide();
                } else if (statusPaye == "NON PAYER") {
                    $('#flexRadioDefault2').prop('checked', true);
                    $('#montantEngage').hide();
                } else if (statusPaye == "ENGAGER") {
                    $('#montantEngage').show();
                    $('.engageMontant').val(resteEngagement);
                    $('#flexRadioDefault3').prop('checked', true);
                }

            }
        });
    });


    $(document).ready(function () {
        $(document).on('click', '#flexRadioDefault1', function () {

            $('#montantEngage').fadeOut(1000);
        });
        $(document).on('click', '#flexRadioDefault2', function () {

            $('#montantEngage').fadeOut(1000);
        });
        $(document).on('click', '#flexRadioDefault3', function () {

            $('#montantEngage').fadeIn(1000);
        });

    });







});
