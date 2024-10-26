<div class="bg-background text-foreground py-10">
    <div class="wrapper">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h2 class="text-xl font-bold"><?php esc_html_e( 'Ghor Bari', 'your-textdomain' ); ?></h2>
                <p class="mt-2"><?php esc_html_e( 'There are many variations of passages Lorem Ipsum available, but the majority has suffered alteration.', 'your-textdomain' ); ?></p>
                <h3 class="mt-4 font-semibold"><?php esc_html_e( 'Business Hour', 'your-textdomain' ); ?></h3>
                <p><?php esc_html_e( 'Monday - Friday 10:00am - 06:00pm', 'your-textdomain' ); ?></p>
            </div>
            <div>
                <h3 class="text-lg font-semibold"><?php esc_html_e( 'Important Links', 'your-textdomain' ); ?></h3>
                <ul class="mt-2">
                    <li><a href="#" class="text-primary hover:underline"><?php esc_html_e( 'Our Services', 'your-textdomain' ); ?></a></li>
                    <li><a href="#" class="text-primary hover:underline"><?php esc_html_e( 'Privacy', 'your-textdomain' ); ?></a></li>
                    <li><a href="#" class="text-primary hover:underline"><?php esc_html_e( 'Contacts', 'your-textdomain' ); ?></a></li>
                    <li><a href="#" class="text-primary hover:underline"><?php esc_html_e( 'Meet Our Team', 'your-textdomain' ); ?></a></li>
                    <li><a href="#" class="text-primary hover:underline"><?php esc_html_e( 'Help Desk', 'your-textdomain' ); ?></a></li>
                    <li><a href="#" class="text-primary hover:underline"><?php esc_html_e( 'FAQs', 'your-textdomain' ); ?></a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold"><?php esc_html_e( 'Follow Instagram', 'your-textdomain' ); ?></h3>
                <div class="grid grid-cols-2 gap-2 mt-2">
                    <img class="rounded-lg" src="https://placehold.co/150x150" alt="<?php esc_attr_e( 'Instagram Image 1', 'your-textdomain' ); ?>" />
                    <img class="rounded-lg" src="https://placehold.co/150x150" alt="<?php esc_attr_e( 'Instagram Image 2', 'your-textdomain' ); ?>" />
                    <img class="rounded-lg" src="https://placehold.co/150x150" alt="<?php esc_attr_e( 'Instagram Image 3', 'your-textdomain' ); ?>" />
                    <img class="rounded-lg" src="https://placehold.co/150x150" alt="<?php esc_attr_e( 'Instagram Image 4', 'your-textdomain' ); ?>" />
                </div>
            </div>
        </div>
        <div class="text-center mt-10 text-sm text-muted-foreground">
            <?php printf( esc_html__( 'All Rights Reserved By Jit Banik %s', 'your-textdomain' ), esc_html( date( 'Y' ) ) ); ?>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>

</html>