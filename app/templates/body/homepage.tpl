



<div>
    <div id="story"></div>
    <div>
        <a id="story-prev" href="#">prev</a> | <a id="story-next" href="#">next</a>
    </div>
</div>
<hr>
<div id="stories-container"></div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    var story_id = {@story-id};
    
    $('#story').load('{@ROOT}/story/view/' + story_id);
    $('#stories-container').load('{@ROOT}/story', function(){
        $('.pages_container').on('click', 'a', function(e){
            e.preventDefault();
            var url0 = $(this).attr('href');
            var url = url0 + ' .items_container';
            $('#stories-container .items_container').load(url);
            var pc = $('#stories-container').find('.pages_container');
            pc.find('.selected').removeClass('selected');
            pc.find('a[href$="'+url0+'"]').addClass('selected');
        });
    });
    
    $(document).ready(function(){
        $('#story-prev').on('click', function(e){
            e.preventDefault();
            story_id--;
            $('#story').load('{@ROOT}/story/view/' + story_id);
        });
        $('#story-next').on('click', function(e){
            e.preventDefault();
            story_id++;
            $('#story').load('{@ROOT}/story/view/' + story_id);
        });
    });
</script>