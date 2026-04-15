
document.addEventListener('DOMContentLoaded', () => {

  const modal = document.getElementById('scheduleModal');
  const openBtn = document.getElementById('scheduleBtn');
  const closeBtn = document.getElementById('scheduleClose');
  const cancelBtn = document.getElementById('scheduleCancel');
  const form = document.getElementById('scheduleForm');

  function showModal() {
    if (modal) modal.classList.remove('hidden');
  }
  
  function closeModal() {
    if (modal) modal.classList.add('hidden');
    // Reset form after closing
    if (form) {
      form.reset();
      const btnText = form.querySelector('.btn-text');
      const btnLoading = form.querySelector('.btn-loading');
      const submitBtn = form.querySelector('button[type="submit"]');
      if (btnText) btnText.classList.remove('hidden');
      if (btnLoading) btnLoading.classList.add('hidden');
      if (submitBtn) submitBtn.disabled = false;
    }
  }

  if (openBtn) openBtn.addEventListener('click', showModal);
  if (closeBtn) closeBtn.addEventListener('click', closeModal);
  if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
  
  // Close modal when clicking outside
  if (modal) {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        closeModal();
      }
    });
  }

  if (form) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const submitBtn = form.querySelector('button[type="submit"]');
      const btnText = form.querySelector('.btn-text');
      const btnLoading = form.querySelector('.btn-loading');
      
      // Show loading state
      submitBtn.disabled = true;
      btnText.classList.add('hidden');
      btnLoading.classList.remove('hidden');

      const data = new FormData(form);
      const tokenMeta = document.querySelector('meta[name="csrf-token"]');
      const csrf = tokenMeta ? tokenMeta.getAttribute('content') : '';

      try {
        const res = await fetch('/visits', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrf,
            'Accept': 'application/json',
          },
          body: data,
        });

        const json = await res.json();

        if (!res.ok) {
          throw new Error(json.message || 'Request failed');
        }

        // Show success message
        showAlert(json.message || 'Visit requested successfully', 'success');
        closeModal();
        setTimeout(() => window.location.reload(), 600);
      } catch (err) {
        console.error('Schedule error', err);
        showAlert(err.message || 'Could not schedule visit. Please try again.', 'error');
        // Reset button state
        submitBtn.disabled = false;
        btnText.classList.remove('hidden');
        btnLoading.classList.add('hidden');
      }
    });
  }
  
  // Helper function to show alerts
  function showAlert(message, type = 'info') {
    const colors = {
      success: 'bg-green-600/90 border-green-500',
      error: 'bg-red-600/90 border-red-500',
      info: 'bg-blue-600/90 border-blue-500'
    };
    const icons = {
      success: 'fa-check-circle',
      error: 'fa-exclamation-circle',
      info: 'fa-info-circle'
    };
    
    const alertDiv = document.createElement('div');
    alertDiv.className = `fixed top-20 right-6 z-50 max-w-sm ${colors[type]} border text-white px-4 py-3 rounded-lg shadow-lg animate-pulse`;
    alertDiv.innerHTML = `
      <div class="flex items-center gap-3">
        <i class="fas ${icons[type]}"></i>
        <p class="text-sm font-medium">${message}</p>
      </div>
    `;
    
    document.body.appendChild(alertDiv);
    
    setTimeout(() => {
      alertDiv.style.opacity = '0';
      alertDiv.style.transition = 'opacity 0.3s';
      setTimeout(() => alertDiv.remove(), 300);
    }, 3000);
  }
});
