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

        @foreach($posts as $post)
            <item>
                <title><![CDATA[{{ $feed->title }}]]></title>
                <link>{{ $feed->slug }}</link>
                <description><![CDATA[{!! $feed->description !!}]]></description>
                <category>{{ $feed->category }}</category>
                <author><![CDATA[{{ $feed->user->username  }}]]></author>
                <guid>{{ $feed->uuid }}</guid>
                <pubDate>{{ $feed->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>
