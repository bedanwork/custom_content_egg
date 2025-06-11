<?php
/*
 * Name: Value Card Layout
 * Module Types: PRODUCT
 */

use ContentEgg\application\helpers\TemplateHelper;

\ContentEgg\application\components\BlockTemplateManager::getInstance()->enqueueCeggStyle(true);
?>

<style>
    .value-card {
        background: #fff;
        border-radius: 0.75rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;

    }

    .value-badge {
        position: absolute;
        top: 0;
        left: 0;
        background: #ffc0cb;
        color: #fff;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        border-bottom-right-radius: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .value-badge i {
        font-style: normal;
        font-size: 0.85rem;
    }

    .rating-box {
        border: 1px solid #eee;
        padding: 1rem;
        border-radius: 0.5rem;
        text-align: center;
        --tw-bg-opacity: 1;
        background-color: rgb(243, 249, 255, var(--tw-bg-opacity, 1));
    }

    .rating-stars i {
        color: #f8d23c;
        font-style: normal;
    }

    .rating-stars {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.1em;
        font-size: 1.25rem;
        letter-spacing: 0.1em;
    }

    .rating-stars .star {
        color: #ffd700;
        /* yellow */
    }

    .rating-stars .star.empty {
        color: #e0e0e0;
        /* light gray for empty stars */
    }

    .show-more,
    .show-less {
        cursor: pointer;
        color: #007bff;
        text-decoration: underline;
        font-size: 0.875rem;
    }

    .show-more-content {
        display: none;
        /* opacity: 1; */
        /* transform: translateY(10px); */
        /* transition: opacity 0.3s ease, transform 0.3s ease; */
    }

    /* .show-more-content.is-visible {
        display: block;
        opacity: 1;
        transform: translateY(0);
    } */

    @media (max-width: 767.98px) {
        .value-card .row>div {
            margin-bottom: 1rem;
        }

        .rating-box,
        .middle-section,
        .left-section {
            text-align: center;
        }
    }

    /* Custom the title product and title description  */
    .initial-content h3 {
        color: rgb(44, 56, 74, var(--tw-text-opacity, 1));
        padding-left: 0;
        margin-left: 0;
        border: none green;
        /* Remove the green border */
        line-height: 1.5rem;
    }

    /* .initial-content ul li {
        padding-left: 5em;
        /* Controls space between tick icon and text 
    } 
     */

    /* Only affect the Why We Love It bullets */
    .initial-content ul {
        list-style: none;
        padding-left: 0;
        margin-left: 0;
        color: #444;
        font-size: 1rem;
        margin-bottom: 0.25em;
        text-transform: capitalize;
    }

    .initial-content ul li {
        position: relative;
        padding-left: 1.3em;
        /* Giảm nữa nếu muốn sát hơn */
        margin-bottom: 0.5em;
        text-align: left;
        /* Đảm bảo text luôn căn trái */
        word-break: break-word;
        /* Nếu text dài sẽ tự xuống dòng */
    }

    .initial-content ul li::before {
        content: "";
        display: inline-block;
        width: 1em;
        height: 1em;
        background-image: url('https://d1ttb1lnpo2lvz.cloudfront.net/b5c10142/img/checked1.svg');
        background-size: contain;
        background-repeat: no-repeat;
        position: absolute;
        left: 0;
        top: 0.2em;
        vertical-align: top;
    }

    .sub1,
    .initial-content h3,
    .show-more-content h3 {
        font-size: 1rem;
        line-height: 1.5rem;
        font-weight: 700;
    }

    .show-more-content li {
        color: #444;
        font-size: 1rem;
        margin-bottom: 0.25em;
        /* Giảm nữa nếu muốn sát hơn */
        margin-bottom: 0.5em;
        text-align: left;
        /* Đảm bảo text luôn căn trái */
        word-break: break-word;
        /* Nếu text dài sẽ tự xuống dòng */
    }

    .show-more-content li {
        --tw-text-opacity: 1;
        color: rgb(75, 86, 101, var(--tw-text-opacity, 1));
    }

    .initial-content strong,
    .show-more-content strong {
        font-weight: 500;
        /* or 900 for maximum boldness */
        color: #222;
        /* Optional: make it a bit darker */
    }

    /* Chỉ áp dụng cho 3 bullet đầu của Main Highlights */
    .show-more-content ul li:nth-child(1)::before {
        background-image: url('https://d1ttb1lnpo2lvz.cloudfront.net/b5c10142/img/highlight-img-0.svg');
    }

    .show-more-content ul li:nth-child(2)::before {
        background-image: url('https://d1ttb1lnpo2lvz.cloudfront.net/b5c10142/img/highlight-img-2.svg');
    }

    .show-more-content ul li:nth-child(3)::before {
        background-image: url('http://d1ttb1lnpo2lvz.cloudfront.net/b5c10142/img/highlight-img-1.svg');
    }

    /* Đảm bảo các bullet Main Highlights có style giống Why We Love It */
    .show-more-content ul {
        list-style: none;
        padding-left: 0;
        margin-left: 0;
    }

    .show-more-content ul li {
        position: relative;
        padding-left: 1.7em;
        margin-bottom: 0.5em;
        text-align: left;
        word-break: break-word;
    }

    .show-more-content ul li::before {
        content: "";
        display: inline-block;
        width: 1.2em;
        height: 1.2em;
        background-size: contain;
        background-repeat: no-repeat;
        position: absolute;
        left: 0;
        top: 0.15em;
        vertical-align: top;
    }

    .text-blue-700 {
        color: rgba(7, 71, 134, 1);
    }

    .sub2 {
        font-size: 0.875rem;
        line-height: 1.25rem;
    }
