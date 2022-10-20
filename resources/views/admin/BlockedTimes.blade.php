@extends('layouts.app')

@section('content')


<br> <br>
    <div class="card list"  >
        <div class="card-header list_title">
            <i class="fa-solid fa-table-list"></i>   Temps Intervalle Liste

        </div>

        <div class="card-body list_body">
            <button class="btn btn-outline-success addBtn" style="margin-top= 10%; float: right;" data-toggle="modal"
        data-target="#BlockedTimesModal">
        <i class="fa-solid fa-plus"></i>  Créer Temps Intervalle
    </button>
            <a class="btn btn-outline-success float-start addBtn" href="{{url('/exportBT')}}">
                <i class="fa-solid fa-file-export"></i> Export CSV
            </a>
    <table class="table table-hover " id="blockedTimesTables" style="width:100%">
        <thead class="bg-light">
            <tr>
                <th scope="col"></th>
                <th scope="col">ID</th>
                <th scope="col">DateDeb</th>
                <th scope="col">DateFin</th>
                <th scope="col">IdDEP</th>

                <th scope="col">Action</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>


        </tbody>
    </table>
</div>
</div>
    <div class="modal fade" id="BlockedTimesModal" tabindex="-1" role="dialog" style="width:100%;">
        <div class="modal-dialog modal-lg" role="document" style="overflow:auto; max-height:90vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="BlockedTimeTitle"></span>Ajouter Temp Intervalle</h5>
                    <button type="button" class="btn btn-outline-danger close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form id="blockedTimesForm">

                        <div class="form-group  mb-2">
                            <label for="IdDEP">Department</label>
                            <select class="form-control" name="IdDEP" id="IdDEP" required>
                                @foreach ($departements as $departement)
                                    <option value="{{ $departement->IdDEP }}">{{ $departement->NomDEP }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="error_IdDEP"></span>
                        </div>


                        <div class="form-group  mb-2">
                            <label for="DateDeb">Date Début </label>
                            <input type="datetime-local" step="1" class="form-control" id="DateDeb" name="DateDeb">
                            <span class="text-danger" id="error_DateDeb"></span>
                        </div>

                        <div class="form-group  mb-2">
                            <label for="DateFin">Date Fin </label>
                            <input type="datetime-local" step="1" class="form-control" id="DateFin" name="DateFin">
                            <span class="text-danger" id="error_DateFin"></span>
                        </div>

                        <div class="form-group" id="messageBlockedTimes">


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

    <div class="modal fade" id="BlockedTimeEdit" tabindex="-1" role="dialog" style="width:100%;">
        <div class="modal-dialog modal-lg" role="document" style="overflow:auto; max-height:90vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="titleBT">Modification Temp Intervalle</span></h5>
                    <button type="button" class="btn btn-outline-danger close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="blockedTimesEditForm">
                        <input type="hidden" class="form-control" id="IdBT" name="IdBT">




                        <div class="form-group  mb-2">
                            <label for="DateDeb">Date Début </label>
                            <input type="datetime-local" step="1" class="form-control" id="DateDeb" name="DateDeb">
                            <span class="text-danger" id="error_DateDeb"></span>
                        </div>
                        <div class="form-group  mb-2">
                            <label for="DateFin">Date Fin </label>
                            <input type="datetime-local" step="1" class="form-control" id="DateFin" name="DateFin">
                            <span class="text-danger" id="error_DateFin"></span>
                        </div>

                        <div class="form-group  mb-2">
                            <label for="IdDEP"> Department</label>
                            <select class="form-control" name="IdDEP" id="IdDEP" required>
                                @foreach ($departements as $departement)
                                    <option value="{{ $departement->IdDEP }}">{{ $departement->NomDEP }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="error_IdDEP"></span>
                        </div>
                        <div class="form-group" id="messageEditBT">

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
    <div class="modal fade" id="BlockedTimeDelete" tabindex="-1" role="dialog" style=" float:center;">
        <div class="modal-dialog modal-lg" role="document" style="overflow:auto; max-height:90vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="titleBT">Supprimer Temp Intervalle</span></h5>
                    <button type="button" class="btn btn-outline-danger close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="blockedTimesEditForm">
                        <input type="hidden" class="form-control" id="IdBT" name="IdBT">

                          <strong>Veuillez confirmer la suppression</strong>
                        <div class="form-group" id="messageDeleteBT">

                        </div>
                        <!--<button  type="submit" class="btn btn-outline-success nav_name " style="margin-top= 10%">
                                                                                                                            <i class='bx bx-user nav_icon'></i> <span class="nav_name"> Submit</span>
                                                                                                                          </button>-->
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btnDelete">Supprimer</button>
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
            var table = $('#blockedTimesTables').DataTable({
                language: {
        url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
    },
                ajax: "{{ route('api.BT') }}",
                processing: true,
                columns: [{
                        className: 'dt-control',
                        data: null,
                        defaultContent: '',
                    },
                    {
                        data: 'IdBT'
                    },
                    {
                        data: 'DateDeb'
                    },
                    {
                        data: 'DateFin'
                    },
                    {
                        data: 'IdDEP'
                    },

                    {
                        defaultContent: '<button class="btn btn-outline-primary edit" data-toggle="modal" data-target="#BlockedTimeEdit"><i class="fa-solid fa-pen icon"></i></button>',

                    },
                    {

                        defaultContent: '<button class="btn btn-outline-danger delete" data-toggle="modal" data-target="#BlockedTimeDelete" ><i class="fa-solid fa-trash icon"></i></button>',

                    },

                ],
                order: [
                    [1, 'asc']
                ],
            });

            $("#blockedTimesTables").on("click", ".delete", function(e) {
                e.preventDefault();

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();


                console.log(data);
                $('#IdBT ').val(data[1]);
            });
                $(document).on("click", ".btnDelete", function(event) {
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                var IdBT = $("input[id=IdBT]").val();
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('delelteBT') }}/" + IdBT,
                     dataType: "JSON",
                    success: function(data, textStatus, xhr) {
                        $('#messageDeleteBT').html('');
                        if (xhr.status === 201) {
                            $('#messageDeleteBT').html(
                                '<div class="alert alert-success" id="messageDeleteBT" role="alert">' +
                                data
                                .success + '</div>');
                                location.reload();
                        } else {
                            $('#messageDeleteBT').html(
                                '<div class="alert alert-warning" id="messageDeleteBT" role="alert">' +
                                data
                                .error + '</div>');
                        }
                    },

                });
            });




            $("#blockedTimesTables").on("click", ".edit", function(e) {
                e.preventDefault();

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();


                console.log(data);
                $('#IdBT ').val(data[1]);
                $('#DateDeb ').val(data[2]);
                $('#DateFin ').val(data[3]);
                $('#IdDEP ').val(data[4]);






            });
            $(document).on("click", ".btnUpdate", function(event) {
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                var IdBT = $("input[id=IdBT]").val();
                $.ajax({
                    url: "{{ url('updateBT') }}" + '/' + IdBT,
                    type: "PUT",
                    data: $("#blockedTimesEditForm").serialize(),
                    success: function(data, textStatus, xhr) {
                        $('#messageEditBT').html('');
                        if (xhr.status === 201) {
                            $('#messageEditBT').html(
                                '<div class="alert alert-success" id="messageEditBT" role="alert">' +
                                data
                                .message + '</div>');

                            $("#blockedTimesEditForm")[0].reset();
                            table.ajax.reload();
                        } else {
                            $('#messageEditBT').html(
                                '<div class="alert alert-warning" id="messageEditBT" role="alert">' +
                                data
                                .error + '</div>');
                        }
                    },
                    error: function(response) {
                        var errors = Object.keys(response.responseJSON.errors);
                        $("#blockedTimesEditForm input, #blockedTimesEditForm select").each(function(index,
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
            $('#blockedTimesTables tbody').on('click', 'td.dt-control', function() {
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


            form_data = $("#blockedTimesForm").serialize()
            $("#blockedTimesForm input").each(function(index, item) {
                $(item).next("span").text('');
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/storeBT",
                type: "POST",
                data: form_data,
                success: function(data, textStatus, xhr) {
                    $('#messageBlockedTimes').html('');
                    if (xhr.status === 201) {
                        $('#messageBlockedTimes').html(
                            '<div class="alert alert-success" id="messageBlockedTimes" role="alert">' +
                            data
                            .message + '</div>');

                        $("#blockedTimesForm")[0].reset();
                       location.reload();
                    } else {
                        $('#messageBlockedTimes').html(
                            '<div class="alert alert-warning" id="messageBlockedTimes" role="alert">' +
                            data
                            .error + '</div>');
                    }
                },
                error: function(response) {
                    var errors = Object.keys(response.responseJSON.errors);
                    $("#blockedTimesForm input").each(function(index, item) {
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
