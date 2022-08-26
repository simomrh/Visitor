@extends('layouts.app')

@section('content')
    <button class="btn btn-outline-success float-end addBtn" style="margin-top= 10%" data-toggle="modal"
        data-target="#userInfoModal">
        + Ajouter
    </button>
    <table class="table table-hover " style="margin-top:10% ;">
        <thead class="bg-light">
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">email</th>
                <th scope="col">Télephone</th>
                <th scope="col">User Name</th>
                <th scope="col">Role</th>
                <th scope="col">n° Département</th>
                <th scope="col">Créer par</th>
                <th scope="col">Créer en</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td id="last_name">{{ $user->NomUSR }}</th>
                    <td id="first_name">{{ $user->PrenomUSR }}</td>
                    <td id="email">{{ $user->EmailUSR }}</td>
                    <td id="telephone">{{ $user->GSMUSR }}</td>
                    <td id="username">{{ $user->LoginUSR }}</td>
                    <td id="role">{{ $user->RoleUSR }}</td>
                    <td id="departement">{{ $user->IdDEP }}</td>
                    <td>{{ $user->UserCr }}</td>
                    <td>{{ $user->DateCr }}</td>
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
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form id="userForm">
                        <div class="form-group mb-2">
                            <label for="exampleFormControlInput1">LoginUSR</label>
                            <input type="text" class="form-control" id="LoginUSR" name="LoginUSR">
                            <span class="text-danger" id="error_LoginUSR"></span>
                        </div>
                        <div class="form-group  mb-2">
                            <label for="exampleFormControlInput1">PassUSR</label>
                            <input type="password" class="form-control" id="PassUSR" name="PassUSR">
                            <span class="text-danger" id="error_PassUSR"></span>
                        </div>
                        <div class="form-group  mb-2">
                            <label for="exampleFormControlSelect1">RoleUSR</label>
                            <select class="form-control" name="RoleUSR" id="RoleUSR" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                            <span class="text-danger" id="error_RoleUSR"></span>
                        </div>
                        <div class="form-group mb-2">
                            <label for="exampleFormControlInput1">NomUSR</label>
                            <input type="text" class="form-control" id="NomUSR" name="NomUSR">
                            <span class="text-danger" id="error_NomUSR"></span>
                        </div>
                        <div class="form-group  mb-2">
                            <label for="exampleFormControlInput1">PrenomUSR</label>
                            <input type="text" class="form-control" id="PrenomUSR" name="PrenomUSR">
                            <span class="text-danger" id="error_PrenomUSR"></span>
                        </div>
                        <div class="form-group  mb-2">
                            <label for="exampleFormControlInput1">GSMUSR</label>
                            <input type="telephone" class="form-control" id="GSMUSR" name="GSMUSR">
                            <span class="text-danger" id="error_GSMUSR"></span>
                        </div>
                        <div class="form-group  mb-2">
                            <label for="exampleFormControlInput1">EmailUSR</label>
                            <input type="email" class="form-control" id="EmailUSR" name="EmailUSR">
                            <span class="text-danger" id="error_EmailUSR"></span>
                        </div>

                        <div class="form-group  mb-2">
                            <label for="exampleFormControlSelect1">IdDEP</label>
                            <select class="form-control" name="IdDEP" id="IdDEP" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <span class="text-danger" id="error_IdDEP"></span>
                        </div>

                        <div class="form-group" id="message">

                        </div>

                        <!--<button  type="submit" class="btn btn-outline-success nav_name " style="margin-top= 10%">
                                                                                        <i class='bx bx-user nav_icon'></i> <span class="nav_name"> Submit</span>
                                                                                      </button>-->
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnEnreg">Enregistrer</button>
                    <button type="button" class="btn btn-secondary btnAnnul" data-dismiss="modal">Annuler</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="userEditModal" tabindex="-1" role="dialog" style="width:100%;">
        <div class="modal-dialog modal-lg" role="document" style="overflow:auto; max-height:90vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="user_modal_title"></span>Modification Utilisateur</h5>
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
                    <form id="userFormEdit">
                        <input type="hidden" class="form-control" id="idUSR" name="idUSR">
                        <div class="form-group mb-2">
                            <label for="exampleFormControlInput1">LoginUSR</label>
                            <input type="text" class="form-control" id="LoginUSR" name="LoginUSR">
                            <span class="text-danger" id="error_LoginUSR"></span>
                        </div>
                        <div class="form-group  mb-2">
                            <label for="exampleFormControlInput1">PassUSR</label>
                            <input type="password" class="form-control" id="PassUSR" name="PassUSR">
                            <span class="text-danger" id="error_PassUSR"></span>
                        </div>
                        <div class="form-group  mb-2">
                            <label for="exampleFormControlSelect1">RoleUSR</label>
                            <select class="form-control" name="RoleUSR" id="RoleUSR" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                            <span class="text-danger" id="error_RoleUSR"></span>
                        </div>
                        <div class="form-group mb-2">
                            <label for="exampleFormControlInput1">NomUSR</label>
                            <input type="text" class="form-control" id="NomUSR" name="NomUSR">
                            <span class="text-danger" id="error_NomUSR"></span>
                        </div>
                        <div class="form-group  mb-2">
                            <label for="exampleFormControlInput1">PrenomUSR</label>
                            <input type="text" class="form-control" id="PrenomUSR" name="PrenomUSR">
                            <span class="text-danger" id="error_PrenomUSR"></span>
                        </div>
                        <div class="form-group  mb-2">
                            <label for="exampleFormControlInput1">GSMUSR</label>
                            <input type="telephone" class="form-control" id="GSMUSR" name="GSMUSR">
                            <span class="text-danger" id="error_GSMUSR"></span>
                        </div>
                        <div class="form-group  mb-2">
                            <label for="exampleFormControlInput1">EmailUSR</label>
                            <input type="email" class="form-control" id="EmailUSR" name="EmailUSR">
                            <span class="text-danger" id="error_EmailUSR"></span>
                        </div>

                        <div class="form-group  mb-2">
                            <label for="exampleFormControlSelect1">IdDEP</label>
                            <select class="form-control" name="IdDEP" id="IdDEP" required>
                            @foreach($departements as $departement)
                                <option value="{{$departement->IdDEP}}">{{$departement->NomDEP}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="error_IdDEP"></span>
                        </div>

                        <div class="form-group" id="message">

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
                url: "/store_user",
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
                    var errors = Object.keys(response.responseJSON.errors);
                    $("#userForm input, #userForm select").each(function(index, item) {
                        var id = $(item).attr('id');
                        if (errors.includes(id)) {
                            $('#' + id).next("span").text("field is required or invalid.");
                        }
                    });
                },
            });
        });
    </script>
    <script type="text/javascript">
        $(document).on("click", ".editBtn"  function() {

           $("#userEditModal").model("show");
           $tr =$(this).closest('tr');

           var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();


        console.log(data);
        $('#idUSR').val(data[0]);
        $('#LoginUSR').val(data[1]);
        $('#PassUSR ').val(data[2]);
        $('#RoleUSR').val(data[3]);
        $('#NomUSR').val(data[4]);
        $('#PrenomUSR').val(data[5]);
        $('#GSMUSR').val(data[6]);
        $('#EmailUSR').val(data[7]);
        $('#IdDEP').val(data[8]);

        });
        $("#userFormEdit").on("click" , ".btnUpdate" , function(event){
           event.preventDefault();
           var idUSR = $("#idUSR").val();
           $.ajax({
              type:"PUT",
              url:"/update_user/"+IdUSR,
              data: $("#userFormEdit").serialize(),
           success: function(response){
            console.log(response);
            $("#userEditModal").model('hide');
            alert("data updated successfully");
           },
           error: function(error){
            console.log(error);
           }
           });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on("click", ".addBtn, .editBtn", function() {

                if ($(this).hasClass("addBtn")) {
                    $("#userForm input, #userForm select").each(function() {
                        $(this).val('');
                    });
                } else {
                    $(this).parent().parent().find("td").each(function() {
                        $("*[name='" + $(this).attr("id") + "']").val($(this).text());
                    });
                }

                $("#userInfoModal #user_modal_title").text(
                    ($(this).hasClass("addBtn")) ? "Nouvel Utilisateur" : "Modification Utilisateur"
                );
            });
        })
    </script>
@endpush
