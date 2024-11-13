
<!-- Program select -->
<div class="form-group my-4">
    <label for="program_id">Program</label>
    <select class="form-control form-select" name="program_id">
      <option selected disabled value="">Select Program</option>
      @foreach($programs as $key=>$program)
          <option value="{{ $key }}" @if(old('program_id',$level->program_id)==$key) selected @endif>
              {{ $program }}
          </option>
      @endforeach
    </select>
</div>


<!-- Job name and slug -->
<div class="row my-4">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Job Level Name</label>
            <input type="text" class="form-control form-control-user" id="name" name="name" value="{{ old('name', $level->name ?? '') }}" 
                placeholder="Job Name">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control form-control-user" id="slug" name="slug" value="{{ old('slug', $level->slug ?? '') }}" 
                placeholder="Slug">
            @error('slug')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>


<!-- Job status -->
<div class="form-group my-4">
    <label for="status">Status</label>
    <select class="form-select form-control" name="status" required>
        <option value="" selected disabled>Choose status...</option>
        <option value="APPROVED" {{ old('status', $level->status ?? '') == 'APPROVED' ? 'selected' : '' }}>APPROVED</option>
        <option value="PENDING" {{ old('status', $level->status ?? '') == 'PENDING' ? 'selected' : '' }}>PENDING</option>
        <option value="DISAPPROVED" {{ old('status', $level->status ?? '') == 'DISAPPROVED' ? 'selected' : '' }}>DISAPPROVED</option>
    </select>

    @error('status')
            <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- avatar -->
<div class="form-group my-4">
    <label for="avatar">Avatar</label>
    @if(!empty($level->avatar))
        <img src="{{ asset('storage/' . $level->avatar) }}" alt="Level Avatar" id="avatar-preview" class="form-avatar">
    @else
        <img src="{{ asset('storage/levels/default-level.jpg') }}" alt="Level Avatar" id="avatar-preview" class="form-avatar">
    @endif

    <input type="file" class="form-control-user" id="avatar" name="avatar" accept="image/*">
    @error('avatar')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>



<div class="row my-4">
    <div class="col-md-6">
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="ckeditor form-control form-control-user" name="description" id="description">
                {{ old('description', $level->description ?? '') }}
            </textarea>
        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group">
            <label for="meta_title">Meta Title</label>
            <textarea class="ckeditor form-control form-control-user" name="meta_title">
                {{ old('meta_title', $level->meta_title ?? '') }}
            </textarea>
        </div>
    </div>
</div>

<div class="row my-4">
    <div class="col-md-6">
        <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <textarea class="ckeditor form-control form-control-user" name="meta_description">
                {{ old('meta_description', $level->meta_description ?? '') }}
            </textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="description">Meta Keyword</label>
            <textarea class="ckeditor form-control form-control-user" name="meta_keyword">
                {{ old('meta_title', $level->meta_title ?? '') }}
            </textarea>
        </div>
    </div>
</div>