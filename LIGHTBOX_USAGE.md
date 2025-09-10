# Lightbox Mixin Usage Guide

## Quick Setup

1. **Import the mixin** in your component:

```javascript
import { lightboxMixin } from "@/mixins/lightboxMixin.js";
```

2. **Add to mixins array**:

```javascript
export default {
  mixins: [lightboxMixin],
  // ... your component code
};
```

3. **Initialize in mounted/updated**:

```javascript
mounted() {
  this.initLightbox('.your-selector');
},
updated() {
  this.initLightbox('.your-selector');
}
```

## Available Methods

### `initLightbox(selector, options)`

For single images with 3-step zoom functionality.

**Parameters:**

- `selector` (string): CSS selector for your lightbox links (default: '.lightbox')
- `options` (object): Custom Magnific Popup options (optional)

**Example:**

```javascript
// Basic usage
this.initLightbox(".my-images");

// With custom options
this.initLightbox(".my-images", {
  image: {
    titleSrc: function () {
      return "Custom title";
    },
  },
});
```

### `initGalleryLightbox(selector, options)`

For image galleries with navigation between images.

**Example:**

```javascript
this.initGalleryLightbox(".gallery-images");
```

## HTML Structure

### Single Image

```html
<a href="/path/to/full-image.jpg" class="my-lightbox">
  <img src="/path/to/thumbnail.jpg" alt="Description" />
</a>
```

### Gallery

```html
<a href="/path/to/image1.jpg" class="gallery-lightbox">
  <img src="/path/to/thumb1.jpg" alt="Image 1" />
</a>
<a href="/path/to/image2.jpg" class="gallery-lightbox">
  <img src="/path/to/thumb2.jpg" alt="Image 2" />
</a>
```

### Dynamic Images

```html
<a
  v-for="(image, index) in images"
  :key="index"
  :href="image.full"
  class="dynamic-lightbox"
>
  <img :src="image.thumb" :alt="image.alt" />
</a>
```

## Zoom Functionality

The mixin provides **3-step zoom**:

1. **First click**: 2x zoom
2. **Second click**: 3x zoom
3. **Third click**: Reset to original size

## CSS Requirements

Make sure the CSS file `/public/frontend/assets/css/magnific-popup.css` includes the zoom styles:

```css
.mfp-img.zoom-2x {
  transform: scale(2);
}
.mfp-img.zoom-3x {
  transform: scale(3);
}
```

## Example Component

```vue
<template>
  <div>
    <a href="/uploads/image.jpg" class="my-lightbox">
      <img src="/uploads/thumb.jpg" alt="Example" />
    </a>
  </div>
</template>

<script>
import { lightboxMixin } from "@/mixins/lightboxMixin.js";

export default {
  mixins: [lightboxMixin],
  mounted() {
    this.initLightbox(".my-lightbox");
  },
  updated() {
    this.initLightbox(".my-lightbox");
  },
};
</script>
```

## Advanced Usage

### Custom Options

```javascript
this.initLightbox(".custom-lightbox", {
  image: {
    titleSrc: function (item) {
      return "Custom zoom instructions";
    },
  },
  zoom: {
    duration: 500, // Slower animation
  },
});
```

### Multiple Selectors

```javascript
mounted() {
  this.initLightbox('.team-images');
  this.initLightbox('.product-images');
  this.initGalleryLightbox('.photo-gallery');
}
```

That's it! The mixin handles all the zoom functionality, centering, and transitions automatically.
