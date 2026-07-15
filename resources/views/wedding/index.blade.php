@extends('layouts.wedding')

@section('content')
    @include('wedding.partials.cover')
    @include('wedding.partials.hero')
    @include('wedding.partials.opening')
    @include('wedding.partials.couple')
    @include('wedding.partials.countdown')

    @if($wedding->sections['story']['enabled'] ?? true)
        @include('wedding.partials.story')
    @endif

    @if($wedding->sections['event']['enabled'] ?? true)
        @include('wedding.partials.event')
    @endif

    @if($wedding->sections['gallery']['enabled'] ?? true)
        @include('wedding.partials.gallery')
    @endif

    @if($wedding->sections['video']['enabled'] ?? true)
        @include('wedding.partials.video')
    @endif

    @if($wedding->sections['location']['enabled'] ?? true)
        @include('wedding.partials.location')
    @endif

    @if($wedding->sections['rsvp']['enabled'] ?? true)
        @include('wedding.partials.rsvp')
    @endif

    @if($wedding->sections['gift']['enabled'] ?? true)
        @include('wedding.partials.gift')
    @endif

    @if($wedding->sections['wish']['enabled'] ?? true)
        @include('wedding.partials.wish')
    @endif

    @include('wedding.partials.footer')
@endsection
