<div class="{{$section_item->colmd}} col-xs-12" style="margin:0;padding:{{$section_item->padding}};">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <div class="youtube-container"></div>
</div>
<script>
// Put your channel id here and you are good to go
var channelID = "{{$section_item->codex}}";
$.getJSON('https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Fwww.youtube.com%2Ffeeds%2Fvideos.xml%3Fchannel_id%3D' + channelID, function (data) {
// change the number how many video you want from your feed
    for (i = 0; i < 9; i++) {
        var title = data.items[i].title;
        var link = data.items[i].link;
        var id = link.substr(link.indexOf("=") + 1);
        console.log(id);
        jQuery('body>.youtube-container').append('<div class="video col-md-{{$section_item->colxs}} col-xs-12"><iframe class="yt_video" src="https://youtube.com/embed/' + id + '?controls=0&showinfo=0&rel=0" frameborder="0" allowfullscreen></iframe></div>');
    }
});
</script>