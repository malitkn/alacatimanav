@props(['status', 'message'])
@if(session()->has('status'))
    @if($status)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{__('Successful!')}}</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @else
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{__('Failed!')}}</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endif
