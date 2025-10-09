<?php
$pageTitle = 'Cars';
require_once __DIR__ . '/WordPress Advanced Final Project/functions.php';
require_once __DIR__ . '/header.php';

$type = $_GET['type'] ?? '';
$make = $_GET['make'] ?? '';
$search = $_GET['search'] ?? '';
$cars = getCars($type, $make, $search);
?>

<section class="page-header">
    <div class="container">
        <h1>Available Cars</h1>
        <p>Browse our selection of vehicles for rent</p>
    </div>
</section>

<section class="cars-list">
    <div class="container">
        <?php if (empty($cars)): ?>
            <p>No cars found matching your criteria.</p>
        <?php else: ?>
            <div class="cars-grid">
                <?php foreach ($cars as $car): ?>
                    <div class="car-card">
                        <div class="car-image">
                            <img src="images/<?php echo htmlspecialchars($car['image']); ?>" alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?>">
                        </div>
                        <div class="car-details">
                            <h3><?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?></h3>
                            <p class="car-type"><i class="fas fa-tag"></i> <?php echo htmlspecialchars($car['type']); ?></p>
                            <p class="car-year"><i class="fas fa-calendar"></i> <?php echo htmlspecialchars($car['year']); ?></p>
                            <div class="car-features">
                                <?php 
                                $features = explode(',', $car['features']);
                                foreach (array_slice($features, 0, 3) as $feature): 
                                ?>
                                    <span class="feature-tag"><?php echo htmlspecialchars(trim($feature)); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <div class="car-footer">
                                <div class="car-price">
                                    <span class="price-amount">$<?php echo number_format($car['price_per_day'], 2); ?></span>
                                    <span class="price-period">/day</span>
                                </div>
                                <a href="cars.php?id=<?php echo $car['id']; ?>" class="btn btn-secondary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>
