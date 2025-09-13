@props(['status', 'message'])
@if(session()->has('status'))
    @if($status)
        <div class="alert alert-ok alert-dismissible fade show d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="32" height="32" viewBox="0 0 512 512">
                <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none"
                      stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/>
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"
                      d="M352 176L217.6 336 160 272"/>
            </svg>
            <div>
                <strong>{{__('Successful!')}}</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @else
        <div class="alert alert-error alert-dismissible fade show" role="alert">
            <strong>{{__('Failed!')}}</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@elseif(session()->has('statuses'))
	@foreach(session('statuses') as $status)
 		 @if($status['isSuccess'])
        <div class="alert alert-ok alert-dismissible fade show d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="32" height="32" viewBox="0 0 512 512">
                <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none"
                      stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/>
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"
                      d="M352 176L217.6 336 160 272"/>
            </svg>
            <div>
                <strong>{{__('Successful!')}}</strong> {{ $status['message'] }}
				@isset($status['data'])
					@foreach($status['data'] as $key => $values) 
				@empty($values)
				@continue
				@endempty
				<h4 class="text-danger">{{ __("$key") }}</h4>
				<ul> 
					@foreach($values as $value)
					<li>{{ is_array($value) ? json_encode($value) : $value }}</li>
					@endforeach
				</ul>
					@endforeach
				@endisset
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
   	 @else
        <div class="alert alert-error alert-dismissible fade show" role="alert">
            <strong>{{__('Failed!')}}</strong> {{ $status['message'] }}
			@isset($status['data'])
					@foreach($status['data'] as $key => $values) 
				@empty($values)
				@continue
				@endempty
				<h4 class="text-danger">{{ __("$key") }}</h4>
				<ul> 
					@foreach($values as $value)
					<li>{{ is_array($value) ? json_encode($value) : $value }}</li>
					@endforeach
				</ul>
					@endforeach
				@endisset
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
   	 @endif
	@endforeach
@endif
