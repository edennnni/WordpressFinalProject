<?php


$pageTitle = 'Home';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/header.php';
$carTypes = getCarTypes();
$carMakes = getCarMakes();
$featuredCars = getBestsellerCars();
?>

 Hero Section 
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Find Your Perfect Ride</h1>
            <p class="hero-subtitle">Discover the best car rental deals with our wide selection of vehicles</p>
            
            <form action="cars.php" method="GET" class="search-form">
                <div class="form-group">
                    <label for="type"><i class="fas fa-car"></i> Vehicle Type</label>
                    <select name="type" id="type">
                        <option value="">All Types</option>
                        <?php foreach ($carTypes as $type): ?>
                            <option value="<?php echo htmlspecialchars($type); ?>"><?php echo htmlspecialchars($type); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="make"><i class="fas fa-tag"></i> Make</label>
                    <select name="make" id="make">
                        <option value="">All Makes</option>
                        <?php foreach ($carMakes as $make): ?>
                            <option value="<?php echo htmlspecialchars($make); ?>"><?php echo htmlspecialchars($make); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search Cars
                </button>
            </form>
        </div>
    </div>
</section>

<section class="features">
    <div class="container">
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Trusted & Safe</h3>
                <p>All our vehicles are regularly maintained and fully insured for your safety</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <h3>Best Prices</h3>
                <p>Competitive rates with no hidden fees. Get the best value for your money</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3>24/7 Support</h3>
                <p>Our customer service team is always ready to assist you anytime</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3>Multiple Locations</h3>
                <p>Pick up and drop off at convenient locations across the country</p>
            </div>
        </div>
    </div>
</section>

<section class="categories">
    <div class="container">
        <h2 class="section-title">Browse by Category</h2>
        <p class="section-subtitle">Choose from our diverse fleet of vehicles</p>
        
        <div class="categories-grid">
            <a href="cars.php?type=Sedan" class="category-card">
                <i class="fas fa-car"></i>
                <h3>Sedans</h3>
                <p>Comfortable & Efficient</p>
            </a>
            
            <a href="cars.php?type=SUV" class="category-card">
                <i class="fas fa-truck"></i>
                <h3>SUVs</h3>
                <p>Spacious & Powerful</p>
            </a>
            
            <a href="cars.php?type=Truck" class="category-card">
                <i class="fas fa-truck-pickup"></i>
                <h3>Trucks</h3>
                <p>Heavy Duty & Reliable</p>
            </a>
            
            <a href="cars.php?type=Electric" class="category-card">
                <i class="fas fa-charging-station"></i>
                <h3>Electric</h3>
                <p>Eco-Friendly & Modern</p>
            </a>
        </div>
    </div>
</section>

<section class="featured-cars">
    <div class="container">
        <h2 class="section-title">Featured Vehicles</h2>
        <p class="section-subtitle">Check out our most popular rentals</p>
        
        <div class="cars-grid">
            <?php foreach ($featuredCars as $car): ?>
                <div class="car-card">
                    <div class="car-image">
                        <img src="images/<?php echo htmlspecialchars($car['image']); ?>" alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?>">
                        <span class="car-badge">Featured</span>
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
        
        <div class="text-center" style="margin-top: 2rem;">
            <a href="cars.php" class="btn btn-primary">View All Cars</a>
        </div>
    </div>
</section>

 Brands Section 
<section class="brands">
    <div class="container">
        <h2 class="section-title">Trusted Brands</h2>
        <p class="section-subtitle">We partner with the world's leading automotive brands</p>
        
        <div class="brands-grid">
            <div class="brand-logo">Toyota</div>
            <div class="brand-logo">Honda</div>
            <div class="brand-logo">Ford</div>
            <div class="brand-logo">Chevrolet</div>
            <div class="brand-logo">Tesla</div>
            <div class="brand-logo">BMW</div>
        </div>
    </div>
</section>

 CTA Section 
<section class="cta">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Hit the Road?</h2>
            <p>Book your perfect vehicle today and enjoy the freedom of the open road</p>
            <a href="cars.php" class="btn btn-light">Browse Our Fleet</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/footer.php'; ?> 