<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 29/06/2018
	 * Time: 12:57
	 */
	?>

@if(isset($message))
    <h2 class="bg-info">
        {{$message}}
    </h2>
@endif
@if(\Classes\Core\Session::has('MESSAGE'))
    <h2 class="bg-info">
        @if(is_array(\Classes\Core\Session::get('MESSAGE')))
            @foreach(\Classes\Core\Session::get('MESSAGE') as $message)
                {{$message}}
            @endforeach
        @else
            {{\Classes\Core\Session::get('MESSAGE')}}
        @endif
    </h2>
    @php \Classes\Core\Session::clear('MESSAGE') @endphp
@endif
@if(isset($error))
    <h2 class="bg-warning">
    @foreach ( $error as $err)
        {{$err}}<br>;
    @endforeach
    </h2>
@endif
