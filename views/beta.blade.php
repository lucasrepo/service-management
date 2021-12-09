@extends('layouts.app')

@section('main')
<div uk-filter="target: .js-filter" class="uk-padding">
	<div class="uk-grid-small uk-flex-middle" uk-grid>
        <div class="uk-width-expand">

            <div class="uk-grid-small uk-grid-divider uk-child-width-auto" uk-grid>
                <div>
                    <ul class="uk-subnav uk-subnav-pill" uk-margin>
                        <li class="uk-active" uk-filter-control><a href="#">All</a></li>
                    </ul>
                </div>
                <div>
                    <ul class="uk-subnav uk-subnav-pill" uk-margin>
                        <li uk-filter-control="[data-color='white']"><a href="#">White</a></li>
                        <li uk-filter-control="[data-color='blue']"><a href="#">Blue</a></li>
                        <li uk-filter-control="[data-color='black']"><a href="#">Black</a></li>
                    </ul>
                </div>
                <div>
                    <ul class="uk-subnav uk-subnav-pill" uk-margin>
                        <li uk-filter-control="[data-size='small']"><a href="#">Small</a></li>
                        <li uk-filter-control="[data-size='medium']"><a href="#">Medium</a></li>
                        <li uk-filter-control="[data-size='large']"><a href="#">Large</a></li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="uk-width-auto uk-text-nowrap">


            <span class="uk-active" uk-filter-control="sort: data-name"><a class="uk-icon-link" href="#" uk-icon="icon: arrow-down"></a></span>
            <span uk-filter-control="sort: data-name; order: desc"><a class="uk-icon-link" href="#" uk-icon="icon: arrow-up"></a></span>

        </div>
    </div>

    <ul class="js-filter uk-child-width-1-2 uk-child-width-1-3@m uk-text-center" uk-grid="masonry: true">
        @foreach($tags as $tag)
        <li data-tags="{{$tag}}" data-size="large" data-name="A">
            <div class="uk-card uk-card-default uk-card-body">
                <canvas width="600" height="800"></canvas>
                <div class="uk-position-center">{{ $tag }}</div>
            </div>
        </li>
        @endforeach
    </ul>

</div>

@endsection