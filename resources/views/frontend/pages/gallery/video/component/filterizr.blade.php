{{-- <div class="row">
    <div class="col-lg-12 pb-10">
        <button class="filter-btn" data-filter="all">All</button>
        <button class="filter-btn" data-filter="1">Category 1</button>
        <button class="filter-btn" data-filter="2">Category 2</button>
        <button class="filter-btn" data-filter="3">Category 3</button>
        <button class="filter-btn" data-filter="4">Category 4</button>
    </div>
</div> --}}

<div class="mb-25">
    <!-- Navigation Bar -->
    <div class="filterizer-font-size">
        <ul class="nav" id="gallery_category_nav">
            <li class="nav-item">
                <a class="nav-link" onclick="setActive(this)" href="#" data-filter="all">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="setActive(this)" href="#" data-filter="residential">Residential</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="setActive(this)" href="#">Commercial</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="setActive(this)" href="#">Luxury</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="setActive(this)" href="#">Land </a>
            </li>
        </ul>
    </div>
</div>
@push('js_start')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('/api/v1/gallery-categories')
        .then(response => response.json())
        .then(data => {
            // console.log("video data", data.data.data);
            // Filter categories to only include those of type 'video'
            const categories = data?.data?.data || [];
            const video_categories = categories.filter(item => item.type === 'video');
            console.log("video categories", video_categories);
            
            const nav = document.getElementById('gallery_category_nav');
            nav.innerHTML = ''; // Clear existing items
            
            // Add default "All" item
            const allItem = document.createElement('li');
            allItem.className = 'nav-item';
            allItem.innerHTML = `<a class="nav-link active" onclick="setActive(this)" href="#" data-filter="all">All</a>`;
            nav.appendChild(allItem);
            


            // Add dynamic items
            video_categories.forEach(category => {
                const li = document.createElement('li');
                li.className = 'nav-item';
                li.innerHTML = `
                    <a class="nav-link" onclick="setActive(this)" href="#all_images" data-filter="${category.name}">
                        ${category.name}
                    </a>`;
                nav.appendChild(li);
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    });
</script>
@endpush




