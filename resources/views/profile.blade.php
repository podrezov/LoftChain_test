@extends('layouts.app')

@section('content')
    <div class="col-md-12">

        <div class="col-4 m-auto text-center">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>

        <div class="row">
            {{--Информация о профиле--}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Информация о профиле</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ $user->img ? asset('storage/' . $user->img) : asset('img/default.jpeg')  }}"
                                     style="max-width: 200px; max-height: 150px; border: 2px solid black;">
                            </div>

                            <div class="col">
                                <div>
                                    <h5><i class="fa fa-envelope"></i> {{ $user->email }}</h5>
                                </div>

                                <br>

                                {{--Загрузка фото--}}
                                <label for="inputGroupFile04"><i class="fa fa-image"></i> Загрузить фото</label>
                                <form enctype="multipart/form-data" action="{{ route('profile.image.upload', $user) }}"
                                      method="post">
                                    {{ csrf_field() }}

                                    {{--errors img--}}
                                    <div>
                                        @if ($errors->has('img'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('img') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile04"
                                                   aria-describedby="inputGroupFileAddon04" name="img">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose image</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit"><i
                                                        class="fa fa-save"></i> Загрузить
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--Смена пароля--}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Сменить пароль</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.password.update', $user) }}" method="post">
                            {{ csrf_field() }}
                            <label>Новый пароль</label>
                            <div class="input-group input-group-sm mb-3">
                                <input type="password" class="form-control" name="password">
                            </div>
                            <label>Повторите пароль</label>
                            <div class="input-group input-group-sm mb-3">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>

                            {{--errors password--}}
                            <div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-success"><i class="fa fa-key"></i> Сменить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection