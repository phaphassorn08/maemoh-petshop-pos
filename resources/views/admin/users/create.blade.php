@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<!-- Content Row -->
        <div class="card shadow">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('เพิ่มผู้ใช้') }}</h1>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('ย้อนกลับ') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('ชื่อ') }}</label>
                        <input type="text" class="form-control" id="name" placeholder="{{ __('ชื่อ') }}" name="name" value="{{ old('name') }}" />
                    </div>
                    <div class="form-group">
                        <label for="email">{{ __('อีเมล') }}</label>
                        <input type="email" class="form-control" id="email" placeholder="{{ __('อีเมล') }}" name="email" value="{{ old('email') }}" />
                    </div>
                    <div class="form-group">
                        <label for="password">{{ __('รหัสผ่าน') }}</label>
                        <input type="text" class="form-control" id="password" placeholder="{{ __('รหัสผ่าน') }}" name="password" value="{{ old('password') }}" required />
                    </div>
                    <div class="form-group">
                        <label for="roles">{{ __('สถานะ') }}</label>
                        <select name="roles[]" id="roles" class="form-control select2" multiple="multiple" required>
                            @foreach($roles as $id => $roles)
                                <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($role) && $role->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('บันทึก') }}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection