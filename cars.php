<?php
$pageTitle = 'Browse Cars';
require_once 'includes/functions.php';
require_once 'includes/header.php';

// Get filter parameters
$type = isset($_GET['type']) ? $_GET['type'] : '';
$make = isset($_GET['make']) ? $_GET['make'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Get filtered cars
$cars = getCars($type, $make, $search);
$carTypes = getCarTypes();
$carMakes = getCarMakes();
?>

<section class="page-header">
    <div class="container">
        <h1>Browse Our Fleet</h1>
        <p>Find the perfect vehicle for your journey</p>
    </div>
</section>

<section class="cars-section">
    <div class="container">
        <div class="cars-layout">
             Filters Sidebar 
            <aside class="filters-sidebar">
                <div class="filter-card">
                    <h3>Filter Cars</h3>
                    
                    <form action="cars.php" method="GET">
                        <div class="filter-group">
                            <label for="search">Search</label>
                            <input type="text" id="search" name="search" placeholder="Search by make or model..." value="<?php echo htmlspecialchars($search); ?>">
                        </div>
                        
                        <div class="filter-group">
                            <label for="type">Vehicle Type</label>
                            <select name="type" id="type">
                                <option value="">All Types</option>
                                <?php foreach ($carTypes as $t): ?>
                                    <option value="<?php echo htmlspecialchars($t); ?>" <?php echo $type == $t ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($t); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label for="make">Make</label>
                            <select name="make" id="make">
                                <option value="">All Makes</option>
                                <?php foreach ($carMakes as $m): ?>
                                    <option value="<?php echo htmlspecialchars($m); ?>" <?php echo $make == $m ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($m); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">Apply Filters</button>
                        <a href="cars.php" class="btn btn-secondary btn-block">Clear Filters</a>
                    </form>
                </div>
            </aside>
            
             Cars Grid 
            <div class="cars-content">
                <div class="cars-header">
                    <p class="results-count">
                        <?php echo count($cars); ?> vehicle<?php echo count($cars) != 1 ? 's' : ''; ?> found
                    </p>
                </div>
                
                <?php if (count($cars) > 0): ?>
                    <div class="cars-grid">
                        <?php foreach ($cars as $car): ?>
                            <div class="car-card">
                                <div class="car-image">
                                    <img src="images/<?php echo htmlspecialchars($car['image']); ?>" alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?>">
                                    <?php if ($car['is_bestseller']): ?>
                                        <span class="car-badge">Bestseller</span>
                                    <?php endif; ?>
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
                                        <button class="btn btn-secondary">Book Now</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-results">
                        <i class="fas fa-search"></i>
                        <h3>No vehicles found</h3>
                        <p>Try adjusting your filters or search criteria</p>
                        <a href="cars.php" class="btn btn-primary">View All Cars</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>