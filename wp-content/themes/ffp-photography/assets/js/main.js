/**
 * FFP Photography — Main JavaScript
 * Handles: page loader, navigation, lightbox, testimonials,
 *          portfolio filter, booking form (AJAX), scroll animations.
 *
 * @package FFP_Photography
 * @version 1.0.0
 */

( function () {
    'use strict';

    /* ============================================================
       PAGE LOADER
    ============================================================ */
    const loader = document.getElementById( 'page-loader' );

    function hideLoader() {
        if ( loader ) {
            loader.classList.add( 'loaded' );
            setTimeout( () => { loader.style.display = 'none'; }, 600 );
        }
    }

    if ( document.readyState === 'complete' ) {
        hideLoader();
    } else {
        window.addEventListener( 'load', hideLoader );
        // Failsafe: hide after 3 seconds even if load event doesn't fire
        setTimeout( hideLoader, 3000 );
    }

    /* ============================================================
       HEADER: SCROLL EFFECT
    ============================================================ */
    const header = document.getElementById( 'site-header' );

    function onScroll() {
        if ( ! header ) return;
        if ( window.scrollY > 80 ) {
            header.classList.add( 'scrolled' );
        } else {
            header.classList.remove( 'scrolled' );
        }
    }

    window.addEventListener( 'scroll', onScroll, { passive: true } );
    onScroll();

    /* ============================================================
       MOBILE NAVIGATION
    ============================================================ */
    const navToggle = document.getElementById( 'nav-toggle' );
    const navMenu   = document.getElementById( 'primary-menu' );

    if ( navToggle && navMenu ) {
        navToggle.addEventListener( 'click', function () {
            const isOpen = navMenu.classList.toggle( 'open' );
            navToggle.classList.toggle( 'active', isOpen );
            navToggle.setAttribute( 'aria-expanded', String( isOpen ) );
            document.body.style.overflow = isOpen ? 'hidden' : '';
        } );

        // Close on menu link click
        navMenu.querySelectorAll( 'a' ).forEach( link => {
            link.addEventListener( 'click', () => {
                navMenu.classList.remove( 'open' );
                navToggle.classList.remove( 'active' );
                navToggle.setAttribute( 'aria-expanded', 'false' );
                document.body.style.overflow = '';
            } );
        } );

        // Close on Escape
        document.addEventListener( 'keydown', function ( e ) {
            if ( e.key === 'Escape' && navMenu.classList.contains( 'open' ) ) {
                navMenu.classList.remove( 'open' );
                navToggle.classList.remove( 'active' );
                navToggle.setAttribute( 'aria-expanded', 'false' );
                document.body.style.overflow = '';
                navToggle.focus();
            }
        } );
    }

    /* ============================================================
       HERO: SCROLL BUTTON
    ============================================================ */
    const heroScroll = document.getElementById( 'hero-scroll' );

    if ( heroScroll ) {
        const scrollToContent = function () {
            const target = document.getElementById( 'featured-work' ) ||
                           document.getElementById( 'portfolio-gallery' );
            if ( target ) {
                target.scrollIntoView( { behavior: 'smooth', block: 'start' } );
            } else {
                window.scrollTo( { top: window.innerHeight, behavior: 'smooth' } );
            }
        };

        heroScroll.addEventListener( 'click',   scrollToContent );
        heroScroll.addEventListener( 'keydown', ( e ) => {
            if ( e.key === 'Enter' || e.key === ' ' ) {
                e.preventDefault();
                scrollToContent();
            }
        } );
    }

    /* ============================================================
       HERO BACKGROUND PAN
    ============================================================ */
    const heroBg = document.getElementById( 'hero-bg' );
    if ( heroBg ) {
        setTimeout( () => heroBg.classList.add( 'loaded' ), 100 );
    }

    /* ============================================================
       LIGHTBOX
    ============================================================ */
    const lightbox     = document.getElementById( 'lightbox' );
    const lightboxImg  = document.getElementById( 'lightbox-img' );
    const lightboxCap  = document.getElementById( 'lightbox-caption' );
    const lightboxClose = document.getElementById( 'lightbox-close' );
    const lightboxPrev  = document.getElementById( 'lightbox-prev' );
    const lightboxNext  = document.getElementById( 'lightbox-next' );

    let lightboxItems   = [];
    let lightboxCurrent = 0;

    function openLightbox( items, index ) {
        lightboxItems   = items;
        lightboxCurrent = index;
        showLightboxItem( index );
        lightbox.classList.add( 'active' );
        document.body.style.overflow = 'hidden';
        lightboxClose.focus();
    }

    function closeLightbox() {
        lightbox.classList.remove( 'active' );
        document.body.style.overflow = '';
    }

    function showLightboxItem( index ) {
        const item = lightboxItems[ index ];
        if ( ! item ) return;
        lightboxImg.src = item.src;
        lightboxImg.alt = item.caption || '';
        if ( lightboxCap ) lightboxCap.textContent = item.caption || '';
        lightboxCurrent = index;
        lightboxPrev.style.visibility = index === 0 ? 'hidden' : 'visible';
        lightboxNext.style.visibility = index === lightboxItems.length - 1 ? 'hidden' : 'visible';
    }

    if ( lightbox ) {
        // Bind gallery items
        document.querySelectorAll( '[data-lightbox]' ).forEach( ( el, i, all ) => {
            el.addEventListener( 'click', function () {
                const items = Array.from( all ).map( n => ({
                    src:     n.dataset.lightbox,
                    caption: n.dataset.caption || '',
                }) );
                openLightbox( items, i );
            } );
            el.setAttribute( 'tabindex', '0' );
            el.setAttribute( 'role', 'button' );
            el.addEventListener( 'keydown', function ( e ) {
                if ( e.key === 'Enter' || e.key === ' ' ) {
                    e.preventDefault();
                    el.click();
                }
            } );
        } );

        lightboxClose.addEventListener( 'click', closeLightbox );

        lightbox.addEventListener( 'click', function ( e ) {
            if ( e.target === lightbox ) closeLightbox();
        } );

        lightboxPrev.addEventListener( 'click', function () {
            if ( lightboxCurrent > 0 ) showLightboxItem( lightboxCurrent - 1 );
        } );

        lightboxNext.addEventListener( 'click', function () {
            if ( lightboxCurrent < lightboxItems.length - 1 ) showLightboxItem( lightboxCurrent + 1 );
        } );

        document.addEventListener( 'keydown', function ( e ) {
            if ( ! lightbox.classList.contains( 'active' ) ) return;
            if ( e.key === 'Escape' )      closeLightbox();
            if ( e.key === 'ArrowLeft' )   lightboxPrev.click();
            if ( e.key === 'ArrowRight' )  lightboxNext.click();
        } );
    }

    /* ============================================================
       PORTFOLIO CATEGORY FILTER
    ============================================================ */
    const filterBtns  = document.querySelectorAll( '.filter-btn' );
    const masonry     = document.getElementById( 'portfolio-masonry' );

    if ( filterBtns.length && masonry ) {
        filterBtns.forEach( btn => {
            btn.addEventListener( 'click', function () {
                filterBtns.forEach( b => {
                    b.classList.remove( 'active' );
                    b.setAttribute( 'aria-selected', 'false' );
                } );
                btn.classList.add( 'active' );
                btn.setAttribute( 'aria-selected', 'true' );

                const filter = btn.dataset.filter;

                masonry.querySelectorAll( '.gallery-item' ).forEach( item => {
                    if ( filter === 'all' ) {
                        item.style.display = '';
                    } else {
                        const cats = ( item.dataset.categories || '' ).split( ' ' );
                        item.style.display = cats.includes( filter ) ? '' : 'none';
                    }
                } );
            } );
        } );
    }

    /* ============================================================
       TESTIMONIAL SLIDER
    ============================================================ */
    const slides = document.querySelectorAll( '.testimonial-slide' );
    const dots   = document.querySelectorAll( '.testimonial-dot' );
    let   currentSlide = 0;
    let   slideInterval = null;

    function goToSlide( index ) {
        slides.forEach( ( s, i ) => {
            s.classList.toggle( 'active', i === index );
            s.setAttribute( 'aria-hidden', String( i !== index ) );
        } );
        dots.forEach( ( d, i ) => {
            d.classList.toggle( 'active', i === index );
            d.setAttribute( 'aria-selected', String( i === index ) );
        } );
        currentSlide = index;
    }

    function nextSlide() {
        goToSlide( ( currentSlide + 1 ) % slides.length );
    }

    if ( slides.length > 1 ) {
        dots.forEach( ( dot, i ) => {
            dot.addEventListener( 'click', function () {
                clearInterval( slideInterval );
                goToSlide( i );
                slideInterval = setInterval( nextSlide, 5000 );
            } );
        } );

        slideInterval = setInterval( nextSlide, 5000 );

        // Pause on hover
        const wrap = document.querySelector( '.testimonials-wrap' );
        if ( wrap ) {
            wrap.addEventListener( 'mouseenter', () => clearInterval( slideInterval ) );
            wrap.addEventListener( 'mouseleave', () => {
                slideInterval = setInterval( nextSlide, 5000 );
            } );
        }
    }

    /* ============================================================
       BOOKING: PACKAGE SELECTION
    ============================================================ */
    const packageCards   = document.querySelectorAll( '.package-card' );
    const selectedPkgInput = document.getElementById( 'selected-package' );
    const summaryPackage = document.getElementById( 'summary-package' );
    const summaryPrice   = document.getElementById( 'summary-price' );

    const packagePrices = {
        essential: '$450',
        signature: '$950',
        premium:   '$1,800',
    };

    packageCards.forEach( card => {
        card.addEventListener( 'click', function () {
            packageCards.forEach( c => c.classList.remove( 'selected' ) );
            card.classList.add( 'selected' );

            const pkg = card.dataset.package;
            if ( selectedPkgInput ) selectedPkgInput.value = pkg;

            if ( summaryPackage ) summaryPackage.textContent = card.querySelector( '.package-name' ).textContent;
            if ( summaryPrice   ) summaryPrice.textContent   = packagePrices[ pkg ] || '';
        } );

        card.setAttribute( 'tabindex', '0' );
        card.addEventListener( 'keydown', function ( e ) {
            if ( e.key === 'Enter' || e.key === ' ' ) { e.preventDefault(); card.click(); }
        } );
    } );

    // Live summary updates
    const summaryService  = document.getElementById( 'summary-service' );
    const summaryDate     = document.getElementById( 'summary-date' );
    const summaryLocation = document.getElementById( 'summary-location' );

    function bindSummaryField( selector, summaryEl, transformer ) {
        const el = document.querySelector( selector );
        if ( ! el || ! summaryEl ) return;
        const update = () => {
            const val = el.value.trim();
            summaryEl.textContent = val ? ( transformer ? transformer( val ) : val ) : '—';
        };
        el.addEventListener( 'input',  update );
        el.addEventListener( 'change', update );
    }

    bindSummaryField( '#bp-service', summaryService, null );
    bindSummaryField( '#bp-event-date', summaryDate, v => {
        const d = new Date( v + 'T00:00:00' );
        return isNaN( d ) ? v : d.toLocaleDateString( undefined, { weekday:'long', year:'numeric', month:'long', day:'numeric' } );
    } );
    bindSummaryField( '#bp-location', summaryLocation, null );

    /* ============================================================
       BOOKING FORM: AJAX SUBMISSION
    ============================================================ */
    function initBookingForm( formId, messageId ) {
        const form    = document.getElementById( formId );
        const msgEl   = document.getElementById( messageId );
        if ( ! form || ! msgEl ) return;

        form.addEventListener( 'submit', async function ( e ) {
            e.preventDefault();

            const submitBtn = form.querySelector( '[type="submit"]' );
            const btnText   = submitBtn ? submitBtn.querySelector( '.btn-text' ) : null;

            // Basic validation
            const required = form.querySelectorAll( '[required]' );
            let valid = true;
            required.forEach( field => {
                field.style.borderColor = '';
                if ( ! field.value.trim() ) {
                    field.style.borderColor = '#c94c4c';
                    valid = false;
                }
            } );
            if ( ! valid ) {
                showMessage( msgEl, 'error', ffpData.i18n.required );
                return;
            }

            // Build FormData
            const data = new FormData( form );
            data.set( 'action', 'ffp_booking' );
            data.set( 'nonce', ffpData.nonce );

            // Handle split first/last name
            const firstName = form.querySelector( '[name="first_name"]' );
            const lastName  = form.querySelector( '[name="last_name"]' );
            if ( firstName && lastName ) {
                data.set( 'name', firstName.value.trim() + ' ' + lastName.value.trim() );
            }

            // UI: loading state
            if ( submitBtn ) { submitBtn.disabled = true; }
            if ( btnText )   { btnText.textContent = ffpData.i18n.sending; }
            hideMessage( msgEl );

            try {
                const response = await fetch( ffpData.ajaxUrl, {
                    method: 'POST',
                    body:   data,
                } );
                const result = await response.json();

                if ( result.success ) {
                    showMessage( msgEl, 'success', result.data.message );
                    form.reset();
                    // Re-select default package
                    packageCards.forEach( ( c, i ) => {
                        c.classList.toggle( 'selected', c.classList.contains( 'featured' ) );
                    } );
                } else {
                    showMessage( msgEl, 'error', result.data.message || ffpData.i18n.bookingError );
                }
            } catch ( err ) {
                showMessage( msgEl, 'error', ffpData.i18n.bookingError );
            } finally {
                if ( submitBtn ) { submitBtn.disabled = false; }
                if ( btnText )   { btnText.textContent = form.id === 'booking-form-home' ? 'Send Request' : 'Submit Booking Request'; }
                msgEl.scrollIntoView( { behavior: 'smooth', block: 'nearest' } );
            }
        } );
    }

    function showMessage( el, type, text ) {
        el.className = 'form-message ' + type;
        el.textContent = text;
        el.style.display = 'block';
    }

    function hideMessage( el ) {
        el.style.display = 'none';
        el.className = 'form-message';
        el.textContent = '';
    }

    if ( typeof ffpData !== 'undefined' ) {
        initBookingForm( 'booking-form-home', 'booking-message-home' );
        initBookingForm( 'booking-form-page', 'booking-message-page' );
    }

    /* ============================================================
       PRE-SELECT SERVICE FROM URL PARAM
    ============================================================ */
    function preselectFromUrl() {
        const params  = new URLSearchParams( window.location.search );
        const service = params.get( 'service' );
        if ( ! service ) return;

        const serviceSelect = document.querySelector( 'select[name="service"]' );
        if ( serviceSelect ) {
            for ( let i = 0; i < serviceSelect.options.length; i++ ) {
                if ( serviceSelect.options[ i ].value.toLowerCase() === service.toLowerCase() ) {
                    serviceSelect.selectedIndex = i;
                    serviceSelect.dispatchEvent( new Event( 'change' ) );
                    break;
                }
            }
        }
    }
    preselectFromUrl();

    /* ============================================================
       SCROLL REVEAL ANIMATIONS
    ============================================================ */
    function initScrollReveal() {
        const revealEls = document.querySelectorAll(
            '.service-card, .gallery-item, .about-grid, .stat-item, .gear-item, .package-card'
        );

        if ( ! revealEls.length ) return;

        const observer = new IntersectionObserver( ( entries ) => {
            entries.forEach( ( entry, i ) => {
                if ( entry.isIntersecting ) {
                    entry.target.style.transitionDelay = ( i * 0.05 ) + 's';
                    entry.target.style.opacity  = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve( entry.target );
                }
            } );
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' } );

        revealEls.forEach( el => {
            el.style.opacity   = '0';
            el.style.transform = 'translateY(24px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe( el );
        } );
    }

    // Run after a tick so styles are applied
    requestAnimationFrame( initScrollReveal );

    /* ============================================================
       SMOOTH ANCHOR LINKS
    ============================================================ */
    document.querySelectorAll( 'a[href^="#"]' ).forEach( anchor => {
        anchor.addEventListener( 'click', function ( e ) {
            const target = document.querySelector( this.getAttribute( 'href' ) );
            if ( target ) {
                e.preventDefault();
                target.scrollIntoView( { behavior: 'smooth', block: 'start' } );
            }
        } );
    } );

    /* ============================================================
       SERVICE CARD: HOVER CURSOR (cosmetic enhancement)
    ============================================================ */
    document.querySelectorAll( '.gallery-item' ).forEach( item => {
        item.style.cursor = 'pointer';
    } );

} )();
