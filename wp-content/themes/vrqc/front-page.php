<div class="clearfix">
    <?php get_header(); ?>
</div>
<div class="hidden-xs homepage-splash">
    <?php
        $post = get_post();
        $title = $post->ID;
        echo get_the_post_thumbnail($title, 'full');
        wp_reset_query();
    ?>
    <hr/>
</div>
<div class="">
    <div class="col-xs-12 col-sm-9 col-md-8 col-lg-7">
        <section class="col-xs-12">
            <nav><h3>Condo Filtering</h3></nav>
            <?php
            // get all the properties category
            $args = array('include'=> '7');
            $cats = get_categories($args);

            foreach ($cats as $cat) {
            echo "<div class='clearfix'>";
            $cat_id= $cat->term_id;
            query_posts("cat=$cat_id&posts_per_page=5");

            if (have_posts()) : while (have_posts()) : the_post(); ?>

            <article class="clearfix">
                <a href="<?php the_permalink();?>">
                    <div class="col-xs-12 col-sm-5 frontpage-post">
                        <?php echo get_the_post_thumbnail() ?>
                    </div>
                    <div class="col-xs-12 col-sm-7">
                        <h4><i class="fa fa-home"> <?php the_title(); ?></i></h4>
                        <p><?php the_content('More'); ?></p>
                    </div>
                </a>
                <hr class="col-xs-12"/>
            </article>

            <?php endwhile; endif; // done our wordpress loop. Will start again for each category ?>
            <?php } // done the foreach statement ?>
            </div>
            <hr/>
        </section>
        <section>
            <nav><h3>Post Filtering</h3></nav>
                <?php
            // get all the categories from the database except test, offrs, and properties
            $args = array('exclude'=> '1, 2, 5, 7');
                $cats = get_categories($args);

                foreach ($cats as $cat) {
                echo "<div class='clearfix post-group col-sm-4'>";
                $cat_id= $cat->term_id;
                echo "<h2>".$cat->name."</h2>";
                query_posts("cat=$cat_id&posts_per_page=1");

                if (have_posts()) : while (have_posts()) : the_post(); ?>

                <article>
                    <a href="<?php the_permalink();?>">
                        <div class="frontpage-post">
                            <?php echo get_the_post_thumbnail() ?>
                        </div>
                        <div>
                            <h4><i class="fa fa-thumb-tack"> <?php the_title(); ?></i></h4>
                        </div>
                    </a>
                    <hr/>
                </article>


                <?php endwhile; endif; // done our wordpress loop. Will start again for each category ?>
                <?php echo "</div>"; ?>
                <?php } // done the foreach statement ?>
            <?php wp_reset_query(); ?>

            </div>
        </section>
    </div>
    <aside class="col-xs-12 col-sm-3 col-md-4 col-lg-5">
        <section>
            <h3>Follow us</h3>
            <p>Stay abreast of Quebec City's finest info</p>
            <input type="text"/><button>Subscribe</button>
        </section>
        <section>
            <h3>Reviews</h3>
            <article class="col-xs-12">
                <div class="pull-left"><img src="https://cdn3.iconfinder.com/data/icons/wine-and-vineyard-icons/512/French_Man-128.png" width="100%" alt=""/></div>
                <div>review 1</div>
                <div>date</div>
                <div>link</div>
                <hr/>
            </article>
            <article class="col-xs-12">
                <div class="pull-left"><img src="https://cdn3.iconfinder.com/data/icons/wine-and-vineyard-icons/512/French_Man-128.png" width="100%" alt=""/></div>
                <div>review 1</div>
                <div>date</div>
                <div>link</div>
                <hr/>
            </article>
        </section>
        <section>
            <img width="100%" src="http://localhost/vrqc/wp-content/uploads/2015/01/vrqc-test-offer.jpg">
        </section>
    </aside>
</div>

<div class="clearfix col-xs-12">
    <?php get_footer(); ?>
</div>