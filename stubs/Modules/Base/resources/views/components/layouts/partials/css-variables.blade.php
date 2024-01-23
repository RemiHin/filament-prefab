<style id="css-variables">
    :root {
    @foreach($colors as $key => $color)
        --{{ $key }}: {{ $color }};
    @endforeach
    }

    [data-theme="high"] {
    @foreach($contrastColors as $key => $color)
        --{{ $key }}: {{ $color }};
    @endforeach
    }
</style>
