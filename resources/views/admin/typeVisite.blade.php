@extends('layouts.app')




@section('content')
    <button class="btn btn-outline-success float-end addBtn" style="margin-top= 10%" data-toggle="modal"
        data-target="#TypesInfoModal">
        <i class="fa-solid fa-plus"></i> Créer Type Visite
    </button>
<br> <br>
    <div class="card"  >
        <div class="card-header">
            <i class="fa-solid fa-table-list"></i>   Types Visite Liste
        </div>
        <div class="card-body">
    <table class="table table-hover" id="TypeVisiteTable" style="width:100%">
        <thead class="bg-light">
            <tr>
                <th scope="col"></th>
                <th scope="col">ID TP</th>
                <th scope="col">Type Visite</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>



        </tbody>
    </table>
        </div>
    </div>
    <div class="modal fade" id="TypesInfoModal" tabindex="-1" role="dialog" style="width:100%;">
        <div class="modal-dialog modal-lg" role="document" style="overflow:auto; max-height:90vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="user_modal_title">Nouveau Type</span></h5>
                    <button type="button" class="btn btn-outline-danger close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">✗</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="typesForm">
                        <div class="form-group mb-2">
                            <label for="NomTP">NomTP</label>
                            <input type="text" class="form-control" id="NomTP" name="NomTP">
                            <span class="text-danger" id="error_NomTP"></span>
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
    <div class="modal fade" id="TypesEditModal" tabindex="-1" role="dialog" style="width:100%;">
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
                    <form id="TypeFormEdit">
                        <input type="hidden" class="form-control" id="IdTP" name="IdTP">
                        <div class="form-group mb-2">
                            <label for="NomTP">NomTP</label>
                            <input type="text" class="form-control" id="NomTP" name="NomTP">
                            <span class="text-danger" id="error_NomTP"></span>
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
            '<td>'+ d.UserUp +'</td>' +
            '</tr>' +
            '<tr>'+
            '<td>Modifié le:</td>' +
            '<td>'+ d.DateUp +'</td>' +
            '</tr>' +
            '</table>'
        );
    }

    $(document).ready(function() {
        var table = $('#TypeVisiteTable').DataTable({
            language: {
        url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
    },
            ajax: "{{ route('api.types') }}",
            processing: true,
            columns: [{
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: '',
                },
                {data: 'IdTP'},
                {data: 'NomTP'},
                {
                 defaultContent: '<button class="btn btn-outline-primary edit" data-toggle="modal" data-target="#TypesEditModal"><i class="fa-solid fa-pen icon"></i></button>',
                },
            ],
            order: [
                [1, 'asc']
            ],
        });
        $('#TypeVisiteTable').on("click", ".edit", function(e) {
            e.preventDefault();

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();


            console.log(data);
            $('#IdTP ').val(data[1]);
            $('#NomTP ').val(data[2]);


        });
        $(document).on("click", ".btnUpdate", function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var IdTP = $("input[id=IdTP]").val();
            $.ajax({
                url: "{{ url('updateTypes') }}" + '/' + IdTP,
                type: "PUT",
                data: $("#TypeFormEdit").serialize(),
                success: function(data, textStatus, xhr) {
                    $('#messageEdit').html('');
                    if (xhr.status === 201) {
                        $('#messageEdit').html(
                            '<div class="alert alert-success" id="messageEdit" role="alert">' +
                            data
                            .success + '</div>');

                        $("#TypeFormEdit")[0].reset();
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
                    $("#TypeFormEdit input").each(function(index, item) {
                        var id = $(item).attr('id');
                        if (errors.includes(id)) {
                            $('#' + id).next("span").text("field is required or invalid.");
                        }
                    });

                },
            });
        });


        // Add event listener for opening and closing details
        $('#TypeVisiteTable tbody').on('click', 'td.dt-control', function() {
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
            form_data = $("#typesForm").serialize()
            $("#typesForm input").each(function(index, item) {
                $(item).next("span").text('');
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/storeTypes",
                type: "POST",
                data: form_data,
                success: function(data, textStatus, xhr) {
                    $('#message').html('');
                    if (xhr.status === 201) {
                        $('#message').html(
                            '<div class="alert alert-success" id="message" role="alert">' + data
                            .success + '</div>');

                        $("#typesForm")[0].reset();
                        location.reload();
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


@endpush
