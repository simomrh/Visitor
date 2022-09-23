@extends('layouts.app')

@section('content')
    <button class="btn btn-outline-success float-end addBtn" style="margin-top= 10%" data-toggle="modal"
        data-target="#userInfoModal">
        <i class="fa-solid fa-user-plus"></i> Créer Utilisateur
    </button>
    <br> <br>
    <div class="card">
        <div class="card-header">
            <i class="fa-solid fa-table-list"></i> Utilisateurs Liste
        </div>
        <div class="card-body">

            <table id="UserTable" class="display table table-hover" style="width:100%">
                <thead class="bg-light ">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Tél</th>
                        <th>Email</th>
                        <th>Département</th>
                        <th>RDV valid</th>
                        <th>Bloque Visiteur</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- <tr>
                                        <td id="last_name"></th>
                                        <td id="last_name"></th>
                                        <td id="first_name"></td>
                                        <td id="email"></td>
                                        <td id="telephone"></td>
                                        <td id="username"></td>
                                        <td id="role"></td>
                                        <td id="departement"></td>
                                        <td></td>
                                        <td></td>
                                        <td id="nomTd"><button type="button" class="btn btn-outline-primary editBtn" data-toggle="modal"
                                                data-target="#userInfoModal">Edit</button>
                                        </td>
                                    </tr>!-->

                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="userInfoModal" tabindex="-1" role="dialog" style="width:100%;">
        <div class="modal-dialog modal-lg" role="document" style="overflow:auto; max-height:90vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="user_modal_title">Nouveau Utilisateur</span></h5>
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
                        <div class="form_col">
                            <div class="form-group mb-2">
                                <label for="LoginUSR">LoginUSR</label>
                                <input type="text" class="form-control" id="LoginUSR" name="LoginUSR">
                                <span class="text-danger" id="error_LoginUSR"></span>
                            </div>
                            <div class="form-group  mb-2">
                                <label for="PassUSR">PassUSR</label>
                                <input type="password" class="form-control" id="PassUSR" name="PassUSR">
                                <span class="text-danger" id="error_PassUSR"></span>
                            </div>
                            <div class="form-group  mb-2">
                                <label for="RoleUSR">RoleUSR</label>
                                <select class="form-control" name="RoleUSR" id="RoleUSR" required>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                                <span class="text-danger" id="error_RoleUSR"></span>
                            </div>
                            <div class="form-group mb-2">
                                <label for="NomUSR">NomUSR</label>
                                <input type="text" class="form-control" id="NomUSR" name="NomUSR">
                                <span class="text-danger" id="error_NomUSR"></span>
                            </div>
                            <div class="form-group  mb-2">
                                <label for="PrenomUSR">PrenomUSR</label>
                                <input type="text" class="form-control" id="PrenomUSR" name="PrenomUSR">
                                <span class="text-danger" id="error_PrenomUSR"></span>
                            </div>
                        </div>
                        <div class="form_col">
                            <div class="form-group  mb-2">
                                <label for="GSMUSR">GSMUSR</label>
                                <input type="telephone" class="form-control" id="GSMUSR" name="GSMUSR">
                                <span class="text-danger" id="error_GSMUSR"></span>
                            </div>
                            <div class="form-group  mb-2">
                                <label for="EmailUSR">EmailUSR</label>
                                <input type="email" class="form-control" id="EmailUSR" name="EmailUSR">
                                <span class="text-danger" id="error_EmailUSR"></span>
                            </div>

                            <div class="form-group  mb-2">
                                <label for="IdDEP">IdDEP</label>
                                <select class="form-control" name="IdDEP" id="IdDEP" required>
                                    @foreach ($departements as $departement)
                                        <option value="{{ $departement->IdDEP }}">{{ $departement->NomDEP }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="error_IdDEP"></span>
                            </div>

                            <div class="form-group  mb-2">
                                <label> Actions : </label><br>
                                <label><input type="checkbox" name="ValideRD[]" value="1"> Valider
                                    Rendez-vous</label> <span>/</span>
                                <label><input type="checkbox" name="ValideRD[]" value="1"> Annuler</label>
                            </div>
                            <div class="form-group  mb-2">
                                <label> <input type="checkbox" name="BloqueVS[]" value="1"> Bloque Visiteur</label>
                            </div>
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
                        <div class="form_col">
                            <div class="form-group mb-2">
                                <label for="LoginUSR">LoginUSR</label>
                                <input type="text" class="form-control" id="LoginUSR" name="LoginUSR">
                                <span class="text-danger" id="error_LoginUSR"></span>
                            </div>
                            <!-- <div class="form-group  mb-2">
                                        <label for="exampleFormControlInput1">PassUSR</label>
                                        <input type="password" class="form-control" id="PassUSR" name="PassUSR">
                                        <span class="text-danger" id="error_PassUSR"></span>
                                    </div>!-->
                            <div class="form-group  mb-2">
                                <label for="RoleUSR">RoleUSR</label>
                                <select class="form-control" name="RoleUSR" id="RoleUSR" required>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                                <span class="text-danger" id="error_RoleUSR"></span>
                            </div>
                            <div class="form-group mb-2">
                                <label for="NomUSR">NomUSR</label>
                                <input type="text" class="form-control" id="NomUSR" name="NomUSR">
                                <span class="text-danger" id="error_NomUSR"></span>
                            </div>
                            <div class="form-group  mb-2">
                                <label for="PrenomUSR">PrenomUSR</label>
                                <input type="text" class="form-control" id="PrenomUSR" name="PrenomUSR">
                                <span class="text-danger" id="error_PrenomUSR"></span>
                            </div>


                            <div class="form-group  mb-2">
                                <label for="GSMUSR">GSMUSR</label>
                                <input type="telephone" class="form-control" id="GSMUSR" name="GSMUSR">
                                <span class="text-danger" id="error_GSMUSR"></span>
                            </div>
                        </div>
                        <div class="form_col">
                            <div class="form-group  mb-2">
                                <label for="EmailUSR">EmailUSR</label>
                                <input type="email" class="form-control" id="EmailUSR" name="EmailUSR">
                                <span class="text-danger" id="error_EmailUSR"></span>
                            </div>

                            <div class="form-group  mb-2">
                                <label for="IdDEP">IdDEP</label>
                                <select class="form-control" name="IdDEP" id="IdDEP" required>
                                    @foreach ($departements as $departement)
                                        <option value="{{ $departement->IdDEP }}">{{ $departement->NomDEP }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="error_IdDEP"></span>
                            </div>
                            <div class="form-group  mb-2">
                                <label> Actions : </label><br>
                                <label><input type="checkbox" id="ValideRD" name="ValideRD[]" value="1"> Valider
                                    Rendez-vous</label>
                            </div>
                            <div class="form-group  mb-2">
                                <label> <input type="checkbox" id="BloqueVS" name="BloqueVS[]" value="1"> Bloque
                                    Visiteur</label>
                            </div>
                        </div>
                        <div class="form-group" id="messageEdit">

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
        function format(d) {
            // `d` is the original data object for the row
            return (
                '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                '<tr>' +
                '<td>Crée par:</td>' +
                '<td>' +
                d.UserCr +
                '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Crée le</td>' +
                '<td>' +
                d.DateCr +
                '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Modifié par:</td>' +
                '<td>' + d.UserUp + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Modifié le:</td>' +
                '<td>' + d.DateUp + '</td>' +
                '</tr>' +
                '</table>'
            );
        }

        $(document).ready(function() {
            var table = $('#UserTable').DataTable({
                language: {
        url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json",
        processing: "<span class='fa-stack fa-lg'>\n\
                            <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
                       </span>"
    },
                ajax: "{{ route('api.users') }}",
                processing: true,
                columns: [{
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: '',

                    },

                    {
                        data: 'idUSR'
                    },
                    {
                        data: 'LoginUSR'
                    },
                    {
                        data: 'RoleUSR'
                    },
                    {
                        data: 'NomUSR'
                    },
                    {
                        data: 'PrenomUSR'
                    },
                    {
                        data: 'GSMUSR'
                    },
                    {
                        data: 'EmailUSR'
                    },
                    {
                        data: 'IdDEP'
                    },
                    {
                        data: 'ValideRD',
                        render: function(data, type, row) {

                            if (row.ValideRD === 1) {

                                return '<span class="btn btn-success">Oui</span>';

                            } else {

                                return '<span class="btn btn-danger">Non</span >';

                            }
                        }
                    },
                    {
                        data: 'BloqueVS',
                        render: function(data, type, row) {

                            if (row.BloqueVS === 1) {

                                return '<span class="btn btn-success">Oui</span>';

                            } else {

                                return '<span class="btn btn-danger">Non</span >';

                            }
                        }
                    },
                    {
                        defaultContent: '<button class="btn btn-outline-primary edit" data-toggle="modal" data-target="#userEditModal"><i class="fa-solid fa-pen icon"></i></button>',

                    },

                ],
                order: [
                    [1, 'asc']
                ],
            });
            $('#UserTable').on('click', '.edit', function(e) {

                e.preventDefault();
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#idUSR ').val(data[1]);
                $('#LoginUSR ').val(data[2]);
                $('#RoleUSR ').val(data[3]);
                $('#NomUSR ').val(data[4]);
                $('#PrenomUSR ').val(data[5]);
                $('#GSMUSR ').val(data[6]);
                $('#EmailUSR ').val(data[7]);
                $('#IdDEP ').val(data[8]);
                $('#ValideRD ').val(data[9]);
                $('#BloqueVS ').val(data[10]);

            });
            $(document).on("click", ".btnUpdate", function(event) {
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                var idUSR = $("input[id=idUSR]").val();
                $.ajax({
                    url: "{{ url('update_user') }}" + '/' + idUSR,
                    type: "PUT",
                    data: $("#userFormEdit").serialize(),
                    success: function(data, textStatus, xhr) {
                        $('#messageEdit').html('');
                        if (xhr.status === 201) {
                            $('#messageEdit').html(
                                '<div class="alert alert-success" id="messageEdit" role="alert">' +
                                data
                                .message + '</div>');

                            $("#userFormEdit")[0].reset();
                            table.ajax.reload();
                        } else {
                            $('#messageEdit').html(
                                '<div class="alert alert-warning" id="messageEdit" role="alert">' +
                                data
                                .error + '</div>');
                        }
                    },
                    error: function(response) {
                        var errors = Object.keys(response.responseJSON.errors);
                        $("#userFormEdit input, #userFormEdit select , #userFormEdit checkbox")
                            .each(
                                function(index,
                                    item) {
                                    var id = $(item).attr('id');
                                    if (errors.includes(id)) {
                                        $('#' + id).next("span").text(
                                            "field is required or invalid.");
                                    }
                                });
                    },
                });
            });

            // Add event listener for opening and closing details
            $('#UserTable tbody').on('click', 'td.dt-control', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }
            });
        });
    </script>
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
                data: $("#userForm").serialize(),
                success: function(data, textStatus, xhr) {
                    $('#message').html('');
                    if (xhr.status === 201) {
                        $('#message').html(
                            '<div class="alert alert-success" id="message" role="alert">' + data
                            .success + '</div>');

                        $("#userForm")[0].reset();
                        location.reload();
                    } else {
                        $('#message').html(
                            '<div class="alert alert-warning" id="message" role="alert">' + data
                            .error + '</div>');
                    }
                },
                error: function(response) {
                    var errors = Object.keys(response.responseJSON.errors);
                    $("#userForm input, #userForm select , #userForm checkbox").each(function(index,
                        item) {
                        var id = $(item).attr('id');
                        if (errors.includes(id)) {
                            $('#' + id).next("span").text("field is required or invalid.");
                        }
                    });
                },
            });
        });
    </script>
@endpush
