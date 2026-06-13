jQuery(document).ready(function($) {

    // Adds a search icon.
    $('.search-form input[type="submit"]').replaceWith('<button type="submit" class="search-submit" value="Search"><svg id="icon-search" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><path d="M21 21l-4.35-4.35"></path></svg></button>');

    // Sets scroll to top.
    var scroll    = $(window).scrollTop();  
    var scrollup  = $('.to-top');  

    $(window).scroll(function() {
        if ($(this).scrollTop() > 1) {
            scrollup.css({bottom:"25px"});
        } 
        else {
            scrollup.css({bottom:"-100px"});
        }
    });

    scrollup.click(function() {
        $('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });
    
});

jQuery(document).ready(function() {
  jQuery(".homepage-temp h2").each(function() {
    var t = jQuery(this).text();
    var splitT = t.split(" ");
    var totalWords = splitT.length;

    // If there are fewer than 2 words, do nothing
    if (totalWords < 2) return;

    // Calculate the index of the first word to style
    var startIndex = totalWords - 2;

    var newText = "";
    // Iterate over the words
    for (var i = 0; i < splitT.length; i++) {
      if (i === startIndex) {
        newText += "<span style='color: #fff; background: #EA996B; padding: 8px 30px; border-radius: 50px;'>";
      }

      // Add the current word
      newText += splitT[i] + " ";

      if (i === totalWords - 1) {
        newText += "</span>";
      }
    }

    jQuery(this).html(newText.trim()); // Use trim to remove any trailing space
  });
});

// Slider
jQuery(document).ready(function($) {

    // Homepage Slider
    jQuery('.homepage-temp .owl-carousel').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        navText: [
            "<i class='bi bi-chevron-left'></i>", 
            "<i class='bi bi-chevron-right'></i>"
        ],
        dots: true,
        rtl: false,
        items: 1,
        autoplay: false,
        dotsData: false,
        onInitialized: function(event) {
            // Add numbered dots and hide inactive ones
            var dots = $('.homepage-temp .owl-carousel .owl-dot');
            dots.each(function(index) {
                var number = (index + 1).toString().padStart(2, '0');
                $(this).html('<p>' + number + '</p>');
            });
            // Hide all dots except active
            dots.not('.active').hide();
        },
        onRefreshed: function(event) {
            // Re-add numbered dots after refresh
            var dots = $('.homepage-temp .owl-carousel .owl-dot');
            dots.each(function(index) {
                var number = (index + 1).toString().padStart(2, '0');
                $(this).html('<p>' + number + '</p>');
            });
            // Hide all dots except active
            dots.not('.active').hide();
        },
        onChanged: function(event) {
            // Hide all dots and show only active one on slide change
            var dots = $('.homepage-temp .owl-carousel .owl-dot');
            dots.hide();
            dots.filter('.active').show();
        }
    });

    // Product Section Carousel
    jQuery('#product-section .owl-carousel').owlCarousel({
        loop: false,
        margin: 20,
        nav: false,
        navText: [
            "<i class='fa-solid fa-angle-left'></i>", 
            "<i class='fa-solid fa-angle-right'></i>"
        ],
        dots: false,
        rtl: false,
        autoplay: false,
        responsive: {
            0: { items: 1 },
            768: { items: 2 },
            1000: { items: 3 },
            1700: { items: 5 }
        }
    });

});
// Search js

document.addEventListener('DOMContentLoaded', function () {
  const searchIcon = document.getElementById('search-icon');
  const searchPopup = document.getElementById('search-popup');
  const closeBtn = document.querySelector('.close-popup');

  // bail early if required elements are missing
  if (!searchIcon || !searchPopup) {
    // nothing to do, avoid null dereference
    return;
  }

  const getFocusables = () => searchPopup.querySelectorAll('input, button');
  
  function trendy_storefront_openPopup() {
    searchPopup.style.display = 'block';
    const input = searchPopup.querySelector('input[name="s"]');
    input && input.focus();
  }

  function trendy_storefront_closePopup() {
    searchPopup.style.display = 'none';
    searchIcon.focus(); // Return focus
  }

  // Open popup
  searchIcon.addEventListener('click', trendy_storefront_openPopup);
  searchIcon.addEventListener('keydown', function (e) {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      trendy_storefront_openPopup();
    }
  });

  // Close popup on close button (closeBtn might be null so guard)
  if (closeBtn) {
    closeBtn.addEventListener('click', trendy_storefront_closePopup);
  }

  // Close popup on outside click
  window.addEventListener('click', function (e) {
    if (e.target === searchPopup) {
      trendy_storefront_closePopup();
    }
  });

  // ESC + Tab trap
  window.addEventListener('keydown', function (e) {
    if (searchPopup.style.display === 'block') {
      // ESC to close
      if (e.key === 'Escape') {
        trendy_storefront_closePopup();
        return;
      }

      // Trap Tab focus
      const focusables = getFocusables();
      const first = focusables[0];
      const last = focusables[focusables.length - 1];

      if (e.key === 'Tab') {
        if (focusables.length === 0) return;

        if (e.shiftKey) {
          if (document.activeElement === first) {
            e.preventDefault();
            last.focus();
          }
        } else {
          if (document.activeElement === last) {
            e.preventDefault();
            first.focus();
          }
        }
      }
    }
  });
});

// Product Category Filter
jQuery(document).ready(function($) {
    $('#product-category-filter').on('change', function() {
        var categorySlug = $(this).val();
        var container = $('#filtered-products-container');
        
        if (!categorySlug) {
            container.html('<p class="no-products-msg">' + 'Please select a category.' + '</p>');
            return;
        }
        
        // Show loading state
        container.html('<div class="loading-products"><p>Loading products...</p></div>');
        
        // AJAX request
        $.ajax({
            url: trendy_storefront_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_products_by_category',
                category: categorySlug,
                nonce: trendy_storefront_ajax_object.nonce
            },
            success: function(response) {
                if (response.success) {
                    container.html(response.data.html);
                } else {
                    container.html('<p class="no-products-msg">' + response.data.message + '</p>');
                }
            },
            error: function() {
                container.html('<p class="no-products-msg">Error loading products. Please try again.</p>');
            }
        });
    });
});


jQuery(document).ready(function($) {

    jQuery(".homepage-temp h1").each(function() {

        var text = jQuery(this).text().trim();
        var words = text.split(/\s+/);
        var newText = "";

        for (var i = 0; i < words.length; i++) {

            // 3rd word
            if (i === 2) {
                newText += "<span class='third-word'>" + words[i] + "</span> ";
            }

            // 5th word
            else if (i === 4) {
                newText += "<span class='fifth-word'>" + words[i] + "</span> ";
            }

            else {
                newText += words[i] + " ";
            }
        }

        jQuery(this).html(newText.trim());
    });

});