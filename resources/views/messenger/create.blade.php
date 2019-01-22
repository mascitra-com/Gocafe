@extends('_layout/dashboard/index')
@section('page_title', 'Percakapan')

@section('content')
    <div class="col-xs-12 col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="{{ route('messages.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <!-- Subject Form Input -->
                        <div class="form-group">
                            <label class="control-label">Subject</label>
                            <input type="text" class="form-control" name="subject" placeholder="Subject"
                                   value="{{ old('subject') }}">
                        </div>

                        <!-- Message Form Input -->
                        <div class="form-group">
                            <label class="control-label">Message</label>
                            <textarea name="message" class="form-control">{{ old('message') }}</textarea>
                        </div>

                        <!-- Submit Form Input -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control">Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
