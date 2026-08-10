<?php
// Note: settings.php aur Database object class globally available hain.

// 1. Fetch Categories for Filter Tabs (Active categories only)
$categoryDb = new Database('portfolio_work_category');
$allCategories = $categoryDb->where(['status' => 'active']);

// 2. Fetch Active Clients (Sorted according to priority ascending)
$dbHelper = new Database('');
$clientStmt = $dbHelper->query("SELECT * FROM portfolio_client WHERE status = 'active' ORDER BY priority ASC");
$activeClients = $clientStmt->fetchAll();

$clientImageDb = new Database('portfolio_client_image');
?>

<section>
    <div class="container py-5">

        <div class="text-center mb-4">
            <h1 class="hero-title">Our Top Recent Works</h1>
            <p class="hero-sub mt-2">Creative solutions delivered for brands across industries.</p>
            <div class="hero-divider mx-auto"></div>
        </div>

        <div class="filter-tabs mb-4" role="group" aria-label="Filter works by category">
            <button class="filter-btn active" data-filter="all">All Works</button>
            <?php if (!empty($allCategories)): ?>
                <?php foreach ($allCategories as $cat): ?>
                    <button class="filter-btn" data-filter="<?= htmlspecialchars($cat['slug']) ?>">
                        <?= htmlspecialchars($cat['name']) ?>
                    </button>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="d-flex flex-column gap-4" id="cards-container">
            <?php 
            if (!empty($activeClients)): 
                foreach ($activeClients as $client): 
                    $clientId = intval($client['id']);

                    // ── DYNAMIC RELATION MAPPING VIA JSON (portfolio_client_work) ──
                    $mappingSql = "SELECT work_ids FROM portfolio_client_work WHERE client_id = :client_id AND status = 'active'";
                    $mappingStmt = $dbHelper->query($mappingSql, ['client_id' => $clientId]);
                    $mappings = $mappingStmt->fetchAll();

                    $allWorkIds = [];
                    if (!empty($mappings)) {
                        foreach ($mappings as $map) {
                            if (!empty($map['work_ids'])) {
                                $decodedIds = json_decode($map['work_ids'], true);
                                if (is_array($decodedIds)) {
                                    $allWorkIds = array_merge($allWorkIds, $decodedIds);
                                }
                            }
                        }
                    }
                    $allWorkIds = array_unique(array_filter(array_map('intval', $allWorkIds)));

                    $groupedWorks = [];
                    $assignedSlugs = [];

                    if (!empty($allWorkIds)) {
                        $idsString = implode(',', $allWorkIds);
                        
                        $workSql = "SELECT pw.name AS work_name, pw.category_id, pwc.name AS cat_name, pwc.slug AS cat_slug, pwc.icon AS cat_icon 
                                    FROM portfolio_work pw
                                    JOIN portfolio_work_category pwc ON pw.category_id = pwc.id
                                    WHERE pw.id IN ($idsString) AND pw.status = 'active'";
                        
                        $worksStmt = $dbHelper->query($workSql);
                        $clientWorks = $worksStmt->fetchAll();

                        if (!empty($clientWorks)) {
                            foreach ($clientWorks as $work) {
                                $assignedSlugs[] = $work['cat_slug'];
                                
                                $groupedWorks[$work['category_id']]['meta'] = [
                                    'name' => $work['cat_name'],
                                    'icon' => $work['cat_icon']
                                ];
                                $groupedWorks[$work['category_id']]['list'][] = $work['work_name'];
                            }
                        }
                    }

                    $categoryFilterString = implode(' ', array_unique($assignedSlugs));

                    // ── FETCH CLIENT SOCIAL LINKS (ORDERED BY SORT ORDER) ──
                    $socialSql = "SELECT name, icon, link FROM portfolio_social WHERE client_id = :client_id AND status = '1' ORDER BY sort_order ASC";
                    $socialStmt = $dbHelper->query($socialSql, ['client_id' => $clientId]);
                    $clientSocials = $socialStmt->fetchAll();

                    // ── IMAGE FALLBACK LOGIC ENGINE ──
                    $showcaseImage = '';
                    $galleryCheck = $clientImageDb->where(['client_id' => $clientId]);
                    
                    if (!empty($galleryCheck) && !empty($galleryCheck[0]['image_url'])) {
                        $showcaseImage = BASE_URL . 'uploads/clients/portfolio/' . $galleryCheck[0]['image_url'];
                    } elseif (!empty($client['logo_url'])) {
                        $showcaseImage = BASE_URL . 'uploads/clients/' . $client['logo_url'];
                    } else {
                        $showcaseImage = BASE_URL . 'assets/img/project/default-placeholder.png';
                    }
            ?>
                    <article class="work-card" data-categories="<?= $categoryFilterString ?>">
                        <div class="card-inner row">
                            
                            <div class="logo-block pe-lg-0">
                                <img src="<?= $showcaseImage ?>" alt="<?= htmlspecialchars($client['company_name']) ?>" class="img-fluid">
                            </div>

                            <div class="card-right">
                                <div class="card-body-row">

                                    <div class="brand-block">
                                        <div class="brand-name"><?= htmlspecialchars($client['company_name']) ?></div>
                                    </div>

                                    <div class="services-area pt-0">
                                        <?php if (!empty($groupedWorks)): ?>
                                            <?php foreach ($groupedWorks as $catId => $group): ?>
                                                <div class="svc-col">
                                                    <div class="svc-col-title">
                                                        <span class="icon-box">
                                                            <?= !empty($group['meta']['icon']) ? $group['meta']['icon'] : '<i class="fa fa-layer-group"></i>' ?>
                                                        </span>
                                                        <?= htmlspecialchars($group['meta']['name']) ?>
                                                    </div>
                                                    <ul class="svc-list">
                                                        <?php foreach ($group['list'] as $workName): ?>
                                                            <li><?= htmlspecialchars($workName) ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="text-muted fs-6 italic">Project services pending configuration...</div>
                                        <?php endif; ?>
                                    </div>

                                </div>

                                <!-- ── DYNAMIC LINKS + ACTION BUTTON SECTION ── -->
                                <div class="view-link-wrap">
                                    <div class="social-links-group">
                                        <?php if (!empty($clientSocials)): ?>
                                            <?php foreach ($clientSocials as $social): ?>
                                                <a href="<?= htmlspecialchars($social['link']) ?>" target="_blank" class="social-icon-btn" title="<?= htmlspecialchars($social['name']) ?>" aria-label="<?= htmlspecialchars($social['name']) ?>">
                                                    <i class="<?= htmlspecialchars($social['icon']) ?>"></i>
                                                </a>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>

                                    <a href="<?= !empty($client['website_url']) ? htmlspecialchars($client['website_url']) : '#' ?>" <?= !empty($client['website_url']) ? 'target="_blank"' : '' ?> class="view-link">
                                        View Case Study <i class="fa fa-arrow-right fa-xs"></i>
                                    </a>
                                </div>

                            </div>

                        </div>
                    </article>
            <?php 
                endforeach; 
            else: 
            ?>
                <div class="alert alert-light text-center p-5 shadow-sm border">
                    <p class="mb-0 text-muted fw-semibold">No active portfolio projects discovered matching current criteria.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="bottom-stats mt-5">
            <div class="row g-0">
                <div class="col-12 col-sm-6 col-lg-3" style="border-right:1px solid var(--border);">
                    <div class="stat-item">
                        <div class="stat-icon purple"><i class="fa fa-solid fa-gem"></i></div>
                        <div>
                            <div class="stat-title">Quality Design</div>
                            <div class="stat-desc">Creative &amp; impactful designs that build brands.</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3" style="border-right:1px solid var(--border);">
                    <div class="stat-item">
                        <div class="stat-icon green"><i class="fa fa-solid fa-bullseye"></i></div>
                        <div>
                            <div class="stat-title" style="color:#059669;">On-Time Delivery</div>
                            <div class="stat-desc">Timely execution with quality assurance.</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3" style="border-right:1px solid var(--border);">
                    <div class="stat-item">
                        <div class="stat-icon orange"><i class="fa fa-solid fa-users"></i></div>
                        <div>
                            <div class="stat-title" style="color:#ea580c;">Client Satisfaction</div>
                            <div class="stat-desc">Long-term relationships built on trust.</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-item">
                        <div class="stat-icon blue"><i class="fa fa-solid fa-lightbulb"></i></div>
                        <div>
                            <div class="stat-title" style="color:#2563eb;">End-to-End Solution</div>
                            <div class="stat-desc">From strategy to execution, we do it all.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    // ── FILTER LOGIC ──
    const filterBtns = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.work-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filter = btn.dataset.filter.trim();

            cards.forEach(card => {
                const cats = card.dataset.categories ? card.dataset.categories.split(' ') : [];
                const show = filter === 'all' || cats.includes(filter);

                if (show) {
                    card.style.display = '';
                    card.style.animation = 'none';
                    card.offsetHeight; // Reflow trigger
                    card.style.animation = 'fadeUp 0.35s forwards';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>