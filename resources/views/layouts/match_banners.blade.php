<div class="side-match">
    <script src="https://embed.twitch.tv/embed/v1.js"></script>

    <div class="stream-div">
        <div id="twitch-embed" style="height: 100%">
            @if (!isset($dataLive[$activeMatchNumber])) 
                <div class="no_matches_banner"></div>
            @elseif (empty($dataLive[$activeMatchNumber]->stream_channel))
                <div class="no_stream_banner"></div>
            @else
                <script type="text/javascript">
                    function run_stream_after()
                    {
                        new Twitch.Embed("twitch-embed", {
                            channel: "{{ $dataLive[$activeMatchNumber]->stream_channel }}",
                            layout: "video",
                            width: "100%",
                            height: "100%",
                            autoPlay: true,
                            muted: true,
                            setVolume: 0.5
                        });
                    }
                </script>
            @endif
        </div>
    </div>

    @if (count($banners) > 0)
        <ul class="big-banner">
            @foreach($banners as $banner)
                <li>
                    <a target="_blank" href="{{ $banner->link }}">
                        <img class="d-only" src="/img/banners/{{ $banner->image_dark ?? '' }}" alt="{{ $banner->title }}" title="{{ $banner->title }}">
                        <img class="l-only" src="/img/banners/{{ $banner->image_white ?? '' }}" alt="{{ $banner->title }}" title="{{ $banner->title }}">
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

</div>
