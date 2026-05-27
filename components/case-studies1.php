<style>
    :root {
        --purple: #5b3fbe;
        --purple-light: #7c60d4;
        --purple-pale: #f0ecff;
        --accent: #5b3fbe;
        --text-dark: #111827;
        --text-mid: #374151;
        --text-muted: #6b7280;
        --text-link: #5b3fbe;
        --border: #e5e7eb;
        --card-bg: #ffffff;
        --page-bg: #f9f9fb;
        --radius-card: 16px;
        --radius-tag: 8px;
        --shadow: 0 20px 23px rgb(91 63 190 / 13%);
        --shadow-hover: 0 8px 36px rgba(91, 63, 190, 0.14);
        --transition: 0.22s ease;
    }

    /* ── HERO TITLE ── */
    .hero-title {
        font-weight: 800;
        font-size: clamp(2rem, 5vw, 3rem);
        color: var(--text-dark);
        letter-spacing: -0.02em;
        line-height: 1.15;
    }

    .hero-sub {
        font-size: 0.95rem;
        color: var(--text-muted);
        font-weight: 400;
    }

    .hero-divider {
        width: 48px;
        height: 3px;
        background: var(--purple);
        border-radius: 2px;
        margin: 0.75rem auto 0;
    }

    /* ── FILTER TABS ── */
    .filter-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .filter-btn {
        border: 1.5px solid var(--border);
        background: #fff;
        color: var(--text-mid);
        border-radius: 50px;
        padding: 0.45rem 1.1rem;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        transition: all var(--transition);
        white-space: nowrap;
    }

    .filter-btn:hover {
        border-color: var(--purple);
        color: var(--purple);
    }

    .filter-btn.active {
        background: var(--purple);
        border-color: var(--purple);
        color: #fff;
        box-shadow: 0 3px 12px rgba(91, 63, 190, 0.30);
    }

    /* ── WORK CARD ── */
    .work-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius-card);
        box-shadow: var(--shadow);
        overflow: hidden;
        transition: all 0.6s ease;
    }

    .work-card:hover {
        box-shadow: var(--shadow-hover);
        transform: translateY(-2px);
        background: linear-gradient(45deg, transparent, color-mix(var(--theme) 20%, transparent));
    }

    .work-card .logo-block img {
        transform: rotate(0deg) scale(1);
        transition: transform 0.4s ease;
        will-change: transform;
    }

    .work-card:hover .logo-block img {
        transform: rotate(1deg) scale(1.02);
    }

    /* LOGO BLOCK */
    .logo-block {
        width: 35%;
        min-width: 120px;
        min-height: 120px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-right: 1px solid var(--border);
        /* padding: 1.25rem 1rem; */
        /* background: #fff; */
    }

    @media (max-width: 575px) {
        .logo-block {
            width: 100%;
            min-width: unset;
            min-height: 100px;
            border-right: none;
            border-bottom: 1px solid var(--border);
            flex-direction: row;
            gap: 1rem;
            padding: 1rem 1.25rem;
        }
    }

    /* BRAND NAME BLOCK */
    .brand-block {
        padding: 1.25rem 1rem 1.25rem 1.5rem;
        border-right: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    @media (max-width: 767px) {
        .brand-block {
            min-width: unset;
            border-right: none;
            border-bottom: 1px solid var(--border);
            padding: 1rem 1.25rem;
        }
    }

    .brand-name {
        font-weight: 700;
        font-size: clamp(1.3rem, 2.5vw, 1.65rem);
        color: var(--text-dark);
        line-height: 1.2;
        margin-bottom: 0.4rem;
    }

    .industry-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--purple);
        background: var(--purple-pale);
        border-radius: 50px;
        padding: 0.25rem 0.65rem;
        width: fit-content;
    }

    /* SERVICE COLUMNS */
    .services-area {
        flex: 1;
        padding: 1.25rem 1rem 1rem 1.25rem;
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .svc-col {
        min-width: 130px;
        flex: 1;
    }

    .svc-col-title {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--purple);
        margin-bottom: 0.5rem;
        letter-spacing: 0.01em;
    }

    .svc-col-title .icon-box {
        width: 26px;
        height: 26px;
        border: 1.5px solid var(--purple-light);
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.65rem;
        color: var(--purple);
    }

    .svc-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .svc-list li {
        font-size: 0.85rem;
        font-family: var(--bs-body-font-family);
        color: var(--text-mid);
        font-weight: 500;
        padding: 0.18rem 0;
        display: flex;
        align-items: baseline;
        gap: 0.4rem;
    }

    .svc-list li::before {
        content: "•";
        color: var(--text-muted);
        font-size: 0.7rem;
        flex-shrink: 0;
    }

    /* VIEW LINK */
    .view-link {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--text-link);
        text-decoration: none;
        white-space: nowrap;
        transition: gap var(--transition);
        padding: 0.75rem 1.25rem 0.75rem 0;
        align-self: flex-end;
    }

    .view-link:hover {
        gap: 0.55rem;
        color: var(--purple-light);
    }

    .view-link-wrap {
        display: flex;
        justify-content: flex-end;
        align-items: flex-end;
        padding: 0 1.25rem 1rem 0;
    }

    /* ── CARD INNER LAYOUT ── */
    .card-inner {
        display: flex;
        align-items: stretch;
    }

    .card-right {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .card-body-row {
        display: flex;
        align-items: stretch;
        flex: 1;
        flex-direction: column;
    }

    @media (max-width: 767px) {
        .card-inner {
            flex-direction: column;
        }

        .card-body-row {
            flex-direction: column;
        }

        .services-area {
            padding: 1rem 1.25rem;
        }

        .view-link-wrap {
            padding: 0 1rem 1rem;
        }
    }

    /* ── FOOTER STATS ── */
    .bottom-stats {
        background: #fff;
        border-top: 1px solid var(--border);
        border-radius: 16px;
        box-shadow: var(--shadow);
    }

    .stat-item {
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
        padding: 1.5rem 1rem;
    }

    .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .stat-icon.purple {
        background: var(--purple-pale);
        color: var(--purple);
    }

    .stat-icon.green {
        background: #ecfdf5;
        color: #059669;
    }

    .stat-icon.orange {
        background: #fff7ed;
        color: #ea580c;
    }

    .stat-icon.blue {
        background: #eff6ff;
        color: #2563eb;
    }

    .stat-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--purple);
        margin-bottom: 0.2rem;
    }

    .stat-desc {
        font-size: 0.75rem;
        color: var(--text-muted);
        line-height: 1.45;
        font-weight: 400;
    }

    /* CARD ENTER ANIMATION */
    .work-card {
        opacity: 0;
        transform: translateY(18px);
        animation: fadeUp 0.5s forwards;
    }

    .work-card:nth-child(1) {
        animation-delay: 0.05s;
    }

    .work-card:nth-child(2) {
        animation-delay: 0.12s;
    }

    .work-card:nth-child(3) {
        animation-delay: 0.19s;
    }

    .work-card:nth-child(4) {
        animation-delay: 0.26s;
    }

    .work-card:nth-child(5) {
        animation-delay: 0.33s;
    }

    .work-card:nth-child(6) {
        animation-delay: 0.40s;
    }

    @keyframes fadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* SVG LOGO HELPERS */
    .logo-svg {
        max-width: 100%;
        height: auto;
    }

    /* Divider line between brand and services */
    @media (min-width: 768px) {
        .card-body-row>.brand-block {
            border-right: 1px solid var(--border);
        }
    }
