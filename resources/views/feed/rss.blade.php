<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>
        <title><![CDATA[ DevDojo ]]></title>
        <link><![CDATA[ {{ config('app.url', '//') }}rss ]]></link>
        <description><![CDATA[ Your website description ]]></description>
        <language>{{ str_replace('_', '-', app()->getLocale()) }}</language>
        <pubDate>{{ now() }}</pubDate>

        @foreach($feed as $element)
            <item>
                <title><![CDATA[{{ $element->title }}]]></title>
                <link>{{ route('front.exhibition.show', ['place' => $element->inPlace->slug, 'slug' => $element->slug]) }}</link>
                <description><![CDATA[{!! $element->description !!}]]></description>
                <category>{{ $element->category }}</category>
                <author><![CDATA[{{ $element->inPlace->name  }}]]></author>
                <guid>{{ $element->uuid }}</guid>
                <pubDate>{{ $element->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>
