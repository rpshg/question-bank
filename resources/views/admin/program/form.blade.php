<!-- Name and slug -->
<div class="row mt-4 mb-4">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Program name</label>
            <input type="text" class="form-control form-control-user" id="name" name="name" value="{{ old('name', $program->name ?? '') }}" 
                placeholder="Name">
            @error('name')
                    <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control form-control-user" id="slug" name="slug" value="{{ old('slug', $program->slug ?? '') }}" 
                placeholder="Slug">
            @error('slug')
                    <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

<!-- status -->
<div class="form-group mt-4 mb-4">
    <label for="status">Status</label>
    <select class="form-select form-control" name="status" required>
        <option value="" selected disabled>Choose status...</option>
        <option value="APPROVED" {{ old('status', $program->status ?? '') == 'APPROVED' ? 'selected' : '' }}>APPROVED</option>
        <option value="PENDING" {{ old('status', $program->status ?? '') == 'PENDING' ? 'selected' : '' }}>PENDING</option>
        <option value="DISAPPROVED" {{ old('status', $program->status ?? '') == 'DISAPPROVED' ? 'selected' : '' }}>DISAPPROVED</option>
    </select>

    @error('status')
            <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<!-- avatar -->
<div class="form-group mt-4 mb-4">
    <label for="avatar">Avatar</label>
    @if(!empty($program->avatar))
        <img src="{{ asset('storage/' . $program->avatar) }}" alt="Program Avatar" id="avatar-preview" class="form-avatar">
    @else
        <img src="{{ asset('storage/programs/default-program.jpg') }}" alt="Program Avatar" id="avatar-preview" class="form-avatar">
    @endif

    <input type="file" class="form-control-user" id="avatar" name="avatar" accept="image/*">
    @error('avatar')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="row mt-4 mb-4">
    <div class="col-md-6">
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="ckeditor form-control form-control-user" name="description" id="description">
                {{ old('description', $program->description ?? '') }}
            </textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="meta_title">Meta Title</label>
            <textarea class="ckeditor form-control form-control-user" name="meta_title">
                {{ old('meta_title', $program->meta_title ?? '') }}
            </textarea>
        </div>
    </div>
</div>


<div class="row mt-4 mb-4">
    <div class="col-md-6">
        <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <textarea class="ckeditor form-control form-control-user" name="meta_description">
                {{ old('meta_description', $program->meta_description ?? '') }}
            </textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="description">Meta Keyword</label>
            <textarea class="ckeditor form-control form-control-user" name="meta_keyword">
                {{ old('meta_title', $program->meta_title ?? '') }}
            </textarea>
        </div>
    </div>
</div>