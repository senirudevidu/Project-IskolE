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

  function renderRows(users) {
    if (!Array.isArray(users) || users.length === 0) {
      tableBody.innerHTML = `<tr class="table-row"><td class="table-data" colspan="4">No users found.</td></tr>`;
      return;
    }
    const rows = users
      .map(
        (u) => `
      <tr class="table-row">
        <td class="table-data">${u.fName} ${u.lName}</td>
        <td class="table-data">${u.role ?? ""}</td>
        <td class="table-data">${u.email}</td>
        <td class="table-data">
          <div class="row">
            <button class="btn">Edit</button>
            <button class="btn btn-red">Delete</button>
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

    // If no query, restore the normal (original) rows
    if (q === "") {
      tableBody.innerHTML = originalHTML;
      return;
    }

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

  // Also restore rows when input is cleared without submitting
  input.addEventListener("input", () => {
    if (input.value.trim() === "") {
      tableBody.innerHTML = originalHTML;
    }
  });
}
