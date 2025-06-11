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

    /* Media query for screen width less than 760px */
    @media (max-width: 760px) {
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

        .toggle-desc {
            font-size: 1rem;
        }
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

                <!-- Rating Column -->
                <div class="col-md-auto p-3 text-center">
                    <div class="fw-bold fs-4 text-warning"><?php echo number_format($rating, 1); ?></div>
                    <div class="mb-1">
                        <?php for ($i = 0; $i < $filledStars; $i++)
                            echo '<i class="bi bi-star-fill text-warning"></i>'; ?>
                        <?php if ($halfStar)
                            echo '<i class="bi bi-star-half text-warning"></i>'; ?>
                        <?php for ($i = 0; $i < $emptyStars; $i++)
                            echo '<i class="bi bi-star text-secondary"></i>'; ?>
                    </div>
                    <div class="small text-muted"><?php echo esc_html($statusLabel); ?></div>

                    <!-- Merchant Logo -->
                    <?php if (!empty($item['domain'])): ?>
                        <div class="mt-2 d-none d-md-block">
                            <img src="<?php echo esc_attr(TemplateHelper::getMerchantIconUrl($item, true)); ?>"
                                alt="<?php echo esc_attr($item['domain']); ?>" style="max-height: 20px;" />
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Buy Button Column -->
                <div class="col-md-auto p-3 text-center">
                    <a href="<?php echo esc_url_raw($item['url']); ?>" target="_blank" rel="nofollow"
                        class="btn btn-primary" style="background-color:#007bff;">Buy Now</a>
                    <div class="text-muted small mt-2"><?php echo esc_html($item['domain']); ?></div>
                </div>

            </div>

            <!-- Badge Logic -->
            <?php if ($key === 0): ?>
                <div class="position-absolute top-0 start-0 m-2 badge text-white" style="background-color: #007bff;">
                    🏆 Best Choice
                </div>
            <?php elseif ($key === 1): ?>
                <div class="position-absolute top-0 start-0 m-2 badge text-dark" style="background-color: #ffc0cb;">
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
