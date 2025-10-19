// filepath: /public/js/MP/userSearch.js

export function userSearch() {
  const form = document.querySelector("#user-search-form");
  const input = document.querySelector("#user-search-input");
  const tableBody = document.querySelector("#user-table-body");

  if (!form || !input || !tableBody) return;

  // Keep the initially rendered rows to restore when query is empty
  const originalHTML = tableBody.innerHTML;

  async function fetchUsers(q) {
    const params = new URLSearchParams();
    if (q && q.trim() !== "") params.set("q", q.trim());
    const res = await fetch(
      `../../Controllers/addNewUser/searchUserAjax.php?${params.toString()}`
    );
    if (!res.ok) throw new Error("Network error");
    return res.json();
  }

  async function deactivateUser(userID) {
    const body = new URLSearchParams({ userID: String(userID) });
    const res = await fetch(`../../Controllers/addNewUser/deactivateUser.php`, {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: body.toString(),
    });
    if (!res.ok) throw new Error("Network error");
    return res.json();
  }

  function renderRows(users) {
    if (!Array.isArray(users) || users.length === 0) {
      tableBody.innerHTML = `<tr class="table-row"><td class="table-data" colspan="4">No users found.</td></tr>`;
      return;
    }
    const rows = users
      .map(
        (u) => `
      <tr class="table-row" data-user-id="${u.userID}">
        <td class="table-data">${u.fName} ${u.lName}</td>
        <td class="table-data">${u.role ?? ""}</td>
        <td class="table-data">${u.email}</td>
        <td class="table-data">
          <div class="row">
            <button class="btn edit-user-btn" data-user-id="${
              u.userID
            }">Edit</button>
            <button class="btn btn-red" data-user-id="${
              u.userID
            }">Delete</button>
          </div>
        </td>
      </tr>`
      )
      .join("");
    tableBody.innerHTML = rows;
  }

  async function handleSearch(e) {
    e.preventDefault();
    const q = input.value.trim();

    try {
      const json = await fetchUsers(q);
      if (json.success) {
        renderRows(json.data);
      } else {
        renderRows([]);
      }
    } catch (err) {
      renderRows([]);
    }
  }

  // Submit on button click without full page reload
  form.addEventListener("submit", handleSearch);

  // Also refresh rows when input is cleared without submitting
  input.addEventListener("input", async () => {
    if (input.value.trim() === "") {
      try {
        const json = await fetchUsers("");
        if (json.success) renderRows(json.data);
        else renderRows([]);
      } catch (_) {
        renderRows([]);
      }
    }
  });

  // Delegate Delete clicks
  tableBody.addEventListener("click", async (e) => {
    const btn = e.target.closest(".btn.btn-red");
    if (!btn) return;
    e.preventDefault();
    const row = btn.closest("tr");
    const userID =
      btn.getAttribute("data-user-id") || row?.getAttribute("data-user-id");
    if (!userID) return;

    if (!confirm("Deactivate this user?")) return;

    try {
      const json = await deactivateUser(userID);
      if (json.success) {
        // Re-fetch and re-render according to the current query
        const q = input.value.trim();
        try {
          const refreshed = await fetchUsers(q);
          if (refreshed.success) renderRows(refreshed.data);
          else renderRows([]);
        } catch (_) {
          renderRows([]);
        }
      }
    } catch (_) {
      // ignore
    }
  });
}
