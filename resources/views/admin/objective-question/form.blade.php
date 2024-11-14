
<!-- Program, level, and lesson select -->
<div class="row my-4">
    <div class="col-md-4">
        <div class="form-group my-4">
            <label for="program_id">Program</label>
            <select class="form-control form-select" name="program_id">
              <option selected disabled value="">Select Program</option>
              @foreach($programs as $key=>$program)
                  <option value="{{ $key }}" @if(old('program_id',$question->program_id)==$key) selected @endif>
                      {{ $program }}
                  </option>
              @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group my-4">
            <label for="level_id">Job level</label>
            <select class="form-control form-select" name="level_id">
              <option selected disabled value="">Select job level</option>
              @foreach($levels as $key=>$level)
                  <option value="{{ $key }}" @if(old('level_id',$question->level_id)==$key) selected @endif>
                      {{ $level }}
                  </option>
              @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group my-4">
            <label for="lesson_id">Lesson</label>
            <select class="form-control form-select" name="lesson_id">
              <option selected disabled value="">Select lesson</option>
              @foreach($lessons as $key=>$lesson)
                  <option value="{{ $key }}" @if(old('lesson_id',$question->lesson_id)==$key) selected @endif>
                      {{ $lesson }}
                  </option>
              @endforeach
            </select>
        </div>
    </div>
</div>



<!-- status -->
<div class="row my-4">
    <div class="col-md-12">
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-select form-control" name="status" required>
                <option value="" selected disabled>Choose status...</option>
                <option value="APPROVED" {{ old('status', $question->status ?? '') == 'APPROVED' ? 'selected' : '' }}>APPROVED</option>
                <option value="PENDING" {{ old('status', $question->status ?? '') == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                <option value="DISAPPROVED" {{ old('status', $question->status ?? '') == 'DISAPPROVED' ? 'selected' : '' }}>DISAPPROVED</option>
            </select>

            @error('status')
                    <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>


<!-- question and correct answer -->
<div class="row my-4">
    <div class="col-md-6">
        <div class="form-group">
            <label for="question">Question</label>
            <textarea class="ckeditor form-control form-control-user" name="question" id="question">
                {{ old('question', $question->question ?? '') }}
            </textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="correct_answer">Correct answer</label>
            <textarea class="ckeditor form-control form-control-user" name="correct_answer" id="correct_answer">
                {{ old('correct_answer', $question->correct_answer ?? '') }}
            </textarea>
        </div>
    </div>
</div>


<!-- option1 & option2 -->
<div class="row my-4">
    <div class="col-md-6">
        <div class="form-group">
            <label for="option_1">Option1</label>
            <textarea class="ckeditor form-control form-control-user" name="option_1" id="option_1">
                {{ old('option_1', $question->option_1 ?? '') }}
            </textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="option_2">Option2</label>
            <textarea class="ckeditor form-control form-control-user" name="option_2" id="option_2">
                {{ old('option_2', $question->option_2 ?? '') }}
            </textarea>
        </div>
    </div>
</div>


<!-- option3 & option4 -->
<div class="row my-4">
    <div class="col-md-6">
        <div class="form-group">
            <label for="option_3">Option3</label>
            <textarea class="ckeditor form-control form-control-user" name="option_3" id="option_3">
                {{ old('option_3', $question->option_3 ?? '') }}
            </textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="option_4">Option4</label>
            <textarea class="ckeditor form-control form-control-user" name="option_4" id="option_4">
                {{ old('option_4', $question->option_4 ?? '') }}
            </textarea>
        </div>
    </div>
</div>


<!-- option5 & option6 -->
<div class="row my-4">
    <div class="col-md-6">
        <div class="form-group">
            <label for="option_5">Option5</label>
            <textarea class="ckeditor form-control form-control-user" name="option_5" id="option_5">
                {{ old('option_5', $question->option_5 ?? '') }}
            </textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="option_6">Option6</label>
            <textarea class="ckeditor form-control form-control-user" name="option_6" id="option_6">
                {{ old('option_6', $question->option_6 ?? '') }}
            </textarea>
        </div>
    </div>
</div>


<!-- explanation -->
<div class="row my-4">
    <div class="col-md-12">
        <div class="form-group">
            <label for="option_5">Explanation</label>
            <textarea class="ckeditor form-control form-control-user" name="explanation" id="explanation">
                {{ old('explanation', $question->explanation ?? '') }}
            </textarea>
        </div>
    </div>
</div>
