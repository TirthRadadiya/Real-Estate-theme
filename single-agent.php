<?php get_header(); ?>

<?php

while (have_posts()) {
    the_post(); ?>
    <div class="p-6 bg-background wrapper grid grid-cols-12">
        <div class="border rounded-lg bg-card col-span-8 p-10">
            <div class="grid grid-cols-12 mb-4">
                <div class="col-span-5 relative">
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Kristin Watson" class="w-full" />
                    <?php include get_template_directory() . "/inc/like-post.php"; ?>
                </div>
                <div class="col-span-5 ms-5">
                    <h2 class="text-lg font-bold"><?php the_title(); ?></h2>
                    <p class="text-muted">Designation</p>
                    <p class="text-muted">+123 456 789 000</p>
                    <p class="text-muted">mail.urmail.com</p>
                    <p class="text-muted">+00 123 456 789</p>
                </div>
            </div>
            <h3 class="font-semibold mb-2">About Kristin Watson</h3>
            <p class="text-muted mb-4">
                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in
                some form, by injected humour, or randomised words which don't look even slightly
                believable.
            </p>
            <form class="mt-4 border border-[#D3DEE8] p-10" method="post"
                action="<?php echo get_template_directory_uri(); ?>/send-agent-email.php">
                <h4 class="font-semibold mb-2 text-2xl">Contact With Kristin</h4>
                <div class="grid grid-cols-2">
                    <div class="mr-4 mb-4">
                        <label class="block text-muted" for="full_name">Full Name</label>
                        <input type="text" id="full_name" name="full_name" class="border rounded-lg p-2 w-full"
                            placeholder="Type full name" />
                    </div>
                    <div class="mb-4 ms-4">
                        <label class="block text-muted" for="email">Email</label>
                        <input type="email" id="email" name="email" class="border rounded-lg p-2 w-full"
                            placeholder="Your email" />
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-muted" for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" class="border rounded-lg p-2 w-full"
                        placeholder="Type subject" />
                </div>
                <div class="mb-4">
                    <label class="block text-muted" for="message">Message</label>
                    <textarea id="message" name="message" class="border rounded-lg p-2 w-full"
                        placeholder="Type message"></textarea>
                </div>
                <input type="submit" class="bg-primary text-secondary-foreground hover:bg-secondary/80 p-2 rounded-lg"
                    value="Sent Message" name="submitted" />
            </form>
        </div>
        <div class="col-span-4 p-4 pt-0">
            <div class="mb-4 bg-[#EEF7FF] px-5 pb-10 pt-5">
                <h3 class="font-semibold mb-5">Search Property</h3>
                <form method="POST" action="<?php echo site_url("/properties") ?>">
                    <input type="hidden" value="search_property" name="search_property" />
                    <input type="text" class="border rounded-lg p-2 w-full" id="property_location" name="property_location"
                        placeholder="Enter Location" />
                    <input type="submit" class="mt-3 border border-blue-800 px-5 py-2 rounded" value="Search"
                        name="from_agent" />
                </form>
            </div>
            <div class="bg-accent text-accent-foreground p-4 rounded-lg">
                <h2 class="font-bold">Find The Best Property</h2>
                <p>For Rent Or Buy</p>
                <div class="mt-4">
                    <p class="font-bold">Call Us Now</p>
                    <p class="text-lg">+00 123 456 789</p>
                </div>
            </div>
            <div class="mt-3">
                <a class="btn btn-primary" href="<?php echo esc_url(site_url("/register-property")) ?>">
                    Register Property
                </a>
            </div>
        </div>
    </div>
<?php }

?>


<?php get_footer(); ?>