/**
 * Utility functions for handling image URLs safely
 */

/**
 * Get safe image URL with fallback
 * @param {string|null|undefined} imageUrl - The image URL to check
 * @param {string} fallback - The fallback image URL (default: '/uploads/default.jpg')
 * @returns {string} - Safe image URL
 */
export function getSafeImageUrl(imageUrl, fallback = '/uploads/default.jpg') {
  if (!imageUrl || imageUrl === 'null' || imageUrl === 'undefined') {
    return fallback;
  }
  
  // If imageUrl already starts with /, return as is
  if (imageUrl.startsWith('/')) {
    return imageUrl;
  }
  
  // If imageUrl is a full URL (http/https), return as is
  if (imageUrl.startsWith('http://') || imageUrl.startsWith('https://')) {
    return imageUrl;
  }
  
  // Otherwise, prepend with /
  return `/${imageUrl}`;
}

/**
 * Get safe background image CSS property
 * @param {string|null|undefined} imageUrl - The image URL
 * @param {string} fallback - The fallback image URL
 * @returns {string} - CSS background-image property value
 */
export function getSafeBackgroundImage(imageUrl, fallback = '/uploads/default.jpg') {
  const safeUrl = getSafeImageUrl(imageUrl, fallback);
  return `url(/${safeUrl})`;
}

/**
 * Vue mixin for safe image handling
 */
export const ImageUtilsMixin = {
  methods: {
    getSafeImageUrl,
    getSafeBackgroundImage
  }
};
