// public/js/leaveRequest.js
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('leaveForm');
  if (!form) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    if (!form.checkValidity()) {
      form.reportValidity();
      return;
    }

    const endpoint = form.dataset.endpoint || form.action || '/app/Controllers/LeaveRequestController.php?action=create';
    const submitBtn = form.querySelector('button[type="submit"]');
    submitBtn?.setAttribute('disabled', 'disabled');

    try {
      const res = await fetch(endpoint, { method: 'POST', body: new FormData(form) });
      const json = await res.json();
      if (json.ok) {
        alert('✅ Submitted successfully!');
        form.reset();
      } else {
        alert('❌ Submit failed: ' + (json.message || 'Unknown error'));
      }
    } catch (err) {
      alert('🚫 Network/Server error: ' + err.message);
    } finally {
      submitBtn?.removeAttribute('disabled');
    }
  });
});