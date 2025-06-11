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
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
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

    .product-img-wrapper {
        width: 200px;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border-radius: 0.5rem;
        overflow: hidden;
        margin: 0 auto;
    }

    .product-img-wrapper img {
        width: 150px;
        height: 150px;
        object-fit: contain;
        display: block;
        border-radius: 0.4rem;
        box-shadow: none;
        background: transparent;
    }

    .rating-box {
        border: 1px solid #eee;
        padding: 1rem;
        border-radius: 0.5rem;
        text-align: center;
        background-color: rgb(243, 249, 255);
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
    }

    .rating-stars .star.empty {
        color: #e0e0e0;
    }

    .toggle-button {
        cursor: pointer;
        color: #007bff;
        text-decoration: none;
        font-size: 1rem;
        display: inline-block;
        margin-top: 0.5em;
        padding: 0.25rem 0.5rem;
        background-color: rgba(0, 123, 255, 0.1);
        border-radius: 0.25rem;
        transition: color 0.3s ease, background-color 0.3s ease;
    }

    .toggle-button:hover {
        color: #0056b3;
        background-color: rgba(0, 123, 255, 0.2);
    }

    @media (max-width: 767.98px) {
        .value-card .row > div {
            margin-bottom: 1rem;
        }

        .rating-box,
        .middle-section,
        .left-section {
            text-align: center;
        }
    }

    .content-wrapper .product-details {
        display: none;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease, transform 0.5s ease;
    }

    .content-wrapper .product-details.is-visible {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .product-details.text-muted ul li {
        list-style: none !important;
        color: #444;
        position: relative;
        padding-left: 1.3em;
        font-size: 1rem;
        margin-bottom: 0.5em;
        margin-left: 0;
        text-align: left;
        word-break: break-word;
        text-transform: capitalize;
    }

    .product-details.text-muted ul li::before {
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
        vertical-align: top;
    }

    .sub1,
    .product-details.text-muted h3 {
        font-size: 1rem;
        line-height: 1.5rem;
        font-weight: 700;
    }

    .product-details ul li:nth-child(1)::before {
        background-image: url('https://d1ttb1lnpo2lvz.cloudfront.net/b5c10142/img/highlight-img-0.svg');
    }

    .product-details ul li:nth-child(2)::before {
        background-image: url('https://d1ttb1lnpo2lvz.cloudfront.net/b5c10142/img/highlight-img-2.svg');
    }

    .product-details ul li:nth-child(3)::before {
        background-image: url('http://d1ttb1lnpo2lvz.cloudfront.net/b5c10142/img/highlight-img-1.svg');
    }

    .text-blue-700 {
        color: rgba(7, 71, 134, 1);
    }

    .sub2 {
        font-size: 0.875rem;
        line-height: 1.25rem;
    }

    .btn.btn-primary.btn-sm {
        border-radius: 12px;
        font-weight: 600;
        padding-bottom: 0.375rem;
        padding-top: 0.375rem;
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }
</style>

<div class="cegg5-container">
    <?php foreach ($items as $key => $item): ?>
        <div class="value-card">
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
                <div class="col-12 col-md-3 left-section text-center">
                    <a href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="nofollow">
                        <div class="product-img-wrapper">
                            <img src="<?php echo esc_url($item['img']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
                        </div>
                    </a>
                    <?php if (!empty($item['manufacturer'])): ?>
                        <div class="mt-2 fw-semibold text-muted">
                            <?php echo esc_html($item['manufacturer']); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-md-6 middle-section">
                    <div class="fw-bold mb-2 sub1">
                        <a href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="nofollow"
                            class="text-decoration-none text-dark">
                            <?php echo esc_html(wp_trim_words($item['title'], 7, '...')); ?>
                        </a>
                    </div>

                    <?php
                    $description = $item['description'];
                    $product_details = '';
                    if (preg_match('/(<h3>Why We Love It<\/h3>\s*<ul>.*?<\/ul>)/s', $description, $match)) {
                        $product_details .= $match[1];
                    }
                    if (preg_match('/(<h3>Main Highlights<\/h3>\s*<ul>.*?<\/ul>)/s', $description, $match)) {
                        $product_details .= $match[1];
                    }
                    ?>

                    <div class="content-wrapper">
                        <div class="toggle-button">Show more</div>
                        <div class="product-details text-muted">
                            <?php echo wp_kses_post($product_details); ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 text-center">
                    <div class="rating-box mb-3">
                        <?php
                        $ratingDecimal = (isset($item['ratingDecimal']) && $item['ratingDecimal'] !== '' && $item['ratingDecimal'] !== null) ? $item['ratingDecimal'] : 9.5;
                        ?>
                        <div class="fs-4 fw-bold text-success"><?php echo $ratingDecimal ?></div>
                        <div class="text-muted small mb-1 sub2 text-blue-700">Exceptional</div>
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
                    <div class="mb-2 small text-muted">View offer on:</div>
                    <?php if ($logo = TemplateHelper::getMerchantLogoUrl($item, true)): ?>
                        <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr($item['merchant']); ?>"
                            style="max-height: 20px;">
                    <?php endif; ?>
                    <div class="mt-2">
                        <a href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="nofollow"
                            class="btn btn-primary btn-sm">
                            Check Offer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButtons = document.querySelectorAll('.toggle-button');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function () {
                const contentWrapper = this.closest('.content-wrapper');
                const productDetails = contentWrapper.querySelector('.product-details');

                if (productDetails.classList.contains('is-visible')) {
                    // Hide content
                    productDetails.classList.remove('is-visible');
                    setTimeout(() => {
                        productDetails.style.display = 'none';
                        button.textContent = 'Show more';
                    }, 500);
                } else {
                    // Show content
                    productDetails.style.display = 'block';
                    productDetails.offsetHeight; // Force reflow
                    productDetails.classList.add('is-visible');
                    button.textContent = 'Show less';
                }
            });
        });
    });
</script>
