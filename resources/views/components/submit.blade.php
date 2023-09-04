<div class="custom-model-main">
    <div class="custom-model-inner">
        <div class="close-btn">×</div>
        <div class="custom-model-wrap">
            <div class="pop-up-content-wrap p-5">
                
                <span style="text-align: right;">
                    
                    {{ $text }}
                </span> 

                @if ($image)
                <hr>

                    {!! $image !!}
                @endif
           
        @if ($type == 'submit')
            <input type="submit" value="تایید" class="btn btn-success">
        @elseif($type == 'desc')
            <span class="close-btn btn btn-secondary">متوجه شدم</span>
        @endif

            </div>
        </div>

    </div>
    <div class="bg-overlay"></div>
</div>
<script>
    $(".fa-info").on('click', function() {
        $(".custom-model-main").addClass('model-open');
    });
    $(".close-btn, .bg-overlay").click(function() {
        $(".custom-model-main").removeClass('model-open');
    });
</script>
