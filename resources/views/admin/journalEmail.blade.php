@extends('layouts.app')




@section('content')



    <table class="table table-hover" id="DepartementTable" style="margin-top:10% ;">
        <thead class="bg-light">
            <tr>

                <th scope="col">Id Rendez-vous</th>
                <th scope="col">Id Visiteur</th>
                <th scope="col">Contenu Email</th>
                <th scope="col">Date Email</th>
                <th scope="col">Errors Email</th>
                <th scope="col">Confirmer</th>
                <th scope="col">Annuler</th>
                <th scope="col">Rate</th>
                <th scope="col">Créer par</th>
                <th scope="col">Créer en</th>
                <th scope="col">mettre à jour par</th>
                <th scope="col">mettre à jour en</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

                <tr>
                    <td id="IdRD"></td>
                    <td id="IdVS"></td>
                    <td id="ContenuEM"></td>
                    <td id="DateEM"></td>
                    <td id="ErrorsEM"></td>
                    <td id="Confirmer"></td>
                    <td id="Annuler"></td>
                    <td id="Rate"></td>
                    <td id="UserCr"></td>
                    <td id="DateCr"></td>
                    <td id="UserUp"></td>
                    <td id="DateUp"></td>
                    
                </tr>



        </tbody>
    </table>

    <div class="modal fade" id="DepartementInfoModal" tabindex="-1" role="dialog" style="width:100%;">
        <div class="modal-dialog modal-lg" role="document" style="overflow:auto; max-height:90vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="user_modal_title"></span></h5>
                    <button type="button" class="btn btn-outline-danger close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">✗</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="departementForm">
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
    <div class="modal fade" id="DepartementEditModal" tabindex="-1" role="dialog" style="width:100%;">
        <div class="modal-dialog modal-lg" role="document" style="overflow:auto; max-height:90vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="user_modal_title"></span>Modification Deparetement</h5>
                    <button type="button" class="btn btn-outline-danger close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">✗</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form id="DepartementFormEdit">
                        <input type="hidden" class="form-control" id="IdDEP" name="IdDEP">
                        <div class="form-group mb-2">
                            <label for="exampleFormControlInput1">NomDEP</label>
                            <input type="text" class="form-control" id="NomDEP" name="NomDEP">
                            <span class="text-danger" id="error_NomDEP"></span>
                        </div>

                        <div class="form-group" id="messageEditDep">

                        </div>

                        <!--<button  type="submit" class="btn btn-outline-success nav_name " style="margin-top= 10%">
                                                                                                <i class='bx bx-user nav_icon'></i> <span class="nav_name"> Submit</span>
                                                                                              </button>-->
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnUpdate">Update</button>
                    <button type="button" class="btn btn-secondary btnAnnul" data-dismiss="modal">Annuler</button>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#DepartementTable').DataTable();
        });
    </script>
    <script type="text/javascript">
        $(document).on("click", ".btnEnreg", function(event) {
            event.preventDefault();
            form_data = $("#departementForm").serialize()
            $("#departementForm input").each(function(index, item) {
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
                error: function(error) {

                    console.log(error);
                },
            });
        });
    </script>
    <script type="text/javascript">
        $(document).on("click", ".editBtn", function(e) {
            e.preventDefault();

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();


            console.log(data);
            $('#IdDEP').val(data[0]);
            $('#NomDEP').val(data[1]);


        });
        $(document).on("click", ".btnUpdate", function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var IdDEP = $("input[id=IdDEP]").val();
            $.ajax({
                url: "{{ url('update_departement') }}" + '/' + IdDEP,
                type: "PUT",
                data: $("#DepartementFormEdit").serialize(),
                success: function(data, textStatus, xhr) {
                    $('#messageEditDep').html('');
                    if (xhr.status === 201) {
                        $('#messageEditDep').html(
                            '<div class="alert alert-success" id="messageEditDep" role="alert">' +
                            data
                            .message + '</div>');

                        $("#DepartementFormEdit")[0].reset();
                    } else {
                        $('#messageEditDep').html(
                            '<div class="alert alert-warning" id="messageEditDep" role="alert">' +
                            data
                            .error + '</div>');
                    }
                },
                error: function(response) {
                    var errors = Object.keys(response.responseJSON.errors);
                    $("#userFormEdit input, #userFormEdit select").each(function(index, item) {
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
        $('td').hover(function() {
            $(this).parent().children().css("background-color", "#e5e5e5");
            $(this).css("background-color", "#fcf6bd")
        });

        $('tr').mouseleave(function() {
            $(this).children('td').css("background-color", "#ffffff"); // or whatever
        });
    </script>
@endpush
