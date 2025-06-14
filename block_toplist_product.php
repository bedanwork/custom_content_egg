<?php
/*
 * Name: Value Card Product Layout with Toggle
 * Module Types: PRODUCT
 */

use ContentEgg\application\helpers\TemplateHelper;

\ContentEgg\application\components\BlockTemplateManager::getInstance()->enqueueCeggStyle(true);
?>

<style>
    .cegg5-container {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    /* Merchant Logo Styling */
    .merchant-logo {
        padding: 4px;
        border-radius: 4px;
        background: rgba(255, 255, 255, 0.9);
    }

    /* Product Title Styling */
    .card .product-title {
        font-weight: 700;
        color: rgb(61, 70, 82);
        margin-bottom: 5.1rem !important;
        /* Large margin on desktop */
    }

    /* More Info Button Styling */
    .toggle-desc {
        display: inline-block;
        padding: 8px 16px;
        background-color: #e6f3ff;
        color: #0066cc;
        border-radius: 6px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .toggle-desc:hover {
        background-color: #cce5ff;
        color: #004d99;
    }

    /* Title Column Styling for Flex Layout */
    .title-column {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        align-items: flex-start;
        /* Left-align title and button on desktop */
    }

    /* Badge Styling */
    .badge {
        font-size: 1.1rem;
        /* Larger font size on desktop */
        padding: 0.75rem 1.25rem;
        /* Increased padding for larger appearance */
        line-height: 1.2;
        /* Improved text spacing */
        z-index: 10;
        /* Ensure badge stays above other elements */
        white-space: nowrap;
        /* Prevent text wrapping */
    }

    /* Show more / Show less buttons */
    .show-more,
    .show-less {
        cursor: pointer;
        color: #007bff;
        font-size: 1rem;
        display: inline-block;
        padding: 0.4em 1em;
        border: 1px solid #007bff;
        border-radius: 6px;
        background-color: #e6f0ff;
        transition: all 0.3s ease;
    }

    .show-more:hover,
    .show-less:hover {
        background-color: #cce0ff;
        color: #0056b3;
        border-color: #0056b3;
    }

    /* Media query for screen width less than 760px */
    @media (max-width: 760px) {
        .product-row {
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
        }

        .product-info-rest {
            display: block;
            width: 100%;
        }

        .product-row>.product-column {
            flex: 1 1 0;
        }

        .product-column.rating-col {
            order: 1;
            min-width: 80px;
            max-width: 100px;
        }

        .product-column.image-col {
            order: 2;
        }

        .product-column:not(.rating-col):not(.image-col) {
            order: 3;
        }

        .card {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .card .row {
            flex-direction: column;
            gap: 1rem;
        }

        .card .col {
            text-align: center;
        }

        .card .col-md-auto {
            max-width: 100%;
            text-align: center;
        }

        .card .col-md-auto a.btn {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .card .col p {
            padding-left: 0;
            padding-right: 0;
        }

        .card .position-absolute {
            position: static;
            margin: 0;
            padding: 0;
        }

        /* Override position for badges on mobile */
        .card .badge.position-absolute {
            position: absolute !important;
            top: 0;
            left: 0;
        }

        .card .col-md-auto img {
            max-width: 100px;
            max-height: 100px;
        }

        .description-box {
            padding-left: 1.3em;
            padding-top: 1em;
        }

        .description-toggle {
            text-align: center;
            padding: 1rem;
        }

        .toggle-desc {
            display: inline-block;
            margin-left: auto;
            margin-right: auto;
        }

        /* Center title column on mobile */
        .title-column {
            align-items: center;
        }

        /* Enhanced badge size on mobile */
        /* .card .badge.position-absolute {
            font-size: 0.9rem;
            padding: 0.5rem 1rem !important; */
        /* Use !important to override inline styles */
        /* min-width: 100px;
            text-align: center;
            line-height: 1.2;
            border-radius: 0.5rem 0 0.5rem 0;
        } */

        /* Style show-more-toggle in buy button column on mobile */
        .buy-column .show-more-toggle {
            margin-top: 0.5rem;
            display: flex;
            justify-content: center;
        }

        /* Reset title margin on mobile since show-more is in buy-column */
        .card .title-column .product-title {
            margin-bottom: 0.5rem !important;
            /* Match original mb-2 */
        }
    }

    .btn.btn-primary {
        border-radius: 12px;
        font-weight: 600;
        padding-bottom: 0.375rem;
        padding-top: 0.375rem;
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }

    .px-3.pb-3.text-primary {
        text-align: center;
    }

    /* Animation for show-more-content */
    .show-more-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease;
    }

    .show-more-content.is-visible {
        max-height: 1000px;
        /* Large enough to accommodate content */
    }

    /* Style cho danh sách */
    .text-muted ul li {
        list-style: none !important;
        color: #444;
        position: relative;
        padding-left: 1.5em;
        font-size: 1rem;
        margin-bottom: 0.5em;
        text-align: left;
        word-break: break-word;
        text-transform: capitalize;
    }

    /* Why We Love It List */
    .why-love-list li::before {
        content: "";
        display: inline-block;
        width: 1em;
        height: 1em;
        background-image: url('https://d1ttb1lnpo2lvz.cloudfront.net/b5c10142/img/checked1.svg');
        background-size: contain;
        background-repeat: no-repeat;
        position: absolute;
        left: 0;
        top: 0.3em;
    }

    /* Main Highlights List */
    .highlight-list li::before {
        content: "";
        display: inline-block;
        width: 1em;
        height: 1em;
        background-image: url('https://d1ttb1lnpo2lvz.cloudfront.net/b5c10142/img/checked1.svg');
        background-size: contain;
        background-repeat: no-repeat;
        position: absolute;
        left: 0;
        top: 0.3em;
    }

    .highlight-list li:nth-child(1)::before {
        background-image: url('https://d1ttb1lnpo2lvz.cloudfront.net/b5c10142/img/highlight-img-0.svg');
    }

    .highlight-list li:nth-child(2)::before {
        background-image: url('https://d1ttb1lnpo2lvz.cloudfront.net/b5c10142/img/highlight-img-2.svg');
    }

    .highlight-list li:nth-child(3)::before {
        background-image: url('http://d1ttb1lnpo2lvz.cloudfront.net/b5c10142/img/highlight-img-1.svg');
    }

    /* Styling for h3 in Why We Love It */
    .show-more-content .why-love-heading {
        font-size: 1rem;
        line-height: 1.5rem;
        font-weight: 700;
        color: rgb(33, 41, 49);
    }

    /* Styling for h3 in Main Highlights */
    .show-more-content .highlight-heading {
        font-size: 1rem;
        line-height: 1.5rem;
        font-weight: 700;
        color: rgb(33, 41, 49);
    }
</style>

<div class="cegg5-container">
    <?php foreach ($items as $key => $item): ?>
        <?php
        $rating = floatval($item['rating']);
        $starCount = 5;
        $filledStars = floor($rating / 2);
        $halfStar = ($rating / 2) - $filledStars >= 0.5 ? true : false;
        $emptyStars = $starCount - $filledStars - ($halfStar ? 1 : 0);
        $statusLabel = ($rating >= 9) ? 'Exceptional' : (($rating >= 8) ? 'Very Good' : 'Good');
        ?>

        <div class="card mb-3 shadow-sm border-bottom border-light" style="border-radius: 1rem;">
            <div class="row g-0 align-items-center flex-wrap flex-md-nowrap">

                <!-- Image Column -->
                <div class="col-md-auto text-center p-3" style="max-width: 200px;">
                    <a href="<?php echo esc_url_raw($item['url']); ?>" target="_blank" rel="nofollow">
                        <img src="<?php echo esc_attr($item['img']); ?>" alt="<?php echo esc_attr($item['title']); ?>"
                            class="img-fluid" style="max-height: 200px;" />
                    </a>
                    <?php if (!empty($item['manufacturer'])): ?>
                        <div class="mt-2 small text-muted"><?php echo esc_html($item['manufacturer']); ?></div>
                    <?php endif; ?>
                </div>

                <!-- Title Column -->
                <div class="col p-3 text-center text-md-start title-column">
                    <a href="<?php echo esc_url_raw($item['url']); ?>" target="_blank" rel="nofollow"
                        class="h5 d-block mb-2 text-decoration-none text-dark product-title">
                        <?php echo esc_html(wp_trim_words($item['title'], 7)); ?>
                    </a>
                    <?php
                    $description = $item['description'];
                    $why_love = '';
                    $highlights = '';
                    if (preg_match('/<h3>Why We Love It<\/h3>\s*<ul>(.*?)<\/ul>/s', $description, $match)) {
                        $why_love = '<h3 class="why-love-heading">Why We Love It</h3><ul class="why-love-list">' . $match[1] . '</ul>';
                    }
                    if (preg_match('/<h3>Main Highlights<\/h3>\s*<ul>(.*?)<\/ul>/s', $description, $match)) {
                        $highlights = '<h3 class="highlight-heading">Main Highlights</h3><ul class="highlight-list">' . $match[1] . '</ul>';
                    }
                    if ($why_love || $highlights): ?>
                        <!-- Show more toggle for desktop -->
                        <div class="show-more-toggle d-none d-md-block" data-content-id="content-<?php echo $key; ?>">
                            <div class="show-more">Show more</div>
                            <div class="show-less" style="display: none;">Show less</div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Buy Button Column -->
                <div class="col-md-auto p-3 text-center buy-column">
                    <!-- Rating Column with background color -->
                    <div class="col-md-auto p-3 text-center" style="background-color: #f0f8ff; border-radius: 8px;">
                        <?php
                        $ratingDecimal = (isset($item['ratingDecimal']) && $item['ratingDecimal'] !== '' && $item['ratingDecimal'] !== null) ? $item['ratingDecimal'] : 9.5;
                        ?>
                        <div class="fw-bold fs-4 text-success"><?php echo $ratingDecimal ?></div>
                        <div class="text-muted small mb-1 sub2 text-blue-700"><?php echo esc_html($statusLabel); ?></div>
                        <div class="rating-stars">
                            <?php
                            $rating = floatval($ratingDecimal) / 2;
                            for ($i = 1; $i <= 5; $i++) {
                                if ($rating >= $i) {
                                    echo '<span class="star"><svg width="18" height="18" viewBox="0 0 20 20" style="vertical-align:middle;"><polygon points="10,1 12.59,7.36 19.51,7.36 13.96,11.64 16.55,17.99 10,13.71 3.45,17.99 6.04,11.64 0.49,7.36 7.41,7.36" fill="#FFD700"/></svg></span>';
                                } elseif ($rating >= $i - 0.5) {
                                    echo '<span class="star"><svg width="18" height="18" viewBox="0 0 20 20" style="vertical-align:middle;"><defs><linearGradient id="half"><stop offset="50%" stop-color="#FFD700"/><stop offset="50%" stop-color="#e0e0e0"/></linearGradient></defs><polygon points="10,1 12.59,7.36 19.51,7.36 13.96,11.64 16.55,17.99 10,13.71 3.45,17.99 6.04,11.64 0.49,7.36 7.41,7.36" fill="url(#half)"/></svg></span>';
                                } else {
                                    echo '<span class="star"><svg width="18" height="18" viewBox="0 0 20 20" style="vertical-align:middle;"><polygon points="10,1 12.59,7.36 19.51,7.36 13.96,11.64 16.55,17.99 10,13.71 3.45,17.99 6.04,11.64 0.49,7.36 7.41,7.36" fill="#e0e0e0"/></svg></span>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <!-- Merchant Section -->
                    <div class="col-md-auto p-3 text-center d-flex flex-column align-items-center justify-content-center">
                        <div class="mb-2 small text-muted">View offer on:</div>
                        <?php if ($logo = TemplateHelper::getMerchantLogoUrl($item, true)): ?>
                            <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr($item['merchant']); ?>"
                                class="merchant-logo" style="max-height: 32px; max-width: 150px; object-fit: contain;">
                        <?php endif; ?>
                    </div>
                    <a href="<?php echo esc_url_raw($item['url']); ?>" target="_blank" rel="nofollow"
                        class="btn btn-primary" style="background-color:#007bff;">Check Price</a>
                    <?php if ($why_love || $highlights): ?>
                        <!-- Show more toggle for mobile -->
                        <div class="show-more-toggle d-block d-md-none" data-content-id="content-<?php echo $key; ?>">
                            <div class="show-more">Show more</div>
                            <div class="show-less" style="display: none;">Show less</div>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            <!-- Badge Logic -->
            <?php if ($key === 0): ?>
                <div class="position-absolute top-0 start-0 badge text-white mb-2"
                    style="background-color: #007bff; border-radius: 0.5rem 0 0.5rem 0; padding: <?php echo wp_is_mobile() ? '0.5rem 1rem' : '0.75rem 1.25rem'; ?>;">
                    🏆 Best Choice
                </div>
            <?php elseif ($key == 1): ?>
                <div class="position-absolute top-0 start-0 badge text-dark mb-2"
                    style="background-color: #ffc0cb; border-radius: 0.5rem 0 0.5rem 0; padding: <?php echo wp_is_mobile() ? '0.3rem 1rem' : '0.75rem 1.25rem'; ?>;">
                    💎 Value for Money
                </div>
            <?php endif; ?>

            <!-- Description Content -->
            <div class="px-3 pb-3">
                <?php if ($why_love || $highlights): ?>
                    <div class="content-wrapper">
                   
                   
                   
                   
                    <div class="show-more-content text-muted" id="content-<?php echo $key; ?>">
                            <?php echo wp_kses_post($why_love . $highlights); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>

    <?php endforeach; ?>

    <!-- Last Update Footer -->
    <div class="text-muted small mt-4">
        Prices and availability are subject to change. Last updated: <?php echo date('Y-m-d'); ?>.
    </div>

</div>

<!-- Toggle Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.show-more-toggle').forEach(toggle => {
            const showMoreBtn = toggle.querySelector('.show-more');
            const showLessBtn = toggle.querySelector('.show-less');
            const contentId = toggle.getAttribute('data-content-id');
            const moreContent = document.getElementById(contentId);

            if (showMoreBtn && showLessBtn && moreContent) {
                showMoreBtn.addEventListener('click', function () {
                    moreContent.classList.add('is-visible');
                    showMoreBtn.style.display = 'none';
                    showLessBtn.style.display = 'inline-block';
                });

                showLessBtn.addEventListener('click', function () {
                    moreContent.classList.remove('is-visible');
                    showLessBtn.style.display = 'none';
                    showMoreBtn.style.display = 'inline-block';
                });
            }
        });
    });
</script>