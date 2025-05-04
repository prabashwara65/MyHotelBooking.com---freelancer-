<!-- Filters Section -->
<section class="filters">
    <div class="filter-grid">
        <div class="filter-group">
            <h3>Price Range</h3>
            <div class="filter-options">
                <button class="filter-btn" onclick="applyFilter('price_range', '0-100')">AED 0 - AED 100</button>
                <button class="filter-btn" onclick="applyFilter('price_range', '100-200')">AED 100 - AED 200</button>
                <button class="filter-btn" onclick="applyFilter('price_range', '200-300')">AED 200 - AED 300</button>
                <button class="filter-btn" onclick="applyFilter('price_range', '300+')">AED 300+</button>
            </div>
        </div>

        <div class="filter-group">
            <h3>Rating</h3>
            <div class="filter-options">
                <button class="filter-btn" onclick="applyFilter('rating', '3')">3★+</button>
                <button class="filter-btn" onclick="applyFilter('rating', '4')">4★+</button>
                <button class="filter-btn" onclick="applyFilter('rating', '5')">5★</button>
            </div>
        </div>

        <div class="filter-group">
            <h3>Amenities</h3>
            <div class="filter-options">
                <button class="filter-btn" onclick="applyFilter('amenities', 'wifi')">WiFi</button>
                <button class="filter-btn" onclick="applyFilter('amenities', 'pool')">Pool</button>
                <button class="filter-btn" onclick="applyFilter('amenities', 'restaurant')">Restaurant</button>
                <button class="filter-btn" onclick="applyFilter('amenities', 'spa')">Spa</button>
            </div>
        </div>

        <div class="filter-group">
            <h3>Eco-Friendly</h3>
            <div class="filter-options">
                <button class="filter-btn" onclick="applyFilter('eco_friendly', 'true')">Sustainable</button>
                <button class="reset-btn" onclick="resetFilters()">Reset All</button>
            </div>
        </div>
    </div>
</section>

<!-- Hotel List Section -->
<div id="hotel-list" class="hotel-list">
</div>

<script>
let filters = {
    price_range: '',
    rating: '',
    amenities: '',
    eco_friendly: ''
};

function applyFilter(filterName, filterValue) {
    filters[filterName] = filterValue;

    fetchHotels();
}

function resetFilters() {

    // Reset the filters 
    filters = {
        price_range: '',
        rating: '',
        amenities: '',
        eco_friendly: ''
    };

    // Clear the filter selections
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.classList.remove('active');
    });

    fetchHotels();
}

function fetchHotels() {
    const queryParams = new URLSearchParams(filters).toString();

    fetch(`/myhotelbooking.com/hotels/hotels.php?${queryParams}`)
        .then(response => response.json())  
        .then(data => {
            displayHotels(data);
        })
        .catch(error => {
            console.error('Error fetching hotels:', error);
        });
}

function displayHotels(hotels) {
    const hotelListContainer = document.getElementById('hotel-list');
    hotelListContainer.innerHTML = '';  

    if (hotels.length === 0) {
        hotelListContainer.innerHTML = '<p>No hotels found for the selected filters.</p>';
        return;
    }

    hotels.forEach(hotel => {
        const hotelItem = document.createElement('div');
        hotelItem.classList.add('hotel-item');
        hotelItem.innerHTML = `
            <h3>${hotel.name}</h3>
            <p>Price: AED ${hotel.price}</p>
            <p>Rating: ${hotel.rating}★</p>
            <p>Amenities: ${hotel.amenities}</p>
            <p>Eco-Friendly: ${hotel.eco_friendly ? 'Yes' : 'No'}</p>
        `;
        hotelListContainer.appendChild(hotelItem);
    });
}

fetchHotels();
</script>
