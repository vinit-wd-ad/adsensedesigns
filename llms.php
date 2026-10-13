<?php
require_once "setting.php";

// Set header to plain text / markdown
header('Content-Type: text/plain; charset=UTF-8');

// Build llms.txt Markdown Content
$output = "# Adsense Designs\n\n";
$output .= "> Adsense Designs Pvt. Ltd. is a premier creative and digital marketing agency based in New Delhi. We specialize in graphic design, motion graphics, custom web development, digital marketing, corporate gifting, exhibition setups, and indoor branding.\n\n";

// --- Core Pages ---
$output .= "## Core Pages & Services Overview\n";
$output .= "- [Home Page](" . BASE_URL . "): Official overview of Adsense Designs, capabilities, and solutions.\n";
$output .= "- [About Us](" . BASE_URL . "about-us): Mission, agency background, team, and company history.\n";
$output .= "- [What We Do](" . BASE_URL . "what-we-do): Detailed breakdown of our design and digital marketing workflow.\n";
$output .= "- [Why Choose Us](" . BASE_URL . "why-choose-us): Key differentiators, strategy, and business benefits.\n";
$output .= "- [Our Services](" . BASE_URL . "services): Full listing of all agency service offerings.\n";
$output .= "- [Case Studies](" . BASE_URL . "case-studies): Client success stories, portfolios, and marketing performance results.\n";
$output .= "- [Testimonials](" . BASE_URL . "testimonial): Client reviews, ratings, and feedback.\n";
$output .= "- [Blogs](" . BASE_URL . "blogs): Insights, web design tips, and digital marketing articles.\n";
$output .= "- [Contact Us](" . BASE_URL . "contact-us): Office location, contact info, and inquiry form.\n\n";

// --- Dynamic Services ---
try {
    $objService = new Database('services');
    $activeServices = $objService->where(['status' => 'active']);

    if (!empty($activeServices) && is_array($activeServices)) {
        $output .= "## Dynamic Services\n";
        foreach ($activeServices as $service) {
            $serviceName = htmlspecialchars($service['name']);
            $serviceSlug = htmlspecialchars($service['slug']);
            $serviceDesc = !empty($service['short_description'])
                ? htmlspecialchars(substr(strip_tags($service['short_description']), 0, 120)) . "..."
                : "Professional " . $serviceName . " solutions by Adsense Designs.";

            $serviceUrl = BASE_URL . "services/" . $serviceSlug;
            $output .= "- [{$serviceName}]({$serviceUrl}): {$serviceDesc}\n";
        }
        $output .= "\n";
    }
} catch (Exception $e) {
    // Fail-safe if database error occurs
}

// --- Dynamic Blog Posts ---
try {
    $objBlog = new Database('blogs');
    // Fetch latest active/published blogs
    $activeBlogs = $objBlog->fetchAll(); // System configuration or custom method to fetch blogs

    if (!empty($activeBlogs) && is_array($activeBlogs)) {
        $output .= "## Blog Articles & Insights\n";
        // Show up to 20 recent blogs
        $recentBlogs = array_slice($activeBlogs, 0, 20);
        foreach ($recentBlogs as $blog) {
            $blogTitle = htmlspecialchars($blog['title']);
            $blogSlug  = htmlspecialchars($blog['slug']);
            $blogDesc  = !empty($blog['short_description'])
                ? htmlspecialchars(substr(strip_tags($blog['short_description']), 0, 120)) . "..."
                : "Read our article on " . $blogTitle;

            $blogUrl = BASE_URL . "blog/" . $blogSlug;
            $output .= "- [{$blogTitle}]({$blogUrl}): {$blogDesc}\n";
        }
        $output .= "\n";
    }
} catch (Exception $e) {
    // Fail-safe
}

// Echo final markdown
echo $output;