</style>

<div class="cegg5-container">
    <?php foreach ($items as $key => $item): ?>
        <!-- Each value card is a div for a product -->
        <div class="value-card">
            <!-- Top Badge -->
            <?php if ($key == 0): ?>
                <div class="value-badge" style="background: #007bff;">
                    <i>🏆</i> Best Choice
                </div>
            <?php elseif ($key == 1): ?>
                <div class="value-badge">
                    <i>💎</i> Value for Money
                </div>
            <?php endif; ?>

            <div class="row align-items-center">

                <!-- Left Section -->
                <div class="col-12 col-md-3 left-section text-center">
                    <a href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="nofollow">
                        <img src="<?php echo esc_url($item['img']); ?>" alt="<?php echo esc_attr($item['title']); ?>"
                            style="max-width: 100%; max-height: 130px; object-fit: contain;">
                    </a>
                    <?php if (!empty($item['manufacturer'])): ?>
                        <div class="mt-2 fw-semibold text-muted">
                            <?php echo esc_html($item['manufacturer']); ?>`
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Middle Section -->
                <div class="col-12 col-md-6 middle-section">
                    <div class="fw-bold mb-2 sub1">
                        <a href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="nofollow"
                            class="text-decoration-none text-dark">
                            <?php echo esc_html(wp_trim_words($item['title'], 7, '...')); ?>
                        </a>
                    </div>

                    <?php
                    // Split the description into initial and more content
                    $description = $item['description'];
                    $initial_content = '';
                    $more_content = '';
                    if (preg_match('/(<h3>Why We Love It<\/h3>\s*<ul>.*?<\/ul>)/s', $description, $match)) {
                        $initial_content = $match[1];
                    }
                    if (preg_match('/(<h3>Main Highlights<\/h3>\s*<ul>.*?<\/ul>)/s', $description, $match)) {
                        $more_content = $match[1];
                    }
                    ?>

                    <div class="initial-content text-muted">
                        <?php echo wp_kses_post($initial_content); ?>
                    </div>
                    <?php if ($more_content): ?>
                        <div class="show-more"
                            onclick="this.nextElementSibling.style.display='block'; this.style.display='none';">Show more</div>
                        <div class="show-more-content text-muted">
                            <?php echo wp_kses_post($more_content); ?>
                            <div class="show-less"
                                onclick="this.parentElement.style.display='none'; this.parentElement.previousElementSibling.style.display='block'; this.parentElement.previousElementSibling.previousElementSibling.style.display='block';">
                                Show less</div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right Section -->
                <div class="col-12 col-md-3 text-center">
                    <div class="rating-box mb-3">
                        <?php
                        $ratingDecimal = (isset($item['ratingDecimal']) && $item['ratingDecimal'] !== '' && $item['ratingDecimal'] !== null) ? $item['ratingDecimal'] : 9.5; ?>
                        <div class="fs-4 fw-bold text-success"> <?php echo $ratingDecimal ?> </div>
                        <div class="text-muted small mb-1 sub2 text-blue-700">Exceptional</div>

                        <div class="rating-stars">
                            <?php
                            // Chuyển đổi điểm 10 về thang 5 sao
                            $rating = floatval($ratingDecimal) / 2;
                            for ($i = 1; $i <= 5; $i++) {
                                if ($rating >= $i) {
                                    // Full star SVG
                                    echo '<span class="star"><svg width="18" height="18" viewBox="0 0 20 20" style="vertical-align:middle;"><polygon points="10,1 12.59,7.36 19.51,7.36 13.96,11.64 16.55,17.99 10,13.71 3.45,17.99 6.04,11.64 0.49,7.36 7.41,7.36" fill="#FFD700"/></svg></span>';
                                } elseif ($rating >= $i - 0.5) {
                                    // Half star SVG
                                    echo '<span class="star"><svg width="18" height="18" viewBox="0 0 20 20" style="vertical-align:middle;"><defs><linearGradient id="half"><stop offset="50%" stop-color="#FFD700"/><stop offset="50%" stop-color="#e0e0e0"/></linearGradient></defs><polygon points="10,1 12.59,7.36 19.51,7.36 13.96,11.64 16.55,17.99 10,13.71 3.45,17.99 6.04,11.64 0.49,7.36 7.41,7.36" fill="url(#half)"/></svg></span>';
                                } else {
                                    // Empty star SVG
                                    echo '<span class="star"><svg width="18" height="18" viewBox="0 0 20 20" style="vertical-align:middle;"><polygon points="10,1 12.59,7.36 19.51,7.36 13.96,11.64 16.55,17.99 10,13.71 3.45,17.99 6.04,11.64 0.49,7.36 7.41,7.36" fill="#e0e0e0"/></svg></span>';
                                }
                            }
                            ?>
                        </div>

                    </div>
                    <div class="mb-2 small text-muted">View offer on:</div>
                    <?php if ($logo = TemplateHelper::getMerchantLogoUrl($item, true)): ?>
                        <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr($item['merchant']); ?>"
                            style="max-height: 20px;">
                    <?php endif; ?>
                    <div class="mt-2">
                        <a href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="nofollow"
                            class="btn btn-primary btn-sm rounded-pill">
                            Check Offer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>