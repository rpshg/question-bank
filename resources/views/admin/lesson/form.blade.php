
<!-- Program and level select -->
<div class="row my-4">
    <div class="col-md-6">
        <div class="form-group my-4">
            <label for="program_id">Program</label>
            <select class="form-control form-select" name="program_id">
              <option selected disabled value="">Select Program</option>
              @foreach($programs as $key=>$program)
                  <option value="{{ $key }}" @if(old('program_id',$lesson->program_id)==$key) selected @endif>
                      {{ $program }}
                  </option>
              @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group my-4">
            <label for="level_id">Job level</label>
            <select class="form-control form-select" name="level_id">
              <option selected disabled value="">Select job level</option>
              @foreach($levels as $key=>$level)
                  <option value="{{ $key }}" @if(old('level_id',$lesson->level_id)==$key) selected @endif>
                      {{ $level }}
                  </option>
              @endforeach
            </select>
        </div>
    </div>
</div>


<!-- Lesson name and slug -->
<div class="row my-4">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control form-control-user" id="name" name="name" value="{{ old('name', $lesson->name ?? '') }}" 
                placeholder="Lesson name">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control form-control-user" id="slug" name="slug" value="{{ old('slug', $lesson->slug ?? '') }}" 
                placeholder="Slug">
            @error('slug')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>


<!-- status -->
<div class="row my-4">
    <div class="col-md-6">
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-select form-control" name="status" required>
                <option value="" selected disabled>Choose status...</option>
                <option value="APPROVED" {{ old('status', $lesson->status ?? '') == 'APPROVED' ? 'selected' : '' }}>APPROVED</option>
                <option value="PENDING" {{ old('status', $lesson->status ?? '') == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                <option value="DISAPPROVED" {{ old('status', $lesson->status ?? '') == 'DISAPPROVED' ? 'selected' : '' }}>DISAPPROVED</option>
            </select>

            @error('status')
                    <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <label for="status">No of mcqs</label>
        <input type="number" min="1" step="1" class="form-control form-control-user" id="no_of_mcqs" name="no_of_mcqs" value="{{ old('no_of_mcqs', $lesson->no_of_mcqs ?? '') }}" 
            placeholder="Number of mcqs from this lesson">
        @error('no_of_mcqs')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>



<div class="row my-4">
    <div class="col-md-6">
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="ckeditor form-control form-control-user" name="description" id="description">
                {{ old('description', $lesson->description ?? '') }}
            </textarea>
        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group">
            <label for="meta_title">Meta Title</label>
            <textarea class="ckeditor form-control form-control-user" name="meta_title">
                {{ old('meta_title', $lesson->meta_title ?? '') }}
            </textarea>
        </div>
    </div>
</div>

<div class="row my-4">
    <div class="col-md-6">
        <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <textarea class="ckeditor form-control form-control-user" name="meta_description">
                {{ old('meta_description', $lesson->meta_description ?? '') }}
            </textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="description">Meta Keyword</label>
            <textarea class="ckeditor form-control form-control-user" name="meta_keyword">
                {{ old('meta_title', $lesson->meta_title ?? '') }}
            </textarea>
        </div>
    </div>
</div>