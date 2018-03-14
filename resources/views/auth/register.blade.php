@extends('layouts.app')

@section('content')
    <div class="columns is-marginless is-centered">
        <div class="column is-7">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">Register</p>
                </header>

                <div class="card-content">
                    <form class="register-form" method="POST" action="{{ route('register') }}">

                        {{ csrf_field() }}

                        <div class="field">
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email *" required autofocus>
                                    </p>

                                    @if ($errors->has('email'))
                                        <p class="help is-danger">
                                            {{ $errors->first('email') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="company" type="text" name="company" placeholder="Company *" required>
                                    </p>

                                    @if ($errors->has('company'))
                                        <p class="help is-danger">
                                            {{ $errors->first('company') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="name" type="text" name="name" placeholder="Name *" required>
                                    </p>

                                    @if ($errors->has('name'))
                                        <p class="help is-danger">
                                            {{ $errors->first('name') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="surnames" type="text" name="surnames" placeholder="Surnames *" required>
                                    </p>

                                    @if ($errors->has('surnames'))
                                        <p class="help is-danger">
                                            {{ $errors->first('surnames') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="address_line_1" type="text" name="address_line_1" placeholder="Address line 1 *" required>
                                    </p>

                                    @if ($errors->has('address_line_1'))
                                        <p class="help is-danger">
                                            {{ $errors->first('address_line_1') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="address_line_2" type="text" name="address_line_2" placeholder="Address line 2">
                                    </p>

                                    @if ($errors->has('address_line_2'))
                                        <p class="help is-danger">
                                            {{ $errors->first('address_line_2') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="country" type="text" name="country" placeholder="Country *" required>
                                    </p>

                                    @if ($errors->has('country'))
                                        <p class="help is-danger">
                                            {{ $errors->first('country') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="city" type="text" name="city" placeholder="City *" required>
                                    </p>

                                    @if ($errors->has('city'))
                                        <p class="help is-danger">
                                            {{ $errors->first('city') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="zip_code" type="number" name="zip_code" placeholder="Zip code *" required>
                                    </p>

                                    @if ($errors->has('zip_code'))
                                        <p class="help is-danger">
                                            {{ $errors->first('zip_code') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="password" type="password" name="password" placeholder="Password *" required>
                                    </p>

                                    @if ($errors->has('password'))
                                        <p class="help is-danger">
                                            {{ $errors->first('password') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm password *" required>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="field"></div>

                                <div class="field is-grouped">
                                    <div class="control">
                                        <button type="submit" class="button is-info">Register</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
