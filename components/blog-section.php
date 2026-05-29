<?php

try {
    $blogObj = new Database('blogs');
    $blogs = $blogObj->fetchAll();
} catch (Exception $e) {
    $blogs = [];
}

$hasBlogs = !empty($blogs);

?>

<section class="news-section section-padding fix">
    <div class="line-area">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="container">
        <div class="section-title text-center">
            <span class="wow fadeInUp">Our blog</span>
            <h2 class="wow fadeInUp" data-wow-delay=".3s">Read our latest blog post</h2>
        </div>
        <div class="row">

            <?php
            if ($hasBlogs) {
                $count = 0;
                $delay = 0.3;

                foreach ($blogs as $blog) {
                    if (isset($blog['status']) && $blog['status'] !== 'published') {
                        continue;
                    }
                    if ($count >= 3) break;

                    $postDate = "16 FEB";
                    if (!empty($blog['created_at'])) {
                        $postDate = strtoupper(date('d M', strtotime($blog['created_at'])));
                    }

                    $imagePath = BASE_URL . "uploads/blogs/" . $blog['image'];
                    if (empty($blog['image'])) {
                        $imagePath = "assets/img/news/07.jpg";
                    }
            ?>
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="<?= $delay ?>s">
                        <div class="single-news-items-3 <?= $count === 1 ? 'active' : '' ?>">
                            <div class="news-image bg-cover" style="background-image: url('<?= $imagePath ?>');">
                                <span class="post-date"><?= $postDate ?></span>
                            </div>
                            <div class="news-content">
                                <span>By Admin</span>
                                <h3>
                                    <a href="<?= BASE_URL ?>blog/<?= $blog['slug'] ?>">
                                        <?= htmlspecialchars($blog['title']) ?>
                                    </a>
                                </h3>
                                <div class="news-btn d-flex align-items-center justify-content-between">
                                    <a href="<?= BASE_URL ?>blog/<?= $blog['slug'] ?>">
                                        Read More
                                    </a>
                                    <a href="<?= BASE_URL ?>blog/<?= $blog['slug'] ?>">
                                        <i class="fas fa-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                    $count++;
                    $delay += 0.2;
                }
            }

            ?>



        </div>
    </div>
</section>