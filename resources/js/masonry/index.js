import $ from 'jquery';
import Masonry from 'masonry-layout';

export default (function () {
  window.addEventListener('load', () => {
    if ($('.masonry').length > 0) {
      return new Masonry('.masonry', {
          itemSelector: '.masonry-item',
          columnWidth: '.masonry-sizer',
          percentPosition: true,
        });
      }
  });
}());
