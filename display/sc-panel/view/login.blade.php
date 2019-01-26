<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 27/05/2018
	 * Time: 13:11
	 */



	?>

@extends('extends.admin-min-base')

@section('title', 'Login')

@section('page-id', 'login')

@section('content')
    <div id="login">
        <div class="grid-container">
            <div class="grid-padding-x grid-x">
                <div class="medium-6 medium-offset-3 large-6 large-offset-3 cell">
                    <div class="callout loginpanel secondary clearfix">
                        <div class="text-right">
                            <a href="/sc-panel/adduser"><h3>Register Here</h3></a>
                        </div>
                        <div class="callout clearfix primary">
                                @if(isset($message))
                                    <h2 class="bg-info">
                                        {{$message}}
                                    </h2>
                                @endif
                                @if(\Classes\Core\Session::has('MESSAGE'))
                                    <h2 class="bg-info">
                                        {{\Classes\Core\Session::get('MESSAGE')}}
                                    </h2>
                                @endif

                            <h2 class="bg-warning">
                                @if(isset($error))
                                    @foreach ( $error as $err)
                                        {{$err}}<br>;
                                    @endforeach
                                @endif
                            </h2>

                            <form id="login-id" action="" method="post">
                                <input type="hidden" name="CSRFToken" value="{{\Classes\Core\CSRFToken::_SetToken()}}"/>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username please" value="<?php echo (\Classes\Core\Params::has('username')) ? \Classes\Core\Params::get('post')->username : ''; ?>" >

                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password please" value="<?php echo (\Classes\Core\Params::has('password')) ? \Classes\Core\Params::get('post')->password : ''; ?>">

                                </div>


                                <div class="form-group">
                                    <button type="submit" name="submit" value="" class="button success float-right">Submit</button>

                                </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
