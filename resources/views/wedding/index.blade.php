@extends('layouts.wedding')

@section('content')
    @include('wedding.partials.cover')
    @include('wedding.partials.hero')
    @include('wedding.partials.opening')
    @include('wedding.partials.couple')
    @include('wedding.partials.countdown')

    @if(filter_var($wedding->sections['story']['enabled'] ?? true, FILTER_VALIDATE_BOOLEAN))
        @include('wedding.partials.story')
    @endif

    @if(filter_var($wedding->sections['event']['enabled'] ?? true, FILTER_VALIDATE_BOOLEAN))
        @include('wedding.partials.event')
    @endif

    @if(filter_var($wedding->sections['gallery']['enabled'] ?? true, FILTER_VALIDATE_BOOLEAN))
        @include('wedding.partials.gallery')
    @endif

    @if(filter_var($wedding->sections['video']['enabled'] ?? true, FILTER_VALIDATE_BOOLEAN))
        @include('wedding.partials.video')
    @endif

    @if(filter_var($wedding->sections['location']['enabled'] ?? true, FILTER_VALIDATE_BOOLEAN))
        @include('wedding.partials.location')
    @endif

    @if(filter_var($wedding->sections['rsvp']['enabled'] ?? true, FILTER_VALIDATE_BOOLEAN))
        @include('wedding.partials.rsvp')
    @endif

    @if(filter_var($wedding->sections['gift']['enabled'] ?? true, FILTER_VALIDATE_BOOLEAN))
        @include('wedding.partials.gift')
    @endif

    @if(filter_var($wedding->sections['wish']['enabled'] ?? true, FILTER_VALIDATE_BOOLEAN))
        @include('wedding.partials.wish')
    @endif

    @include('wedding.partials.footer')
@endsection
