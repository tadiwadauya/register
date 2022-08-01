@if (session('message'))
  <div class="alert alert-{{ Session::get('status') }} border-{{ Session::get('status') }}" >
      <i class="feather icon-x-circle"></i>
    {{ session('message') }}
  </div>
@endif

@if (session('success'))
  <div class="alert alert-success border-success">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="feather icon-x-circle"></i>
      </button>
    <h4><i class="feather icon-check" aria-hidden="true"></i> Success</h4>
    {{ session('success') }}
  </div>
@endif

@if(session()->has('status'))
    @if(session()->get('status') == 'wrong')
        <div class="alert alert-danger border-danger">
            <i class="feather icon-x-circle"></i>
            {{ session('message') }}
        </div>
    @endif
@endif

@if (session('error'))
  <div class="alert alert-danger border-danger">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="feather icon-x-circle"></i>
      </button>
    {{ session('error') }}
  </div>
@endif

@if (session('errors') && count($errors) > 0)
  <div class="alert alert-danger border-danger">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="feather icon-x-circle"></i>
      </button>
    <h4>
      <i class="feather icon-alert-triangle" aria-hidden="true"></i>
      <strong>{{ Lang::get('auth.whoops') }}</strong> {{ Lang::get('auth.someProblems') }}
    </h4>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
