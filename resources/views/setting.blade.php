@extends('adminwebpage')

@section('prodect')
<div class="container mt-4">
    <h2 class="mb-4">Admin Settings</h2>
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="siteName" class="form-label">Site Name</label>
            <input type="text" class="form-control" id="siteName" name="site_name" value="" required>
        </div>
        <div class="mb-3">
            <label for="adminEmail" class="form-label">Admin Email</label>
            <input type="email" class="form-control" id="adminEmail" name="admin_email" value="" required>
        </div>
        <div class="mb-3">
            <label for="maintenanceMode" class="form-label">Maintenance Mode</label>
            <select class="form-select" id="maintenanceMode" name="maintenance_mode">
                <option value="0" >Disabled</option>
                <option value="1" >Enabled</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="siteDescription" class="form-label">Site Description</label>
            <textarea class="form-control" id="siteDescription" name="site_description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
