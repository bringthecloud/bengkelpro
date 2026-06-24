/* =====================================================
   BENGKELPRO — Global UI Enhancements (app.js)
   ===================================================== */

(function () {
    'use strict';

    /* =====================================================
       1. AUTO-DISMISS ALERTS
       Flash messages fade out after 4 seconds
       ===================================================== */
    function initAlerts() {
        const alerts = document.querySelectorAll('.alert-success, .alert-error');
        alerts.forEach(alert => {
            // Add close button
            const closeBtn = document.createElement('span');
            closeBtn.innerHTML = '&times;';
            closeBtn.className = 'alert-close';
            closeBtn.addEventListener('click', () => dismissAlert(alert));
            alert.appendChild(closeBtn);

            // Add progress bar
            const progress = document.createElement('div');
            progress.className = 'alert-progress';
            alert.appendChild(progress);

            // Auto dismiss after 4 seconds
            setTimeout(() => dismissAlert(alert), 4000);
        });
    }

    function dismissAlert(alert) {
        if (alert.classList.contains('dismissing')) return;
        alert.classList.add('dismissing');
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-10px)';
        alert.style.maxHeight = '0';
        alert.style.padding = '0';
        alert.style.marginBottom = '0';
        alert.style.overflow = 'hidden';
        setTimeout(() => alert.remove(), 400);
    }

    /* =====================================================
       2. COUNT-UP ANIMATION (Dashboard Stats)
       Animates numbers from 0 to target value
       ===================================================== */
    function initCountUp() {
        const statValues = document.querySelectorAll('.stat-info h3');
        if (!statValues.length) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateValue(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        statValues.forEach(el => {
            el.dataset.original = el.textContent;
            observer.observe(el);
        });
    }

    function animateValue(el) {
        const text = el.dataset.original || el.textContent;
        const isRupiah = text.includes('Rp');

        // Extract numeric value
        const numStr = text.replace(/[^0-9]/g, '');
        const target = parseInt(numStr) || 0;

        if (target === 0) return;

        const duration = 1200;
        const startTime = performance.now();

        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);

            // Ease-out cubic
            const eased = 1 - Math.pow(1 - progress, 3);
            const current = Math.floor(eased * target);

            if (isRupiah) {
                el.textContent = 'Rp ' + current.toLocaleString('id-ID');
            } else {
                el.textContent = current.toLocaleString('id-ID');
            }

            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                // Restore original text to keep exact formatting
                el.textContent = text;
            }
        }

        el.textContent = isRupiah ? 'Rp 0' : '0';
        requestAnimationFrame(update);
    }

    /* =====================================================
       3. CUSTOM DELETE CONFIRMATION MODAL
       Replaces basic confirm() with a styled modal
       ===================================================== */
    function initDeleteConfirm() {
        // Create modal HTML once
        if (document.getElementById('deleteModal')) return;

        const modal = document.createElement('div');
        modal.id = 'deleteModal';
        modal.className = 'modal-overlay';
        modal.innerHTML = `
            <div class="modal-card">
                <div class="modal-icon">
                    <i class='bx bx-error-circle'></i>
                </div>
                <h3 class="modal-title">Konfirmasi Hapus</h3>
                <p class="modal-text">Apakah kamu yakin ingin menghapus data ini? Tindakan ini tidak bisa dibatalkan.</p>
                <div class="modal-actions">
                    <button class="btn btn-secondary modal-cancel" id="modalCancel">
                        <i class='bx bx-x'></i> Batal
                    </button>
                    <button class="btn btn-danger modal-confirm" id="modalConfirm">
                        <i class='bx bx-trash'></i> Ya, Hapus
                    </button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);

        // Intercept all delete links
        document.addEventListener('click', function (e) {
            const deleteLink = e.target.closest('a.btn-danger[onclick*="confirm"]');
            if (!deleteLink) return;

            e.preventDefault();
            e.stopImmediatePropagation();

            // Remove the inline onclick temporarily
            const href = deleteLink.getAttribute('href');

            showDeleteModal(href);

            return false;
        }, true); // Use capture phase to intercept before inline onclick
    }

    function showDeleteModal(href) {
        const modal = document.getElementById('deleteModal');
        const confirmBtn = document.getElementById('modalConfirm');
        const cancelBtn = document.getElementById('modalCancel');

        modal.classList.add('active');
        document.body.style.overflow = 'hidden';

        // Focus trap
        setTimeout(() => cancelBtn.focus(), 100);

        function cleanup() {
            modal.classList.remove('active');
            document.body.style.overflow = '';
            confirmBtn.replaceWith(confirmBtn.cloneNode(true));
            cancelBtn.replaceWith(cancelBtn.cloneNode(true));

            // Re-bind after clone
            document.getElementById('modalCancel').addEventListener('click', () => {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            });
        }

        cancelBtn.addEventListener('click', cleanup, { once: true });

        modal.addEventListener('click', function (e) {
            if (e.target === modal) cleanup();
        }, { once: true });

        confirmBtn.addEventListener('click', function () {
            cleanup();
            window.location.href = href;
        }, { once: true });

        // ESC key
        document.addEventListener('keydown', function escHandler(e) {
            if (e.key === 'Escape') {
                cleanup();
                document.removeEventListener('keydown', escHandler);
            }
        });
    }

    /* =====================================================
       4. ENHANCED SEARCH (Real-time with counter)
       Upgrades existing searchTable() with result count
       ===================================================== */
    function initSearch() {
        const searchInput = document.getElementById('searchInput');
        const dataTable = document.getElementById('dataTable');
        if (!searchInput || !dataTable) return;

        // Remove the old onkeyup attribute (views use filterTable)
        searchInput.removeAttribute('onkeyup');

        // Add search icon animation
        const searchBar = searchInput.closest('.search-bar');

        // Create result counter
        const counter = document.createElement('span');
        counter.className = 'search-counter';
        counter.style.display = 'none';
        if (searchBar) searchBar.appendChild(counter);

        searchInput.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            const rows = dataTable.querySelectorAll('tbody tr');
            let visibleCount = 0;

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const match = !q || text.includes(q);
                row.style.display = match ? '' : 'none';

                if (match) {
                    visibleCount++;
                    // Subtle highlight animation for matching rows
                    if (q) {
                        row.style.animation = 'none';
                        row.offsetHeight; // trigger reflow
                        row.style.animation = 'rowFadeIn 0.3s ease';
                    }
                }
            });

            // Update counter
            if (q) {
                counter.textContent = `${visibleCount} hasil ditemukan`;
                counter.style.display = 'block';
            } else {
                counter.style.display = 'none';
            }
        });

        // Clear search with Escape key
        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                this.value = '';
                this.dispatchEvent(new Event('input'));
                this.blur();
            }
        });
    }

    /* =====================================================
       5. SMOOTH PAGE TRANSITIONS
       Fade effect when navigating between pages
       ===================================================== */
    function initPageTransitions() {
        const content = document.querySelector('.page-content');
        if (!content) return;

        // Fade in on load
        content.style.opacity = '0';
        content.style.transform = 'translateY(12px)';
        requestAnimationFrame(() => {
            content.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            content.style.opacity = '1';
            content.style.transform = 'translateY(0)';
        });

        // Fade out on navigation
        document.addEventListener('click', function (e) {
            const link = e.target.closest('a[href]');
            if (!link) return;

            const href = link.getAttribute('href');

            // Skip: external links, anchors, javascript:, logout, delete, bayar, new tab
            if (!href ||
                href.startsWith('#') ||
                href.startsWith('javascript:') ||
                href.includes('delete') ||
                href.includes('logout') ||
                href.includes('bayar') ||
                link.target === '_blank' ||
                link.hasAttribute('onclick') ||
                e.ctrlKey || e.metaKey) {
                return;
            }

            // Skip if default was already prevented (e.g. by confirm() Cancel)
            if (e.defaultPrevented) return;

            // Skip same-page links
            if (href === window.location.pathname) return;

            e.preventDefault();

            content.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
            content.style.opacity = '0';
            content.style.transform = 'translateY(-8px)';

            setTimeout(() => {
                window.location.href = href;
            }, 200);
        });
    }

    /* =====================================================
       6. KEYBOARD SHORTCUTS
       Quick navigation enhancements
       ===================================================== */
    function initKeyboardShortcuts() {
        document.addEventListener('keydown', function (e) {
            // Ctrl+K or / to focus search
            if ((e.ctrlKey && e.key === 'k') || (e.key === '/' && document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA')) {
                e.preventDefault();
                const searchInput = document.getElementById('searchInput');
                if (searchInput) {
                    searchInput.focus();
                    searchInput.select();
                }
            }
        });
    }

    /* =====================================================
       INIT — Run all enhancements when DOM is ready
       ===================================================== */
    function init() {
        initAlerts();
        initCountUp();
        initDeleteConfirm();
        initSearch();
        initPageTransitions();
        initKeyboardShortcuts();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
