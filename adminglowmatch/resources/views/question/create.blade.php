@extends('layouts.master')

@section('title')
    Create Question
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{{ route('questions.index') }}">Questions</a></li>
    <li class="active">Create</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Question</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('questions.store') }}" method="POST" data-toggle="validator">
                        @csrf

                        <div class="form-group row">
                            <label for="QuestionText" class="col-lg-2 col-lg-offset-1 control-label">Question Text</label>
                            <div class="col-lg-6">
                                <textarea name="QuestionText" id="QuestionText" class="form-control" required autofocus></textarea>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Category" class="col-lg-2 col-lg-offset-1 control-label">Category</label>
                            <div class="col-lg-6">
                                <input type="text" name="Category" id="Category" class="form-control">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>

                        <div id="options-container">
                            <h4>Options</h4>
                            <div class="option-row">
                                <div class="form-group row">
                                    <label for="options[0][OptionText]" class="col-lg-2 col-lg-offset-1 control-label">Option Text</label>
                                    <div class="col-lg-3">
                                        <textarea name="options[0][OptionText]" class="form-control" required></textarea>
                                        <span class="help-block with-errors"></span>
                                    </div>

                                    <label for="options[0][SkinTypeEffect]" class="col-lg-2 control-label">Skin Type Effect</label>
                                    <div class="col-lg-3">
                                        <input type="text" name="options[0][SkinTypeEffect]" class="form-control">
                                        <span class="help-block with-errors"></span>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="options[0][SeverityEffect]" class="col-lg-2 col-lg-offset-1 control-label">Severity Effect</label>
                                    <div class="col-lg-3">
                                        <input type="text" name="options[0][SeverityEffect]" class="form-control">
                                        <span class="help-block with-errors"></span>
                                    </div>

                                    <label for="options[0][Score]" class="col-lg-2 control-label">Score</label>
                                    <div class="col-lg-3">
                                        <input type="number" name="options[0][Score]" class="form-control">
                                        <span class="help-block with-errors"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                             <div class="col-lg-2 col-lg-offset-1">
                                    <button class="btn btn-success" id="add-option">Add Option</button>
                                </div>
                            <div class="col-lg-12 col-lg-offset-1">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let optionCount = 1;

            $('#add-option').click(function(e) {
                e.preventDefault();

                let newOptionRow = `
                    <div class="option-row">
                        <div class="form-group row">
                            <label for="options[${optionCount}][OptionText]" class="col-lg-2 col-lg-offset-1 control-label">Option Text</label>
                            <div class="col-lg-3">
                                <textarea name="options[${optionCount}][OptionText]" class="form-control" required></textarea>
                                <span class="help-block with-errors"></span>
                            </div>

                            <label for="options[${optionCount}][SkinTypeEffect]" class="col-lg-2 control-label">Skin Type Effect</label>
                            <div class="col-lg-3">
                                <input type="text" name="options[${optionCount}][SkinTypeEffect]" class="form-control">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="options[${optionCount}][SeverityEffect]" class="col-lg-2 col-lg-offset-1 control-label">Severity Effect</label>
                            <div class="col-lg-3">
                                <input type="text" name="options[${optionCount}][SeverityEffect]" class="form-control">
                                <span class="help-block with-errors"></span>
                            </div>

                            <label for="options[${optionCount}][Score]" class="col-lg-2 control-label">Score</label>
                            <div class="col-lg-3">
                                <input type="number" name="options[${optionCount}][Score]" class="form-control">
                                <span class="help-block with-errors"></span>
                            </div>

                            <div class="col-lg-2">
                                <button class="btn btn-danger remove-option">Remove</button>
                            </div>
                        </div>
                    </div>
                `;

                $('#options-container').append(newOptionRow);
                optionCount++;
            });

            $(document).on('click', '.remove-option', function() {
                $(this).closest('.option-row').remove();
            });
        });
    </script>
@endpush