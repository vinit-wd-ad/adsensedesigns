<?php
require "setting.php";
include "header.php";

$blogObj = new Database('blogs');

try {
    $allBlogs = $blogObj->fetchAll();
} catch (Exception $e) {
    $allBlogs = [];
}

$hasBlogs = !empty($allBlogs) && is_array($allBlogs);

render_header(
    "Adsense Designs - Blogs",
    "adsense designs blogs, web design, digital marketing",
    [
        "keywords" => "adsense designs, blogs, web design, digital marketing",
        "robots" => "index, follow",
    ],
    [
        "canonical" => "https://adsensedesigns.com/blogs",
    ]
);
?>

<div class="breadcrumb-wrapper section-padding bg-cover bg-banner-height" style="background-image: url('assets/img/breadcrumb.jpg');height:25rem;">
    <div class="layer-shape wow fadeInLeft" data-wow-delay=".3s">
        <img src="assets/img/layer-shape-3.png" alt="shape-img">
    </div>
    <div class="breadcrumb-shape wow fadeInRight" data-wow-delay=".5s"></div>
    <div class="container">
        <div class="page-heading">
            <h1 class="wow fadeInUp" data-wow-delay=".3s">Blogs</h1>
            <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                <li><a href="<?= BASE_URL ?>">Home Page</a></li>
                <li>/</li>
                <li>Blogs</li>
            </ul>
        </div>
    </div>
</div>

<section class="blog-wrapper news-wrapper section-padding border-bottom">
    <div class="container">
        <div class="news-area">
            <div class="row">
                
                <div class="col-12 col-lg-8">
                    <div class="blog-posts">
                        <?php 
                        if ($hasBlogs) {
                            foreach ($allBlogs as $blog) {
                                // Fallback image handling
                                $blogImage = !empty($blog['image']) ? BASE_URL . "uploads/blogs/" . $blog['image'] : "assets/img/news/post-1.jpg";
                                
                                // Dynamic date rendering
                                $blogDate = "24th March 2024"; // Default static fallback
                                if (!empty($blog['created_at'])) {
                                    $blogDate = date('jS F Y', strtotime($blog['created_at']));
                                }
                        ?>
                                <div class="single-blog-post mb-5">
                                    <div class="post-featured-thumb bg-cover" style="background-image: url('<?= $blogImage ?>');"></div>
                                    <div class="post-content">
                                        <div class="post-meta">
                                            <span><i class="fal fa-user"></i>By Admin</span>
                                            <span><i class="fal fa-calendar-alt"></i><?= $blogDate ?></span>
                                        </div>
                                        <h2>
                                            <a href="<?= BASE_URL ?>blog/<?= $blog['slug'] ?>">
                                                <?= htmlspecialchars($blog['title']) ?>
                                            </a>
                                        </h2>
                                        <p><?= htmlspecialchars($blog['short_description'] ?? '') ?></p>
                                        <a href="<?= BASE_URL ?>blog/<?= $blog['slug'] ?>" class="theme-btn mt-4">READ MORE</a>
                                    </div>
                                </div>
                        <?php 
                            }
                        } else { 
                        ?>
                            <div class="single-blog-post">
                                <div class="post-featured-thumb bg-cover" style="background-image: url('assets/img/news/post-1.jpg');"></div>
                                <div class="post-content">
                                    <div class="post-meta">
                                        <span><i class="fal fa-comments"></i>0 Comments</span>
                                        <span><i class="fal fa-calendar-alt"></i><?= date('jS F Y') ?></span>
                                    </div>
                                    <h2>
                                        <a href="#">
                                            Curabitur at fermentum purus. Interdum et malesuada fames ac ante ipsum (No Blogs Found)
                                        </a>
                                    </h2>
                                    <a href="#" class="theme-btn mt-4">READ MORE</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <?php if ($hasBlogs && count($allBlogs) > 5): ?>
                    <div class="page-nav-wrap mt-5 text-center">
                        <ul>
                            <li><a class="page-numbers" href="#"><i class="fal fa-long-arrow-left"></i></a></li>
                            <li><a class="page-numbers" href="#">01</a></li>
                            <li><a class="page-numbers" href="#">02</a></li>
                            <li><a class="page-numbers" href="#"><i class="fal fa-long-arrow-right"></i></a></li>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="col-12 col-lg-4">
                    <div class="main-sidebar">
                        
                        <div class="single-sidebar-widget">
                            <div class="wid-title">
                                <h3>Search</h3>
                            </div>
                            <div class="search_widget">
                                <form action="#">
                                    <input type="text" placeholder="Keywords here....">
                                    <button type="submit"><i class="fal fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="single-sidebar-widget">
                            <div class="wid-title">
                                <h3>Popular Feeds</h3>
                            </div>
                            <div class="popular-posts">
                                <?php 
                                if ($hasBlogs) {
                                    $feedCount = 0;
                                    foreach ($allBlogs as $feed) {
                                        if ($feedCount >= 3) break; 
                                        $feedImage = !empty($feed['image']) ? BASE_URL . "uploads/blogs/" . $feed['image'] : "assets/img/news/pp1.jpg";
                                        $feedDate = !empty($feed['created_at']) ? date('jS M Y', strtotime($feed['created_at'])) : "24th Mar 2024";
                                ?>
                                        <div class="single-post-item">
                                            <div class="thumb bg-cover" style="background-image: url('<?= $feedImage ?>');"></div>
                                            <div class="post-content">
                                                <h5>
                                                    <a href="<?= BASE_URL ?>blog/<?= $feed['slug'] ?>">
                                                        <?= htmlspecialchars($feed['title']) ?>
                                                    </a>
                                                </h5>
                                                <div class="post-date">
                                                    <i class="far fa-calendar-alt"></i><?= $feedDate ?>
                                                </div>
                                            </div>
                                        </div>
                                <?php 
                                        $feedCount++;
                                    }
                                } else {
                                ?>
                                    <div class="single-post-item">
                                        <div class="thumb bg-cover" style="background-image: url('assets/img/news/pp1.jpg');"></div>
                                        <div class="post-content">
                                            <h5><a href="#">Keep your business safe and ensure high execution</a></h5>
                                            <div class="post-date"><i class="far fa-calendar-alt"></i>24th March 2024</div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div class="single-sidebar-widget">
                            <div class="wid-title">
                                <h3>Categories</h3>
                            </div>
                            <div class="widget_categories">
                                <ul>
                                    <li><a href="#">Web Design <span><?= $hasBlogs ? count($allBlogs) : 0 ?></span></a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="single-sidebar-widget">
                            <div class="wid-title">
                                <h3>Never Miss News</h3>
                            </div>
                            <div class="social-link">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>