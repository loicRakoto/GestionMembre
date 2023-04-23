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
                            <a href="#" id="'+ Item.id + '" class="modification"><i class="fa-solid fa-pencil" style="color: rgb(25 103 58);"></i></a> \
                            <a href="#" id="'+ Item.id + '" class="delete" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-user-slash" style="color: rgb(219, 25, 25)"></i></a>\
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
                            <a href="#" id="'+ Item.id + '" class="modification"><i class="fa-solid fa-pencil" style="color: rgb(25 103 58);"></i></a> \
                            <a href="#" id="'+ Item.id + '" class="delete" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-user-slash" style="color: rgb(219, 25, 25)"></i></a>\
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


});
