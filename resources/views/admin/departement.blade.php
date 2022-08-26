@extends('layouts.app')




@section('content')
    <button class="btn btn-outline-success float-end addBtn" style="margin-top= 10%" data-toggle="modal"
        data-target="#userInfoModal">
        + Ajouter
    </button>


    <table class="table table-hover " style="margin-top:10% ;">
        <thead class="bg-light">
            <tr>
                <th scope="col">Nom Département</th>
                <th scope="col">Créer par</th>
                <th scope="col">Créer en</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departements as $departement)
                <tr>

                    <td >{{ $departement->NomDEP}}</td>
                    <td>{{ $departement->UserCr}}</td>
                    <td>{{ $departement->DateCr}}</td>
                    <td id="nomTd"><button type="button" class="btn btn-outline-primary editBtn" data-toggle="modal"
                            data-target="#userInfoModal">Edit</button>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>

    <div class="modal fade" id="userInfoModal" tabindex="-1" role="dialog" style="width:100%;">
        <div class="modal-dialog modal-lg" role="document" style="overflow:auto; max-height:90vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="user_modal_title"></span></h5>
                    <button type="button" class="btn btn-outline-danger close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">✗</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="userForm">
                        <div class="form-group mb-2">
                            <label for="exampleFormControlInput1">NomDEP</label>
                            <input type="text" class="form-control" id="NomDEP" name="NomDEP">
                            <span class="text-danger" id="error_NomDEP"></span>
                        </div>

                        <div class="form-group" id="message">

                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnEnreg">Enregistrer</button>
                    <button type="button" class="btn btn-secondary btnAnnul" data-dismiss="modal">Annuler</button>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script type="text/javascript">
        $(document).on("click", ".btnEnreg", function(event) {
            event.preventDefault();
            form_data = $("#userForm").serialize()
            $("#userForm input").each(function(index, item) {
                $(item).next("span").text('');
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/store_departement",
                type: "POST",
                data: form_data,
                success: function(data, textStatus, xhr) {
                    $('#message').html('');
                    if (xhr.status === 201) {
                        $('#message').html(
                            '<div class="alert alert-success" id="message" role="alert">' + data
                            .success + '</div>');

                        $("#userForm")[0].reset();
                    } else {
                        $('#message').html(
                            '<div class="alert alert-warning" id="message" role="alert">' + data
                            .error + '</div>');
                    }
                },
                error: function(response) {

                    var errors = response.responseJSON.errors;
                    $("#userForm input").each(function(index, item) {
                        var id = $(item).attr('id');
                        if (errors.includes(id)) {
                            $('#' + id).next("span").text("field is required or invalid.");
                        }
                    });
                },
            });
        });
    </script>
    <script>
        $(document).on("click", ".addBtn, .editBtn", function() {

            if ($(this).hasClass("addBtn")) {
                $("#userForm input, #userForm select").each(function() {
                    $(this).val();
                });
            } else {
                $(this).parent().parent().find("td").each(function() {
                    $("*[name='" + $(this).attr("id") + "']").val($(this).text());
                });
            }

            $("#userInfoModal #user_modal_title").text(
                ($(this).hasClass("addBtn")) ? "Nouvel Departement" : "Modification Departement"
            );
        });
    </script>
@endpush
