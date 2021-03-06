@extends('layouts.site')

@section('title')
    @lang('site/blog.title')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @foreach($posts as $post)
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 style="margin-top:5px"><a href="{{ route('site.post.show', ['slug' => $post->slug]) }}">{{ $post->title }}</a></h3>
                    <div>
                        <small>
                            <i class="fa fa-clock-o"></i> {{ $post->created_at }}&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-user"></i> {{ $post->user->name }}&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-list"></i>
                            @foreach($post->categories as $category)
                                <a href="{{ route('site.category.show', ['slug' => $category->slug]) }}">{{ $category->title }}</a>{{ !$loop->last ? ',' : ''}}

                            @endforeach
                        </small>
                    </div>
                    <hr>
                    <div class="">
                        <img class="img-thumbnail pull-left" src="{{ asset('images/posts/small/' . $post->image) }}" alt="">
                        {{ mb_substr(strip_tags($post->description), 0, 300) }} ...
                    </div>
                    <hr style="clear: both;">
                    <div class="text-right">
                        <a href="{{ route('site.post.show', ['slug' => $post->slug]) }}" class="btn btn-default"><i class="fa fa-eye"></i>  @lang('site/common.buttons.read_more')</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 style="margin:0">@lang('site/blog.categories')</h3>
                </div>
            </div>

            <ul class="list-group">
                @foreach($categories as $category)
                    <li class="list-group-item">
                        <span class="badge">{{ $category->posts()->count() }}</span>
                        <a href="{{ route('site.category.show', ['slug' => $category->slug]) }}">{{ $category->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        @if($posts->lastPage() > 1)
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
