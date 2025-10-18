// filepath: /public/js/MP/editUserModal.js

export function editUserModal() {
  const modal = document.querySelector("#edit-user-modal");
  const form = document.querySelector("#edit-user-form");
  const btnClose = document.querySelector("#edit-user-close");
  const btnCancel = document.querySelector("#edit-user-cancel");
  const tableBody = document.querySelector("#user-table-body");

  if (!modal || !form || !tableBody) return;

  function openModal() {
    modal.classList.remove("hidden");
    modal.setAttribute("aria-hidden", "false");
  }
  function closeModal() {
    modal.classList.add("hidden");
    modal.setAttribute("aria-hidden", "true");
  }

  async function fetchUser(userID) {
    const res = await fetch(
      `../../Controllers/addNewUser/getUserAjax.php?userID=${encodeURIComponent(
        userID
      )}`
    );
    if (!res.ok) throw new Error("Network");
    return res.json();
  }

  function fillForm(u) {
    form.querySelector("#edit-userID").value = u.userID;
    form.querySelector("#edit-fName").value = u.fName ?? "";
    form.querySelector("#edit-lName").value = u.lName ?? "";
    form.querySelector("#edit-email").value = u.email ?? "";
    form.querySelector("#edit-phone").value = u.phone ?? "";
    if (u.dateOfBirth) {
      // Ensure yyyy-mm-dd
      const d = new Date(u.dateOfBirth);
      const iso = !isNaN(d) ? d.toISOString().slice(0, 10) : u.dateOfBirth;
      form.querySelector("#edit-dob").value = iso;
    } else {
      form.querySelector("#edit-dob").value = "";
    }
    form.querySelector("#edit-gender").value = u.gender ?? "";
  }

  // Delegate clicks on Edit buttons
  tableBody.addEventListener("click", async (e) => {
    const btn = e.target.closest(".edit-user-btn");
    if (!btn) return;
    e.preventDefault();
    const userID =
      btn.getAttribute("data-user-id") ||
      btn.closest("tr")?.getAttribute("data-user-id");
    if (!userID) return;

    try {
      const json = await fetchUser(userID);
      if (json.success) {
        fillForm(json.data);
        openModal();
      }
    } catch (_) {
      // Silently fail
    }
  });

  function serializeForm(formEl) {
    const fd = new FormData(formEl);
    return new URLSearchParams(fd).toString();
  }

  async function submitEdit(e) {
    e.preventDefault();
    const body = serializeForm(form);
    try {
      const res = await fetch(`../../Controllers/addNewUser/editUser.php`, {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body,
      });
      const json = await res.json();
      if (json.success) {
        closeModal();
        // Optionally refresh the current table row
        // Trigger a search submit to refresh list if available
        const searchForm = document.querySelector("#user-search-form");
        if (searchForm) searchForm.dispatchEvent(new Event("submit"));
      }
    } catch (_) {
      // ignore
    }
  }

  form.addEventListener("submit", submitEdit);
  btnClose?.addEventListener("click", closeModal);
  btnCancel?.addEventListener("click", closeModal);
  modal.addEventListener("click", (e) => {
    if (e.target === modal) closeModal();
  });
}
