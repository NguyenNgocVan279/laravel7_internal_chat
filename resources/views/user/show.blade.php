@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div style="font-size: 150%;" class="card-header">{{ $user->name }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <b>My Motto:<br>{{$user->motto}}</b>
                                <p class="mt-2"><b>About me:</b><br>{{$user->about_me}}</p>

                                <h5>Hobbies of {{ $user->name }}</h5>
                                <ul class="list-group">
                                    @if($user->hobbies->count() > 0)
                                        @foreach($user->hobbies as $hobby)
                                            <li class="list-group-item">
                                                @if(file_exists('img/hobbies/' . $hobby->id . '_thumb.jpg')) <!-- Note: Không có "/" trước img -->
                                                    <a title="Show Details" href="/hobby/{{ $hobby->id }}">
                                                        <img src="/img/hobbies/{{ $hobby->id }}_thumb.jpg" alt="Hobby Thumb"> <!-- Note: Có "/" trước img -->                                        
                                                    </a>
                                                @endif
                                                &nbsp;<a title="Show Details" href="/hobby/{{ $hobby->id }}">{{ $hobby->name }}</a>
                                                <span class="float-right mx-2">{{ $hobby->created_at->diffForHumans() }}</span>
                                                <br>
                                                @foreach($hobby->tags as $tag)
                                                    <a href="/hobby/tag/{{ $tag->id }}"><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                                                @endforeach
                                            </li>
                                        @endforeach
                                </ul>
                                @else
                                    <p>
                                        {{ $user->name }} has not created any hobbies yet.
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <!--<img class="img-thumbnail" src="/img/300x400.jpg" alt="{{ $user->name }}">-->
                                @if(Auth::user() && file_exists('img/users/' . $user->id . '_large.jpg')) <!-- Note: Không có "/" trước img -->                                    
                                    <img class="img-fluid" src="/img/users/{{$user->id}}_large.jpg" alt="">                               
                                @endif
                                @if(!Auth::user() && file_exists('img/users/' . $user->id . '_pixelated.jpg'))
                                    <img class="img-fluid" src="/img/users/{{$user->id}}_pixelated.jpg" alt="">                                    
                                @endif          
                            </div>
                        </div>


                    </div>

                </div>

                <div class="mt-4">
                    <a class="btn btn-primary btn-sm" href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-up"></i> Back to Overview</a>
                </div>
            </div>
        </div>
    </div>
@endsection