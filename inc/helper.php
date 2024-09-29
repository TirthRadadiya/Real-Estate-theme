<?php

function get_page_banner($title, $link)
{
    ob_start(); ?>
    <div class="relative bg-cover bg-center h-64"
        style="background-image: url('<?php echo get_template_directory_uri() ?>/assets/images/banner.png');">
        <div class="absolute inset-0 bg-black opacity-80"></div>
        <div class="relative flex flex-col items-center justify-center h-full text-white p-4">
            <div class="text-center md:text-left md:mr-4 mb-4 md:mb-0 w-[540px]">
                <p class="text-2xl font-bold text-center mb-3">Property Details</p>
            </div>
            <div class="flex flex-col md:flex-row justify-center items-center w-full max-w-md">
                <span><a href="<?php echo esc_url(site_url()); ?>">Home</a></span>&nbsp; / &nbsp;<span class="text-blue-600 hover:text-blue-800"><a
                        href="<?php echo $link ?>"><?php echo str_replace('Archives:', '', $title); ?></a></span>
            </div>
        </div>
    </div>
    <?php return ob_get_clean();
}

function find_blocks_of_post($blocks, $type)
{
    $matches = [];

    foreach ($blocks as $block) {
        if ($block['blockName'] === $type) {
            $matches[] = $block;
        }


        if (count($block['innerBlocks'])) {
            $matches = array_merge(
                $matches,
                find_blocks_of_post($block['innerBlocks'], $type)
            );
        }
    }

    return $matches;
}