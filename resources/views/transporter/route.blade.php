@extends('layouts.app_farmer')
@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Transporter Routes</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Transporter</a></li>
                                <li><a href="#">Route Management</a></li>
                                <li class="active">Routes</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Add Trip Button -->
                            <button class="btn btn-success float-right" data-toggle="modal" data-target="#addTripModal">
                                <i class="fa fa-plus"></i> Add Trip
                            </button>

                            <!-- Routes Table -->
                            <table class="table table-striped table-bordered">
                                <thead style="background: #00c292;color: white;">
                                <tr>
                                    <th>Date Depart</th>
                                    <th>Date Arrive</th>
                                    <th>Point Depart</th>
                                    <th>Point Arrive</th>
                                    <th>Path</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trajets as $trajet)
                                    <tr>
                                        <td>{{ $trajet->date_depart }}</td>
                                        <td>{{ $trajet->date_arrive }}</td>
                                        <td>{{ $trajet->point_depart }}</td>
                                        <td>{{ $trajet->point_arrive }}</td>
                                        <td>
                                            <!-- Path Button to Open Leaflet Map Modal -->
                                            <!-- Assuming you have a button for viewing the map -->
                                            <a href="{{ route('showMap', $trajet->id) }}" target="_blank" class="btn btn-primary">View on Map</a>

                                        </td>
                                        <td>
                                            <!-- Action Buttons (Edit/Delete) -->
                                            <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editRoute{{ $trajet->id }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </button>

                                            <form action="{{ route('destroyRoute', $trajet->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this route?');">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>

                                        </td>
                                    </tr>


                                    <div class="modal fade" id="editRoute{{ $trajet->id }}" tabindex="-1" role="dialog" aria-labelledby="editRouteLabel{{ $trajet->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editRouteLabel{{ $trajet->id }}">Edit Trip</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('handleUpdateRoute', $trajet->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT') <!-- This ensures the form uses the PUT HTTP method -->
                                                    <div class="modal-body">
                                                        <div class="card-body card-block">
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label for="date_depart">Departure Date</label>
                                                                    <input type="date" id="date_depart" name="date_depart" class="form-control" value="{{ $trajet->date_depart }}" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="date_arrive">Arrival Date</label>
                                                                    <input type="date" id="date_arrive" name="date_arrive" class="form-control" value="{{ $trajet->date_arrive }}" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group position-relative">
                                                                <label for="point_depart_edit">Point of Departure</label>
                                                                <input type="text" id="point_depart_edit" name="point_depart" placeholder="City or Location" class="form-control" autocomplete="off" value="{{ $trajet->point_depart }}" required>
                                                                <ul id="depart_suggestions_edit" class="list-group position-absolute w-100" style="z-index: 1000;"></ul>
                                                            </div>

                                                            <div class="form-group position-relative">
                                                                <label for="point_arrive_edit">Point of Arrival</label>
                                                                <input type="text" id="point_arrive_edit" name="point_arrive" placeholder="City or Location" class="form-control" autocomplete="off" value="{{ $trajet->point_arrive }}" required>
                                                                <ul id="arrive_suggestions_edit" class="list-group position-absolute w-100" style="z-index: 1000;"></ul>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="path">Path</label>
                                                                <input type="text" id="path" name="path" placeholder="Path description" class="form-control" value="{{ $trajet->path }}" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal to Add New Trip -->
    <div class="modal fade" id="addTripModal" tabindex="-1" role="dialog" aria-labelledby="addTripLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTripLabel">Add New Trip</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('handleAddTrip') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body card-block">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="date_depart">Departure Date</label>
                                    <input type="date" id="date_depart" name="date_depart" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="date_arrive">Arrival Date</label>
                                    <input type="date" id="date_arrive" name="date_arrive" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group position-relative">
                                <label for="point_depart">Point of Departure</label>
                                <input type="text" id="point_depart" name="point_depart" placeholder="City or Location" class="form-control" autocomplete="off" required>
                                <ul id="depart_suggestions" class="list-group position-absolute w-100" style="z-index: 1000;"></ul>
                            </div>

                            <div class="form-group position-relative">
                                <label for="point_arrive">Point of Arrival</label>
                                <input type="text" id="point_arrive" name="point_arrive" placeholder="City or Location" class="form-control" autocomplete="off" required>
                                <ul id="arrive_suggestions" class="list-group position-absolute w-100" style="z-index: 1000;"></ul>
                            </div>

                            <div class="form-group">
                                <label for="path">Path</label>
                                <input type="text" id="path" name="path" placeholder="Path description" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Add Trip</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    function setupAutocomplete(inputId, suggestionsId) {
        const input = document.getElementById(inputId);
        const suggestionsBox = document.getElementById(suggestionsId);

        input.addEventListener('input', function () {
            const query = input.value.trim();
            if (query.length < 2) {
                suggestionsBox.innerHTML = '';
                return;
            }

            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&addressdetails=1&limit=5`)
                .then(res => res.json())
                .then(data => {
                    suggestionsBox.innerHTML = '';
                    data.forEach(location => {
                        const li = document.createElement('li');
                        li.classList.add('list-group-item');
                        li.style.cursor = 'pointer';
                        li.textContent = location.display_name;

                        li.addEventListener('click', () => {
                            input.value = location.display_name;
                            suggestionsBox.innerHTML = '';
                        });

                        suggestionsBox.appendChild(li);
                    });
                });
        });

        document.addEventListener('click', e => {
            if (!suggestionsBox.contains(e.target) && e.target !== input) {
                suggestionsBox.innerHTML = '';
            }
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        setupAutocomplete('point_depart_edit', 'depart_suggestions_edit');
        setupAutocomplete('point_arrive_edit', 'arrive_suggestions_edit');
    });
    document.addEventListener("DOMContentLoaded", () => {
        setupAutocomplete('point_depart', 'depart_suggestions');
        setupAutocomplete('point_arrive', 'arrive_suggestions');
    });
</script>
