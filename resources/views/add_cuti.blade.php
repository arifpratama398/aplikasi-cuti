@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Formulir</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="/pengajuan" method="post">
                      {{csrf_field()}}
                      <div class="form-group">
                          <label for="start">Start</label>
                          <input class="form-control @error('start') is-invalid @enderror" type="date" name="start" id="start" value="{{ old('start') }}" placeholder="mulai"> @error('start')
                          <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label for="finish">Finish</label>
                          <input class="form-control @error('finish') is-invalid @enderror" type="date" name="finish" id="finish" value="{{ old('finish') }}" placeholder="selesai"> @error('finish')
                          <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label for="needs">Needs</label>
                          <input class="form-control @error('needs') is-invalid @enderror" type="text" name="needs" id="needs" value="{{ old('needs') }}" placeholder="Keperluan"> @error('needs')
                          <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      <input type="hidden" name="id" value="{{ $id }}">
                      <div class="form-group float-right">
                          <button class="btn btn-lg btn-danger" type="reset">Reset</button>
                          <button class="btn btn-lg btn-primary" type="submit">Submit</button>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection