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

        /* Ensure Buy Now and Description buttons are below on mobile */
        .card .col-md-auto a.btn {
            margin-top: 1rem;
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

        /* Hide image when screen size is small */
        .card .col-md-auto img {
            max-width: 100px;
            max-height: 100px;
        }

        /* Styling for the description box */
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

        <div class="card mb-3 shadow-sm border-bottom border-light" style="border-radius: 0.75rem;">
            <div class="row g-0 align-items-center flex-wrap flex-md-nowrap">

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
                <div class="col p-3 text-center text-md-start">
                    <a href="<?php echo esc_url_raw($item['url']); ?>" target="_blank" rel="nofollow"
                        class="h5 d-block mb-2 text-decoration-none text-dark">
                        <?php echo esc_html(wp_trim_words($item['title'], 7)); ?>
                    </a>
                </div>

                <!-- Buy Button Column -->
                <div class="col-md-auto p-3 text-center">
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
                </div>

            </div>

            <!-- Badge Logic -->
            <?php if ($key === 0): ?>
                <div class="position-absolute top-0 start-0 badge text-white"
                    style="background-color: #007bff; border-radius: 0.75rem 0 0.75rem 0;">
                    🏆 Best Choice
                </div>
            <?php elseif ($key === 1): ?>
                <div class="position-absolute top-0 start-0 badge text-dark"
                    style="background-color: #ffc0cb; border-radius: 0.75rem 0 0.75rem 0;">
                    💎 Value for Money
                </div>
            <?php endif; ?>

            <!-- Toggle Description -->
            <div class="px-3 pb-3">
                <a href="#" class="text-primary toggle-desc" data-toggle-id="desc-<?php echo $key; ?>">More info</a>
                <div id="desc-<?php echo $key; ?>" class="mt-2 d-none description-box text-start"
                    style="padding-left: 1.3em;">
                    <?php
                    $descPoints = array_filter(array_map('trim', explode('.', strip_tags($item['description']))));
                    $icons = ['🟨', '🟦', '🟪'];
                    foreach ($descPoints as $i => $point) {
                        $icon = $i < 3 ? $icons[$i] : '✔️';
                        echo '<div class="mb-1">' . $icon . ' ' . esc_html($point) . '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

    <!-- Last Update Footer -->
    <div class="text-muted small mt-4">
        Prices and availability are subject to change. Last updated: June 11, 2025.
    </div>

</div>

<!-- Toggle Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggles = document.querySelectorAll('.toggle-desc');
        toggles.forEach(function (toggle) {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                const id = this.dataset.toggleId;
                const desc = document.getElementById(id);
                if (desc.classList.contains('d-none')) {
                    desc.classList.remove('d-none');
                    this.textContent = 'Less info';
                } else {
                    desc.classList.add('d-none');
                    this.textContent = 'More info';
                }
            });
        });
    });
</script>