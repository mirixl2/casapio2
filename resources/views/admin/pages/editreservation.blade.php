<x-admin.index :user="$user" :isAdmin="$isAdmin">
        <div class="content-wrapper">
                <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                        <div class="card-body">
                                                <h4 class="card-title">Reservation Form</h4>
                                                <p class="card-description">Edit reservation info</p>
                                                <form action="{{ route('reservation.update', $data->id ) }}" method="post" enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="form-group">
                                                                <label for="name">Name</label>
                                                                <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}" placeholder="Input name" />
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="phone">Phone number</label>
                                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $data->phone_number }}" placeholder="Input phone number" required />
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="date">Date</label>
                                                                <input type="text" class="form-control" id="date" name="date" value="{{ $data->date }}" placeholder="Input date" required />
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="time">Time</label>
                                                                <input type="text" class="form-control" id="time" name="time" value="{{ $data->time }}" placeholder="Input time" />
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="person">Person</label>
                                                                <select id="person" name="person" class="form-control" required>
                                                                        <option value="1" {{ $data->person == '1' ? 'selected' : '' }}>1 Persona</option>
                                                                        <option value="2" {{ $data->person == '2' ? 'selected' : '' }}>2 Personas</option>
                                                                        <option value="3" {{ $data->person == '3' ? 'selected' : '' }}>3 Personas</option>
                                                                        <option value="4" {{ $data->person == '4' ? 'selected' : '' }}>4 Personas</option>
                                                                        <option value="5" {{ $data->person == '5' ? 'selected' : '' }}>5 Personas</option>
                                                                        <option value="6" {{ $data->person == '6' ? 'selected' : '' }}>6 Personas</option>
                                                                </select>
                                                        </div>

                                                        @if ($isAdmin === true)
                                                        <button type="submit" class="btn btn-primary mr-2">Edit</button>
                                                        @else
                                                        <button onclick="alert('Only admin can edit reservation')" type="button" class="btn btn-primary mr-2">Edit</button>
                                                        @endif
                                                        <a href="{{ route('reservation.index') }}" class="btn btn-light">Cancel</a>
                                                </form>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</x-admin.index>
