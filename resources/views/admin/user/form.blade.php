

<div class="form-group">
    <input type="text" class="form-control form-control-user" id="name" name="name" value="{{ old('name', $admin->name ?? '') }}" 
        placeholder="Name">
    @error('name')
            <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" value="{{ old('email', $admin->email ?? '') }}" 
        placeholder="Email Address">
    @error('email')
            <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


@if(request()->route()->named('admin-user.edit'))
<div class="form-group">
    <div class="custom-control custom-checkbox small">
        <input type="checkbox" class="custom-control-input" id="password_change" name="password_change">
        <label class="custom-control-label" for="password_change">Change Password?</label>
    </div>
</div>

<div class="form-group row" id="password_row">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="password" class="form-control form-control-user"
            id="password" placeholder="Password" name="password">
    </div>
    <div class="col-sm-6">
        <input type="password" class="form-control form-control-user"
            id="repeatPassword" placeholder="Repeat Password" name="password_confirmation">
            
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <!-- show password don't match without submitting form -->
            <!-- <small id="password-match-message" class="text-danger" style="display: none;">Passwords do not match.</small> -->
    </div>
</div>

@else
<div class="form-group row">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="password" class="form-control form-control-user"
            id="password" placeholder="Password" name="password">
    </div>
    <div class="col-sm-6">
        <input type="password" class="form-control form-control-user"
            id="repeatPassword" placeholder="Repeat Password" name="password_confirmation">
            
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror

    </div>
</div>

@endif

