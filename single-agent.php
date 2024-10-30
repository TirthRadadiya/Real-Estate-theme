<?php get_header(); ?>

<?php
while (have_posts()) : the_post(); ?>
    <div class="p-6 bg-background wrapper grid grid-cols-12">
        <div class="border rounded-lg bg-card col-span-8 p-10">
            <div class="grid grid-cols-12 mb-4">
                <div class="col-span-5 relative">
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title_attribute(); ?>" class="w-full" />
                    <?php include get_template_directory() . '/inc/like-post.php'; ?>
                </div>
                <div class="col-span-5 ms-5">
                    <h2 class="text-lg font-bold"><?php the_title(); ?></h2>
                    <p class="text-muted"><?php esc_html_e('Designation', 'your-text-domain'); ?></p>
                    <p class="text-muted">+123 456 789 000</p>
                    <p class="text-muted"><?php esc_html_e('mail.urmail.com', 'your-text-domain'); ?></p>
                    <p class="text-muted">+00 123 456 789</p>
                </div>
            </div>
            <h3 class="font-semibold mb-2"><?php esc_html_e('About Kristin Watson', 'your-text-domain'); ?></h3>
            <p class="text-muted mb-4">
                <?php esc_html_e('There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', 'your-text-domain'); ?>
            </p>
            <form class="mt-4 border border-[#D3DEE8] p-10" method="post" action="<?php echo esc_url(get_template_directory_uri() . '/send-agent-email.php'); ?>">
                <h4 class="font-semibold mb-2 text-2xl"><?php esc_html_e('Contact With Kristin', 'your-text-domain'); ?></h4>
                <div class="grid grid-cols-2">
                    <div class="mr-4 mb-4">
                        <label class="block text-muted" for="full_name"><?php esc_html_e('Full Name', 'your-text-domain'); ?></label>
                        <input type="text" id="full_name" name="full_name" class="border rounded-lg p-2 w-full" placeholder="<?php esc_attr_e('Type full name', 'your-text-domain'); ?>" />
                    </div>
                    <div class="mb-4 ms-4">
                        <label class="block text-muted" for="email"><?php esc_html_e('Email', 'your-text-domain'); ?></label>
                        <input type="email" id="email" name="email" class="border rounded-lg p-2 w-full" placeholder="<?php esc_attr_e('Your email', 'your-text-domain'); ?>" />
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-muted" for="subject"><?php esc_html_e('Subject', 'your-text-domain'); ?></label>
                    <input type="text" id="subject" name="subject" class="border rounded-lg p-2 w-full" placeholder="<?php esc_attr_e('Type subject', 'your-text-domain'); ?>" />
                </div>
                <div class="mb-4">
                    <label class="block text-muted" for="message"><?php esc_html_e('Message', 'your-text-domain'); ?></label>
                    <textarea id="message" name="message" class="border rounded-lg p-2 w-full" placeholder="<?php esc_attr_e('Type message', 'your-text-domain'); ?>"></textarea>
                </div>
                <input type="submit" class="bg-primary text-secondary-foreground hover:bg-secondary/80 p-2 rounded-lg" value="<?php esc_attr_e('Send Message', 'your-text-domain'); ?>" name="submitted" />
            </form>
        </div>
        <div class="col-span-4 p-4 pt-0">
            <div class="mb-4 bg-[#EEF7FF] px-5 pb-10 pt-5">
                <h3 class="font-semibold mb-5"><?php esc_html_e('Search Property', 'your-text-domain'); ?></h3>
                <form method="POST" action="<?php echo esc_url(site_url('/properties')); ?>">
                    <input type="hidden" name="search_property" value="search_property" />
                    <input type="text" class="border rounded-lg p-2 w-full" id="property_location" name="property_location" placeholder="<?php esc_attr_e('Enter Location', 'your-text-domain'); ?>" />
                    <input type="submit" class="mt-3 border border-blue-800 px-5 py-2 rounded" value="<?php esc_attr_e('Search', 'your-text-domain'); ?>" name="from_agent" />
                </form>
            </div>
            <div class="bg-accent text-accent-foreground p-4 rounded-lg">
                <h2 class="font-bold"><?php esc_html_e('Find The Best Property', 'your-text-domain'); ?></h2>
                <p><?php esc_html_e('For Rent Or Buy', 'your-text-domain'); ?></p>
                <div class="mt-4">
                    <p class="font-bold"><?php esc_html_e('Call Us Now', 'your-text-domain'); ?></p>
                    <p class="text-lg">+00 123 456 789</p>
                </div>
            </div>
            <div class="mt-3">
                <a class="btn btn-primary" href="<?php echo esc_url(site_url('/register-property')); ?>">
                    <?php esc_html_e('Register Property', 'your-text-domain'); ?>
                </a>
            </div>
        </div>
    </div>
<?php endwhile; ?>

<?php get_footer(); ?>