document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("editLeaveModal");
  const form = document.getElementById("editLeaveForm");
  const closeBtns = document.querySelectorAll(".modal-close, .modal-cancel");

  document.body.addEventListener("click", function (e) {
    const btn = e.target.closest(".btn-edit-leave");
    if (!btn) return;

    const id = btn.dataset.id || "";
    const from = btn.dataset.from || "";
    const to = btn.dataset.to || "";
    const reason = btn.dataset.reason || "";

    form.querySelector('input[name="edit_request_id"]').value = id;
    form.querySelector('input[name="fromDate"]').value = from;
    form.querySelector('input[name="toDate"]').value = to;
    form.querySelector('textarea[name="reason"]').value = reason;

    modal.classList.add("open");
  });

  closeBtns.forEach((btn) =>
    btn.addEventListener("click", () => modal.classList.remove("open"))
  );

  window.addEventListener("keydown", (e) => {
    if (e.key === "Escape") modal.classList.remove("open");
  });

  modal.addEventListener("click", (e) => {
    if (e.target === modal) modal.classList.remove("open");
  });
});
