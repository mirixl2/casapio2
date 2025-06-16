<x-admin.index :user="$user" :isAdmin="$isAdmin">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Site Name</h4>
                        <p class="card-description">Update the website name</p>
                        <form action="{{ route('settings.update') }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="sitename">Name</label>
                                <input type="text" class="form-control" id="sitename" name="sitename" value="{{ $siteName }}" required />
                            </div>
                            <div class="form-group">
                                <label for="sitelogo">Logo</label>
                                <input type="file" class="form-control" id="sitelogo" name="sitelogo" accept="image/*" />
                                @if($siteLogo)
                                    <img src="/{{ $siteLogo }}" alt="current logo" class="mt-2 w-24" />
                                @endif
                            </div>
                            @if ($isAdmin === true)
                            <button type="submit" class="btn btn-primary mr-2">Save</button>
                            @else
                            <button onclick="alert('Only admin can edit site name')" type="button" class="btn btn-primary mr-2">Save</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.index>
