<?php
$pageTitle = 'Best Sellers';
require_once 'includes/functions.php';
require_once 'includes/header.php';

$bestsellerCars = getBestsellerCars();
?>

<section class="page-header">
    <div class="container">
        <h1>Best Sellers</h1>
        <p>Our most popular and highly-rated vehicles</p>
    </div>
</section>

<section class="bestsellers-section">
    <div class="container">
        <?php if (count($bestsellerCars) > 0): ?>
            <div class="cars-grid">
                <?php foreach ($bestsellerCars as $car): ?>
                    <div class="car-card">
                        <div class="car-image">
                            <img src="images/<?php echo htmlspecialchars($car['image']); ?>" alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?>">
                            <span class="car-badge bestseller">⭐ Bestseller</span>
                        </div>
                        <div class="car-details">
                            <h3><?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?></h3>
                            <p class="car-type"><i class="fas fa-tag"></i> <?php echo htmlspecialchars($car['type']); ?></p>
                            <p class="car-year"><i class="fas fa-calendar"></i> <?php echo htmlspecialchars($car['year']); ?></p>
                            <div class="car-features">
                                <?php 
                                $features = explode(',', $car['features']);
                                foreach ($features as $feature): 
                                ?>
                                    <span class="feature-tag"><?php echo htmlspecialchars(trim($feature)); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <div class="car-footer">
                                <div class="car-price">
                                    <span class="price-amount">$<?php echo number_format($car['price_per_day'], 2); ?></span>
                                    <span class="price-period">/day</span>
                                </div>
                                <button class="btn btn-secondary">Book Now</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-results">
                <i class="fas fa-star"></i>
                <h3>No bestsellers available</h3>
                <p>Check back soon for our most popular vehicles</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>