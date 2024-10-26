<div class="w-100 p-5 flex items-center">
    <div class="icon-box flex items-center w-1/4">
        <span class="me-3"><img src="<?php echo get_theme_file_uri("/assets/images/bed.png") ?>" alt=""></span>
        <p><?php echo $post->bed ?> Bed</p>
        <!-- <div class="h-[20px] w-[10px] bg-[#000] self-end"></div> -->
    </div>
    <div class="icon-box flex items-center w-1/4">
        <span class="me-3"><img src="<?php echo get_theme_file_uri("/assets/images/bath.png") ?>" alt=""></span>
        <p><?php echo $post->bath ?> Baths</p>
    </div>
    <div class="icon-box flex items-center w-1/4">
        <span class="me-3"><img src="<?php echo get_theme_file_uri("/assets/images/living-room.png") ?>" alt=""></span>
        <p><?php echo $post->rooms ?> Rooms</p>
    </div>
    <div class="icon-box flex items-center w-1/4">
        <span class="me-3"><img src="<?php echo get_theme_file_uri("/assets/images/area.png") ?>" alt=""></span>
        <p><?php echo $post->area ?> sq</p>
    </div>
</div>