</style>


<section>

    <div class="container py-5">

        <!-- ── HERO ── -->
        <div class="text-center mb-4">
            <h1 class="hero-title">Our Top Recent Works</h1>
            <p class="hero-sub mt-2">Creative solutions delivered for brands across industries.</p>
            <div class="hero-divider mx-auto"></div>
        </div>

        <!-- ── FILTER TABS ── -->
        <div class="filter-tabs mb-4" role="group" aria-label="Filter works by category">
            <button class="filter-btn active" data-filter="all">All Works</button>
            <button class="filter-btn" data-filter="branding">Branding</button>
            <button class="filter-btn" data-filter="packaging">Packaging</button>
            <button class="filter-btn" data-filter="print">Print Design</button>
            <button class="filter-btn" data-filter="digital">Digital Marketing</button>
            <button class="filter-btn" data-filter="web">Web Design</button>
            <button class="filter-btn" data-filter="corporate">Corporate Communication</button>
        </div>

        <!-- ── WORK CARDS ── -->
        <div class="d-flex flex-column gap-4" id="cards-container">

            <!-- ET TIMES -->
            <article class="work-card" data-categories="branding print corporate">
                <div class="card-inner row">
                    <div class="logo-block pe-lg-0">
                        <img src="assets/img/project/et-project.png" alt="ET TIMES" class="img-fluid">
                    </div>

                    <div class="card-right">
                        <div class="card-body-row">

                            <div class="brand-block">
                                <div class="brand-name">ET TIMES</div>
                                <!-- <span class="industry-tag">
                                    <i class="fa fa-newspaper fa-xs"></i> Media & Publishing
                                </span> -->
                            </div>

                            <div class="services-area pt-0">

                                <div class="svc-col">
                                    <div class="svc-col-title">
                                        <span class="icon-box"><i class="fa fa-layer-group"></i></span>
                                        Branding
                                    </div>
                                    <ul class="svc-list">
                                        <li>Trophy Design</li>
                                    </ul>
                                </div>

                                <div class="svc-col">
                                    <div class="svc-col-title">
                                        <span class="icon-box"><i class="fa fa-print"></i></span>
                                        Print & Corporate
                                    </div>
                                    <ul class="svc-list">
                                        <li>Deck Presentation</li>
                                        <li>Marketing Collateral</li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="view-link-wrap">
                            <a href="#" class="view-link">View Case Study <i class="fa fa-arrow-right fa-xs"></i></a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- SPEDITION -->
            <article class="work-card" data-categories="branding web digital print">
                <div class="card-inner row">
                    <div class="logo-block pe-lg-0">
                        <img src="assets/img/project/spedition-project.png" alt="SPEDITION" class="img-fluid">
                    </div>

                    <div class="card-right">
                        <div class="card-body-row">

                            <div class="brand-block">
                                <div class="brand-name">SPEDITION</div>
                            </div>

                            <div class="services-area pt-0">

                                <div class="svc-col">
                                    <div class="svc-col-title">
                                        <span class="icon-box"><i class="fa fa-print"></i></span>
                                        Print & Corporate
                                    </div>
                                    <ul class="svc-list">
                                        <li>Print Supply</li>
                                        <li>Corporate Gifting</li>
                                        <li>Brochure</li>
                                        <li>Catalogue</li>
                                        <li>Leaflet</li>
                                        <li>Corporate Presentation</li>
                                    </ul>
                                </div>

                                <div class="svc-col">
                                    <div class="svc-col-title">
                                        <span class="icon-box"><i class="fa fa-layer-group"></i></span>
                                        Branding
                                    </div>
                                    <ul class="svc-list">
                                        <li>Logo Design</li>
                                        <li>Brand Identity</li>
                                    </ul>
                                </div>

                                <div class="svc-col">
                                    <div class="svc-col-title">
                                        <span class="icon-box"><i class="fa fa-globe"></i></span>
                                        Web & Digital
                                    </div>
                                    <ul class="svc-list">
                                        <li>Website Designing</li>
                                        <li>Digital Marketing</li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="view-link-wrap">
                            <a href="#" class="view-link">View Case Study <i class="fa fa-arrow-right fa-xs"></i></a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- CARGILL -->
            <article class="work-card" data-categories="packaging branding print digital">
                <div class="card-inner row">

                    <div class="logo-block pe-lg-0">
                        <img src="assets/img/project/cargill-project.png" alt="CARGILL" class="img-fluid">
                    </div>

                    <div class="card-right">
                        <div class="card-body-row">

                            <div class="brand-block">
                                <div class="brand-name">CARGILL AQUA NUTRITION INDIA</div>
                            </div>

                            <div class="services-area pt-0">

                                <div class="svc-col">
                                    <div class="svc-col-title">
                                        <span class="icon-box"><i class="fa fa-print"></i></span>
                                        Print & Branding
                                    </div>
                                    <ul class="svc-list">
                                        <li>Brochure</li>
                                        <li>Catalogue</li>
                                        <li>Leaflet</li>
                                        <li>Banners</li>
                                        <li>Hoardings</li>
                                        <li>Store Branding</li>
                                    </ul>
                                </div>

                                <div class="svc-col">
                                    <div class="svc-col-title">
                                        <span class="icon-box"><i class="fa fa-box"></i></span>
                                        Packaging
                                    </div>
                                    <ul class="svc-list">
                                        <li>Packaging Design</li>
                                    </ul>
                                </div>

                                <div class="svc-col">
                                    <div class="svc-col-title">
                                        <span class="icon-box"><i class="fa fa-share-alt"></i></span>
                                        Digital
                                    </div>
                                    <ul class="svc-list">
                                        <li>Social Media Creatives</li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="view-link-wrap">
                            <a href="#" class="view-link">View Case Study <i class="fa fa-arrow-right fa-xs"></i></a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- IFB AGRO -->
            <article class="work-card" data-categories="packaging marketing">
                <div class="card-inner row">

                    <div class="logo-block pe-lg-0">
                        <img src="assets/img/project/ifb-project.png" alt="IFB AGRO" class="img-fluid">
                    </div>

                    <div class="card-right">
                        <div class="card-body-row">

                            <div class="brand-block">
                                <div class="brand-name">IFB AGRO</div>
                            </div>

                            <div class="services-area pt-0">

                                <div class="svc-col">
                                    <div class="svc-col-title">
                                        <span class="icon-box"><i class="fa fa-box"></i></span>
                                        Packaging
                                    </div>
                                    <ul class="svc-list">
                                        <li>Packaging Design</li>
                                    </ul>
                                </div>

                                <div class="svc-col">
                                    <div class="svc-col-title">
                                        <span class="icon-box"><i class="fa fa-bullhorn"></i></span>
                                        Marketing
                                    </div>
                                    <ul class="svc-list">
                                        <li>Marketing Collateral</li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="view-link-wrap">
                            <a href="#" class="view-link">View Case Study <i class="fa fa-arrow-right fa-xs"></i></a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- VIBEEZZZ -->
            <article class="work-card" data-categories="branding digital print corporate event">
                <div class="card-inner row">
                    <div class="logo-block pe-lg-0">
                        <img src="assets/img/project/vibezzzz-project.png" alt="Vibezzzz Mattress" class="img-fluid">
                    </div>

                    <div class="card-right">
                        <div class="card-body-row">

                            <div class="brand-block">
                                <div class="brand-name">Vibezzzz Mattress</div>
                            </div>

                            <div class="services-area pt-0">

                                <div class="svc-col">
                                    <div class="svc-col-title">
                                        <span class="icon-box"><i class="fa fa-layer-group"></i></span>
                                        Branding & Identity
                                    </div>
                                    <ul class="svc-list">
                                        <li>Brand Identity</li>
                                        <li>Store Interior & Branding</li>
                                        <li>Auto Branding</li>
                                        <li>Bus Branding</li>
                                    </ul>
                                </div>

                                <div class="svc-col">
                                    <div class="svc-col-title">
                                        <span class="icon-box"><i class="fa fa-globe"></i></span>
                                        Digital Marketing
                                    </div>
                                    <ul class="svc-list">
                                        <li>Digital Marketing</li>
                                    </ul>
                                </div>

                                <div class="svc-col">
                                    <div class="svc-col-title">
                                        <span class="icon-box"><i class="fa fa-print"></i></span>
                                        Print & Corporate
                                    </div>
                                    <ul class="svc-list">
                                        <li>Print Supply</li>
                                        <li>Corporate Gifting</li>
                                        <li>Brochure</li>
                                        <li>Catalogue</li>
                                        <li>Leaflet</li>
                                        <li>Corporate Presentation</li>
                                    </ul>
                                </div>

                                <div class="svc-col">
                                    <div class="svc-col-title">
                                        <span class="icon-box"><i class="fa fa-calendar-check"></i></span>
                                        Events
                                    </div>
                                    <ul class="svc-list">
                                        <li>Event Management</li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="view-link-wrap">
                            <a href="#" class="view-link">View Case Study <i class="fa fa-arrow-right fa-xs"></i></a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- SRS INDIA -->
            <article class="work-card" data-categories="branding web digital">
                <div class="card-inner row">
                    <div class="logo-block pe-lg-0">
                        <img src="assets/img/project/srs-project.png" alt="SRS INDIA" class="img-fluid">
                    </div>

                    <div class="card-right">
                        <div class="card-body-row">

                            <div class="brand-block">
                                <div class="brand-name">SRS INDIA</div>
                            </div>

                            <div class="services-area pt-0">

                                <div class="svc-col">
                                    <div class="svc-col-title">
                                        <span class="icon-box"><i class="fa fa-layer-group"></i></span>
                                        Branding
                                    </div>
                                    <ul class="svc-list">
                                        <li>Logo Design</li>
                                        <li>Brand Identity</li>
                                    </ul>
                                </div>

                                <div class="svc-col">
                                    <div class="svc-col-title">
                                        <span class="icon-box"><i class="fa fa-globe"></i></span>
                                        Web & Digital
                                    </div>
                                    <ul class="svc-list">
                                        <li>Website Designing</li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="view-link-wrap">
                            <a href="#" class="view-link">View Case Study <i class="fa fa-arrow-right fa-xs"></i></a>
                        </div>
                    </div>
                </div>
            </article>

        </div>

        <!-- ── BOTTOM STATS ── -->
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

    </div><!-- /container -->
</section>


<script>
    // ── FILTER LOGIC ──
    const filterBtns = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.work-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filter = btn.dataset.filter;

            cards.forEach(card => {
                const cats = card.dataset.categories || '';
                const show = filter === 'all' || cats.includes(filter);

                if (show) {
                    card.style.display = '';
                    card.style.animation = 'none';
                    card.offsetHeight; // reflow
                    card.style.animation = 'fadeUp 0.35s forwards';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>