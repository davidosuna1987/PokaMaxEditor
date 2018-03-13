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
                            <label class="label">E-mail Address</label>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="email" type="email" name="email"
                                               value="{{ old('email') }}" required autofocus>
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
                            <label class="label">Company</label>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="company" type="text" name="company" required>
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
                            <label class="label">Name</label>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="name" type="text" name="name" required>
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
                            <label class="label">Surnames</label>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="surnames" type="text" name="surnames" required>
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
                            <label class="label">Address line 1</label>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="address_line_1" type="text" name="address_line_1" required>
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
                            <label class="label">Address line 2</label>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="address_line_2" type="text" name="address_line_2">
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
                            <label class="label">Country</label>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="country" type="text" name="country" required>
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
                            <label class="label">City</label>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="city" type="text" name="city" required>
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
                            <label class="label">Zip code</label>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="zip_code" type="text" name="zip_code" required>
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
                            <label class="label">Password</label>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="password" type="password" name="password" required>
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
                            <label class="label">Confirm Password</label>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="password-confirm" type="password"
                                               name="password_confirmation" required>
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
