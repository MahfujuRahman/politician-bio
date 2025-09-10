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
            {{-- <li class="nav-item">
                <a class="nav-link" onclick="setActive(this)" href="#">Commercial</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="setActive(this)" href="#">Luxury</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="setActive(this)" href="#">Land </a>
            </li> --}}
        </ul>
    </div>
</div>
@push('js_start')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('/api/v1/gallery-categories?limit=100')
        .then(response => response.json())
        .then(data => {
            // console.log("image data", data.data.data);
            // Filter categories to only include those of type 'image'
            const categories = data?.data?.data || [];
            console.log("categories", categories);
            const image_categories = categories.filter(item => item.type === 'image');
            console.log("image categories", image_categories);
            
            const nav = document.getElementById('gallery_category_nav');
            nav.innerHTML = ''; // Clear existing items
            
            // Add default "All" item
            const allItem = document.createElement('li');
            allItem.className = 'nav-item';
            allItem.innerHTML = `<a class="nav-link active" onclick="setActive(this)" href="#" data-filter="all">All</a>`;
            nav.appendChild(allItem);
            


            // Add dynamic items
            image_categories.forEach(category => {
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


