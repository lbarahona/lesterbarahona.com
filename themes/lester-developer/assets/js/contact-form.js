/**
 * Contact Form AJAX Handler
 * Submits contact form via AJAX to bypass Cloudflare APO caching
 */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contact-form');
        if (!form) return;
        
        const submitBtn = form.querySelector('button[type="submit"]');
        const formCard = form.closest('.contact-form-card');
        const originalBtnHTML = submitBtn.innerHTML;
        
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Disable button and show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <span class="loading-spinner"></span>
                Sending...
            `;
            
            // Remove any existing messages
            const existingMsg = formCard.querySelector('.form-message');
            if (existingMsg) existingMsg.remove();
            
            // Gather form data
            const formData = new FormData(form);
            formData.append('action', 'submit_contact_form');
            
            try {
                const response = await fetch(lesterContact.ajaxUrl, {
                    method: 'POST',
                    body: formData,
                    credentials: 'same-origin'
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Show success message and hide form
                    form.style.display = 'none';
                    const introText = formCard.querySelector('p');
                    if (introText) introText.style.display = 'none';
                    
                    const successMsg = document.createElement('div');
                    successMsg.className = 'form-message form-message--success';
                    successMsg.innerHTML = `
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <div>
                            <strong>Message sent!</strong>
                            <p>${data.data.message}</p>
                        </div>
                    `;
                    formCard.querySelector('h2').after(successMsg);
                } else {
                    // Show error message
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'form-message form-message--error';
                    errorMsg.innerHTML = `
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                        <div>
                            <strong>Error</strong>
                            <p>${data.data.message}</p>
                        </div>
                    `;
                    form.before(errorMsg);
                    
                    // Re-enable button
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHTML;
                }
            } catch (error) {
                // Network error
                const errorMsg = document.createElement('div');
                errorMsg.className = 'form-message form-message--error';
                errorMsg.innerHTML = `
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    <div>
                        <strong>Network Error</strong>
                        <p>Could not connect to the server. Please check your internet connection and try again.</p>
                    </div>
                `;
                form.before(errorMsg);
                
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHTML;
            }
        });
    });
})();
