@extends('layouts.app')

@section('content')
    <button class="btn btn-outline-success float-end addBtn" style="margin-top= 10%" data-toggle="modal"
        data-target="#RendezVousModal">
        <i class="fa-regular fa-calendar-plus"></i> Créer Rendez-vous
    </button>
    <br> <br>
    <div class="card">
        <div class="card-header">
            <i class="fa-solid fa-table-list"></i>  Rendez-vous Liste
        </div>
        <div class="card-body">
            <table class="table table-hover " id="RendezVousTable" style="width:100%">

                <thead class="bg-light">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"> IdRD </th>
                        <th scope="col">DateRDV</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>


                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="RendezVousModal" tabindex="-1" role="dialog" style="width:100%;">
        <div class="modal-dialog modal-lg" role="document" style="overflow:auto; max-height:90vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="user_modal_title">Nouveau Rendez-vous</span></h5>
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
                    <form id="RendezVousForm">
                        <div class="form_col">
                            <div class="form-group mb-2">
                                <label for="SearchVisiteur">Visiteur existant</label>
                                <select class="form-control" name="VisiteurExist" id="VisiteurExist">
                                    <option value>Choisir CIN Visite</option>
                                    @foreach ($visiteurs as $visiteur)
                                        <option value="{{ $visiteur->IdVS }}">{{ $visiteur->CINVS }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!--<div class="form-group mb-2">
                                                                <label for="IdVS">ID</label>
                                                                <input type="text" class="form-control" id="IdVS" name="IdVS" readonly
                                                                    placeholder="Nouveau visiteur" />
                                                            </div>!-->
                            <div class="form-group mb-2">
                                <label for="NomVS">Nom Complet Visiteur</label>
                                <input type="text" class="form-control" id="NomVS" name="NomVS">
                                <span class="text-danger" id="error_NomVS"></span>
                            </div>
                            <div class="form-group  mb-2">
                                <label for="CINVS">CIN Visiteur </label>
                                <input type="text" class="form-control" id="CINVS" name="CINVS">
                                <span class="text-danger" id="error_CINVS"></span>
                            </div>
                            <div class="form-group  mb-2">
                                <label for="GSMVS">Telephone Visiteur </label>
                                <input type="telephone" class="form-control" id="GSMVS" name="GSMVS">
                                <span class="text-danger" id="error_GSMVS"></span>
                            </div>
                            <div class="form-group mb-2">
                                <label for="EmailVS">Email Visiteur</label>
                                <input type="email" class="form-control" id="EmailVS" name="EmailVS">
                                <span class="text-danger" id="error_EmailVS"></span>
                            </div>
                            <div class="form-group  mb-2">
                                <label for="IdDEP">Departement</label>
                                <select class="form-control" name="IdDEP" id="IdDEP" required>
                                    @foreach ($departements as $departement)
                                        <option value="{{ $departement->IdDEP }}">{{ $departement->NomDEP }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="error_IdDEP"></span>
                            </div>
                        </div>
                        <div class="form_col">

                            <div class="form-group  mb-2">
                                <label for="IdDEP">Hébergeur</label>
                                <select class="form-control" name="idUSR" id="idUSR" required>
                                   <option value="">choisir</option>
                                   @foreach ($users as $user)
                                        <option value="{{ $user->idUSR }}">{{ $user->NomUSR }} {{ $user->PrenomUSR }} </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="error_IdDEP"></span>
                            </div>
                            <div class="form-group  mb-2">
                                <label for="NomRS">Raison Visite</label>
                                <input type="text" class="form-control" id="RaisonVis" name="RaisonVis">
                                <span class="text-danger" id="error_RaisonVis"></span>
                            </div>

                            <div class="form-group  mb-2">
                                <label for="SocieteVS">Societe Visiteur</label>
                                <input type="telephone" class="form-control" id="SocieteVS" name="SocieteVS">
                                <span class="text-danger" id="error_SocieteVS"></span>
                            </div>

                            <div class="form-group  mb-2">
                                <label for="NomTP">Type Visite</label>
                                <select class="form-control" name="IdTP" id="IdTP" required>
                                    @foreach ($typesVisite as $item)
                                        <option value="{{ $item->IdTP }}">{{ $item->NomTP }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="error_NomTP"></span>
                            </div>



                            <div class="form-group  mb-2">
                                <label for="DateRDV">Date Rendez-vous</label>
                                <input type="datetime-local" step="1" class="form-control"  id="DateRDV"
                                    name="DateRDV">
                                <span class="text-danger" id="error_DateRDV"></span>
                            </div>
                            {{-- <div class="form-group  mb-2">
                                <label for="DateFin">Date Fin Rendez-vous</label>
                                <input type="datetime-local" step="1" class="form-control" id="DateFin" name="DateFin">
                                <span class="text-danger" id="error_DateFin"></span>
                            </div> --}}
                        </div>
                        <div class="form-group" id="messageRendezVous">

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

    <div class="modal fade" id="RendezVousEditModal" tabindex="-1" role="dialog" style="width:100%;">
        <div class="modal-dialog modal-lg" role="document" style="overflow:auto; max-height:90vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="user_modal_title"></span>Modification Rendez-vous</h5>
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
                    <form id="RendezVousFormEdit">
                        <input type="hidden" class="form-control" id="IdRD" name="IdRD">

                        <div class="form-group  mb-2">
                            <label for="DateRDV">Date Rendez-vous</label>
                            <input type="datetime-local" step="1" class="form-control"  id="DateRDV"
                                name="DateRDV">
                            <span class="text-danger" id="error_DateRDV"></span>
                        </div>



                        <div class="form-group" id="messageEditRendezVous">

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
            $('#VisiteurExist').on('change', function() {

                var IdVS = $(this).val();
                $.ajax({
                    url: "{{ url('getDetails') }}" + '/' + IdVS,
                    type: 'get',
                    success: function(response) {

                        $('input[id="NomVS"]').prop("readonly", true).val(response.NomVS);
                        $('input[id="CINVS"]').prop("readonly", true).val(response.CINVS);
                        $('input[id="GSMVS"]').prop("readonly", true).val(response.GSMVS);
                        $('input[id="EmailVS"]').prop("readonly", true).val(response.EmailVS);
                        $('input[id="SocieteVS"]').prop("readonly", true).val(response
                            .SocieteVS);
                        $('input[id="NomTP"]').prop("readonly", true).val(response.IdTP);
                    }
                });
            });
        });
        /*$(document).ready(function() {
            $('#IdDEP').on('change', function() {

                var IdDEP = $(this).val();


                $.ajax({
                    url: "{{ url('Dropdown') }}" + '/' + IdDEP,
                    type: 'get',
                    success: function(response) {

                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {

                                var idUSR = response['data'][i].idUSR;
                                var LoginUSR = response['data'][i].LoginUSR;

                                var option = "<option value='" + idUSR + "'>" + LoginUSR + "</option>";

                                $("#idUSR").append(option);
                                $('#idUSR').val(response['data'][i].idUSR);
                            }

                        }

                    }
                });

            });
        });*/
    </script>

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
            var table = $('#RendezVousTable').DataTable({
                language: {
        url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
    },
                ajax: "{{ route('api.roundez') }}",
                processing: true,
                columns: [{
                        className: 'dt-control',
                        data: null,
                        defaultContent: '',
                    },
                    {
                        data: 'IdRD'
                    },

                    {
                        data: 'DateRDV'
                    },
                    {
                        defaultContent: '<button class="btn btn-outline-primary edit" data-toggle="modal" data-target="#RendezVousEditModal"><i class="fa-solid fa-pen icon"></i></button>',

                    },
                ],
                order: [
                    [1, 'asc']
                ],
            });
            $('#RendezVousTable').on('click', '.edit', function(e) {

                e.preventDefault();
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#IdRD ').val(data[1]);
                $('#DateRDV ').val(data[2]);


            });
            $(document).on("click", ".btnUpdate", function(event) {
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                var IdRD = $("input[id=IdRD]").val();
                $.ajax({
                    url: "{{ url('update_rendezVous') }}" + '/' + IdRD,
                    type: "PUT",
                    data: $("#RendezVousFormEdit").serialize(),
                    success: function(data, textStatus, xhr) {
                        $('#messageEditRendezVous').html('');
                        if (xhr.status === 201) {
                            $('#messageEditRendezVous').html(
                                '<div class="alert alert-success" id="messageEditRendezVous" role="alert">' +
                                data
                                .message + '</div>');

                            $("#RendezVousFormEdit")[0].reset();
                            $("#RendezVousEditModal").modal('hide');
                            table.ajax.reload();
                        } else {
                            $('#messageEditRendezVous').html(
                                '<div class="alert alert-warning" id="messageEditRendezVous" role="alert">' +
                                data
                                .error + '</div>');
                        }
                    },
                    error: function(response) {
                        var errors = Object.keys(response.responseJSON.errors);
                        $("#RendezVousEditModal input, #RendezVousEditModal select").each(
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
            $(".reloadBtn").on('click', function() {
                setInterval(function() {
                    table.ajax.reload();
                }, 3000);
            });
            // Add event listener for opening and closing details
            $('#RendezVousTable tbody').on('click', 'td.dt-control', function() {
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
            form_data = $("#RendezVousForm").serialize()
            $("#RendezVousForm input").each(function(index, item) {
                $(item).next("span").text('');
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/store_rendezVous",
                type: "POST",
                data: form_data,
                success: function(data, textStatus, xhr) {
                    $('#message').html('');
                    if (xhr.status === 201) {
                        $('#messageRendezVous').html(
                            '<div class="alert alert-success" id="messageRendezVous" role="alert">' +
                            data
                            .success + '</div>');

                        $("#RendezVousForm")[0].reset();
                        location.reload();
                    } else {
                        $('#messageRendezVous').html(
                            '<div class="alert alert-warning" id="messageRendezVous" role="alert">' +
                            data
                            .error + '</div>');
                    }
                },
                error: function(response) {
                    var errors = Object.keys(response.responseJSON.errors);
                    $("#RendezVousForm input, #RendezVousForm select").each(function(index, item) {
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
