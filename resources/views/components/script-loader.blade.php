@if(isset($moduleScript))
    <script src="/assets/js/{{ $moduleScript }}?ver={{ config('assets.version') }}"></script>
@endif