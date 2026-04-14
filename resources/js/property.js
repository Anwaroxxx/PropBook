
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
  }

  if (openBtn) openBtn.addEventListener('click', showModal);
  if (closeBtn) closeBtn.addEventListener('click', closeModal);
  if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

  if (form) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const data = new FormData(form);
      const tokenMeta = document.querySelector('meta[name="csrf-token"]');
      const csrf = tokenMeta ? tokenMeta.getAttribute('content') : '';

      try {
        const res = await fetch('/visits', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrf,
          },
          body: data,
        });

        if (!res.ok) {
          const text = await res.text();
          throw new Error('Request failed: ' + res.status + ' ' + text);
        }

        const json = await res.json();

        alert(json.message ?? 'Visit requested successfully');
        closeModal();
        setTimeout(() => window.location.reload(), 600);
      } catch (err) {
        console.error('Schedule error', err);
        alert('Could not schedule visit. See console for details.');
      }
    });
  }
});
